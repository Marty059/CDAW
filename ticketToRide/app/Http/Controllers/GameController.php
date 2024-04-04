<?php

namespace App\Http\Controllers;

use App\Events\LobbyJoinedEvent;
use App\Events\PostCreatedEvent;
use App\Events\TurnChangedEvent;
use Illuminate\Http\Request;
use App\Models\Lobby;
use App\Models\Path;
use App\Models\User;
use App\Models\Jouer;
use Illuminate\Support\Facades\Cache;
use \App\Events\GameLaunchedEvent;
use App\Models\Destination;
use App\Models\Wagon;
use Illuminate\Support\Facades\Redis;

class GameController extends Controller
{
    public function __construct()
    {
        $this->middleware('banned');
        $this->middleware('auth');
    }
    public function show($lobbyId)
{
    $lobby = Lobby::findOrFail($lobbyId);

    if (!$lobby->has_ended) {
        abort(404, 'The game doesn\'t exist or has ended yet.');
    }

    $players = $lobby->getUsersByRank();

    return view('game.show', compact('lobby', 'players'));
}


    public function showGameplay($lobbyId){
        $lobby = Lobby::findOrFail($lobbyId);

        $users = $lobby->getUsers();

        if (($users->pluck('id_user')->contains(auth()->user()->id_user))) {
            if($lobby->has_started){
                return view('game.gameplay', ['lobby' => $lobby, 'users' => $users]);
            }
            else{
                return redirect()->route('show', ['lobby_id' => $lobbyId])->with('error', 'Game has not started yet');
            }
        }
        else {
            return redirect()->route('show', ['lobby_id' => $lobbyId])->with('error', 'You are not in this game');
        }
    }

    public function startGame($lobbyId){
        $lobby = Lobby::findOrFail($lobbyId);
        $lobby->has_started = true;
        $lobby->save();
        if(auth()->user()->id_user != $lobby->id_createur){
            return redirect()->route('welcome')->with('error', 'You are not the owner of this lobby.');
        }
        if($lobby->has_started){
            return redirect()->route('game.showGameplay', ['lobbyId' => $lobbyId])->with('error', 'This game has already started.');
        }
        broadcast(new GameLaunchedEvent($lobbyId))->toOthers();
        //$this->initializeGame($lobbyId);      // A remettre quand c'est fonctionnel
        return redirect()->route('game.showGameplay', ['lobbyId' => $lobbyId]);
    }

    public function initializeGame($lobbyId){
        $this->GameIsOn($lobbyId);

        if(auth()->user()->id_user != Lobby::findOrFail($lobbyId)->id_createur){
            return redirect()->route('game.showGameplay', ['lobbyId' => $lobbyId])->with('error', 'You are not the owner of this lobby.');
        }

        Redis::flushdb(); // A enlever quand c'est fonctionnel
        $lobby = Lobby::findOrFail($lobbyId);
        $players = $lobby->getUsers();
        $destinationCards = Destination::all();
        $wagonCards = Wagon::all();
    
        $allWagonCardIds = $wagonCards->pluck('id_wagon')->toArray();
        $allDestinationCardIds = $destinationCards->pluck('id_destination')->toArray();
    
        Redis::del('lobby:'.$lobbyId.':available_wagon_card_ids');
        Redis::del('lobby:'.$lobbyId.':available_destination_card_ids');
        Redis::sadd('lobby:'.$lobbyId.':available_wagon_card_ids', $allWagonCardIds);
        Redis::sadd('lobby:'.$lobbyId.':available_destination_card_ids', $allDestinationCardIds);

        Redis::set('lobby:'.$lobbyId.':size', count($players));

        $randomWagonCardIds = Redis::srandmember('lobby:'.$lobbyId.':available_wagon_card_ids', 5);

        // Remove the picked card IDs from available_wagon_card_ids
        Redis::srem('lobby:'.$lobbyId.':available_wagon_card_ids', $randomWagonCardIds);

        // Add the picked card IDs to pickable_wagon_card_ids
        Redis::del('lobby:'.$lobbyId.':pickable_wagon_card_ids');
        Redis::sadd('lobby:'.$lobbyId.':pickable_wagon_card_ids', $randomWagonCardIds);

        $allTrainPaths = Path::all();
        $allTrainPathsData = $allTrainPaths->map(function ($trainPath) {
            return $trainPath->toArray();
        })->toArray();
        Redis::del('lobby:'.$lobbyId.':available_train_paths');
        Redis::set('lobby:'.$lobbyId.':available_train_paths', json_encode($allTrainPathsData));

        foreach ($players as $player) {
            $availableDestinationCardIds = Redis::smembers('lobby:'.$lobbyId.':available_destination_card_ids');
            $availableWagonCardIds = Redis::smembers('lobby:'.$lobbyId.':available_wagon_card_ids');
            $playerWagonCards = Wagon::whereIn('id_wagon', $availableWagonCardIds)->get()->shuffle()->take(4);
            $playerDestinationCards = Destination::whereIn('id_destination', $availableDestinationCardIds)->get()->shuffle()->take(3);

            // Convert wagon card data to array for caching
            $playerWagonCardsData = $playerWagonCards->map(function ($wagonCard) {
                return $wagonCard->toArray();
            })->toArray();
    
            // Convert destination card data to array for caching
            $playerDestinationCardsData = $playerDestinationCards->map(function ($destinationCard) {
                return $destinationCard->toArray();
            })->toArray();
    
            // Stock the wagon cards in the Redis cache of the player
            Redis::del('lobby:'.$lobbyId.':player:'.$player->id_user.':wagon_cards');
            Redis::del('lobby:'.$lobbyId.':player:'.$player->id_user.':destination_cards');
            Redis::set('lobby:'.$lobbyId.':player:'.$player->id_user.':wagon_cards', json_encode($playerWagonCardsData));
            Redis::set('lobby:'.$lobbyId.':player:'.$player->id_user.':destination_cards', json_encode($playerDestinationCardsData));
    
            // Remove the picked wagon card IDs from available_wagon_card_ids
            Redis::srem('lobby:'.$lobbyId.':available_wagon_card_ids', $playerWagonCards->pluck('id_wagon')->toArray());
    
            // Remove the picked destination card IDs from available_destination_card_ids
            Redis::srem('lobby:'.$lobbyId.':available_destination_card_ids', $playerDestinationCards->pluck('id_destination')->toArray());
    
            // Add the first player's turn to the cache
            Redis::set('lobby:'.$lobbyId.':current_turn', $players[0]->id_user);
            Redis::set('lobby:'.$lobbyId.':turn_number', 0);

            Redis::del('lobby:'.$lobbyId.':player:'.$player->id_user.':layed_train_paths');
        }
    
        return redirect()->route('game.showGameplay', ['lobbyId' => $lobbyId]);
    }

    public function pickRandomTrainCard($lobbyId, $userId){
        $this->checkPermission($lobbyId);

        $availableWagonCardIds = Redis::smembers('lobby:'.$lobbyId.':available_wagon_card_ids');

        if (empty($availableWagonCardIds)) {
            return redirect()->route('game.showGameplay', ['lobbyId' => $lobbyId])->with('error', 'No available wagon cards');
        }

        $wagonCards = Wagon::whereIn('id_wagon', $availableWagonCardIds)->get();

        $randomWagonCard = $wagonCards->random();

        $randomWagonCardData = $randomWagonCard->toArray();

        Redis::srem('lobby:'.$lobbyId.':available_wagon_card_ids', $randomWagonCard->id_wagon);

        $playerWagonCards = json_decode(Redis::get('lobby:'.$lobbyId.':player:'.$userId.':wagon_cards'),true);

        $playerWagonCards[] = $randomWagonCardData;

        Redis::set('lobby:'.$lobbyId.':player:'.$userId.':wagon_cards', json_encode($playerWagonCards));

        $this->nextTurnTrainCard($lobbyId, $userId);
        return redirect()->route('game.showGameplay', ['lobbyId' => $lobbyId]);
    }

    public function pickDestinationCards($lobbyId,$userId){
        $this->checkPermission($lobbyId);

        $availableDestinationCardIds = Redis::smembers('lobby:'.$lobbyId.':available_destination_card_ids');
        $turn_number = Redis::get('lobby:'.$lobbyId.':turn_number');

        if($turn_number == 1){
            return redirect()->route('game.showGameplay', ['lobbyId' => $lobbyId])->with('error', 'You can only pick train cards on your second turn.');
        }

        if (empty($availableDestinationCardIds)) {
            return redirect()->route('game.showGameplay', ['lobbyId' => $lobbyId])->with('error', 'No available destination cards');
        }

        $destinationCards = Destination::whereIn('id_destination', $availableDestinationCardIds)->get();

        $randomDestinationCards = $destinationCards->shuffle()->take(3);

        $randomDestinationCardsData = $randomDestinationCards->map(function ($destinationCard) {
            return $destinationCard->toArray();
        })->toArray();

        Redis::srem('lobby:'.$lobbyId.':available_destination_card_ids', $randomDestinationCards->pluck('id_destination')->toArray());

        $playerDestinationCards = json_decode(Redis::get('lobby:'.$lobbyId.':player:'.$userId.':destination_cards'),true);

        foreach ($randomDestinationCardsData as $destinationCard) {
            $playerDestinationCards[] = $destinationCard;
        }

        Redis::set('lobby:'.$lobbyId.':player:'.auth()->user()->id_user.':destination_cards', json_encode($playerDestinationCards));

        $this->nextTurnOthers($lobbyId, $userId);

        return redirect()->route('game.showGameplay', ['lobbyId' => $lobbyId]);
    }

    public function pickTrainCard($lobbyId,$userId, $wagonId){
        $this->checkPermission($lobbyId);

        $pickableWagonCardIds = Redis::smembers('lobby:'.$lobbyId.':pickable_wagon_card_ids');

        if (!in_array($wagonId, $pickableWagonCardIds)) {
            return redirect()->route('game.showGameplay', ['lobbyId' => $lobbyId])->with('error', 'This wagon card is not available to pick.');
        }

        $wagonCard = Wagon::find($wagonId);

        if (!$wagonCard) {
            return redirect()->route('game.showGameplay', ['lobbyId' => $lobbyId])->with('error', 'This wagon card does not exist.');
        }

        $wagonCardData = $wagonCard->toArray();

        Redis::srem('lobby:'.$lobbyId.':pickable_wagon_card_ids', $wagonId);

        $playerWagonCards = json_decode(Redis::get('lobby:'.$lobbyId.':player:'.$userId.':wagon_cards'),true);

        $playerWagonCards[] = $wagonCardData;

        Redis::set('lobby:'.$lobbyId.':player:'.$userId.':wagon_cards', json_encode($playerWagonCards));


        $randomWagonCardIds = Redis::srandmember('lobby:'.$lobbyId.':available_wagon_card_ids', 1);

        Redis::srem('lobby:'.$lobbyId.':available_wagon_card_ids', $randomWagonCardIds);
        Redis::sadd('lobby:'.$lobbyId.':pickable_wagon_card_ids', $randomWagonCardIds);

        $this->nextTurnTrainCard($lobbyId, $userId);
        return redirect()->route('game.showGameplay', ['lobbyId' => $lobbyId]);
    }

    public function placeTrainPath(Request $request, $lobbyId){
        $this->checkPermission($lobbyId);
        
        $turn_number = Redis::get('lobby:'.$lobbyId.':turn_number');

        if($turn_number == 1){
            return redirect()->route('game.showGameplay', ['lobbyId' => $lobbyId])->with('error', 'You can only pick trains on your second turn.');
        }

        $selectedPathId = $request->input('train_path');

        $availableTrainPaths = json_decode(Redis::get('lobby:'.$lobbyId.':available_train_paths'),true);

        $selectedPath = collect($availableTrainPaths)->firstWhere('id_path', $selectedPathId);

        if (!$selectedPath) {
            return redirect()->route('game.showGameplay', ['lobbyId' => $lobbyId])->with('error', 'This path is not available to lay trains.');
        }

        $playerWagonCards = json_decode(Redis::get('lobby:'.$lobbyId.':player:'.auth()->user()->id_user.':wagon_cards'),true);


        // Check if the player has enough wagons of the color of the paths to lay trains
        $selectedPathColor = $selectedPath['colour'] ?? null;
        $playerWagonCardsByColor = collect($playerWagonCards)->where('colour', $selectedPathColor)->count();
        $playerWagonCardsLocomotive = collect($playerWagonCards)->whereNull('colour')->count();

        if($playerWagonCardsByColor + $playerWagonCardsLocomotive >= $selectedPath['length']){
            $cardsToRemove = $selectedPath['length'];
            $playerWagonCards = collect($playerWagonCards)->filter(function ($wagonCard) use ($selectedPathColor, &$cardsToRemove) {
                if (($wagonCard['colour'] == $selectedPathColor|| !$wagonCard['colour']) && $cardsToRemove > 0) {
                    $cardsToRemove--;
                    return false; // Remove this card
                }
                return true; // Keep this card
            })->values()->toArray();

            $playerLayedTrainPaths = json_decode(Redis::get('lobby:'.$lobbyId.':player:'.auth()->user()->id_user.':layed_train_paths'),true);
            if(!$playerLayedTrainPaths){
                $playerLayedTrainPaths = [];
            }
            $playerLayedTrainPaths[] = $selectedPath;
            Redis::set('lobby:'.$lobbyId.':player:'.auth()->user()->id_user.':wagon_cards', json_encode($playerWagonCards));
            Redis::set('lobby:'.$lobbyId.':player:'.auth()->user()->id_user.':layed_train_paths', json_encode($playerLayedTrainPaths));

            $availableTrainPaths = collect($availableTrainPaths)->filter(function ($trainPath) use ($selectedPathId) {
                return $trainPath['id_path'] != $selectedPathId;
            })->values()->toArray();

            Redis::set('lobby:'.$lobbyId.':available_train_paths', json_encode($availableTrainPaths));

            $this->nextTurnOthers($lobbyId, auth()->user()->id_user);

            return redirect()->route('game.showGameplay', ['lobbyId' => $lobbyId]);
        }
        else{
            return redirect()->route('game.showGameplay', ['lobbyId' => $lobbyId])->with('error', 'You do not have enough locomotives or wagons of the right color to lay trains on this path.');
        }
        
    }

    public function nextTurnTrainCard($lobbyId, $userId){
        $turn_number = Redis::get('lobby:'.$lobbyId.':turn_number');
        if ($turn_number == 0) {
            Redis::set('lobby:'.$lobbyId.':turn_number', 1);
        } else {
            Redis::set('lobby:'.$lobbyId.':turn_number', 0);
            $players = Lobby::findOrFail($lobbyId)->getUsers();
            $currentTurnIndex = array_search($userId, $players->pluck('id_user')->toArray());
            $nextTurnIndex = ($currentTurnIndex + 1) % count($players);
            Redis::set('lobby:'.$lobbyId.':current_turn', $players[$nextTurnIndex]->id_user);
            broadcast(new TurnChangedEvent($lobbyId))->toOthers();
        }
    }

    public function nextTurnOthers($lobbyId,$userId){
        $players = Lobby::findOrFail($lobbyId)->getUsers();
        $currentTurnIndex = array_search($userId, $players->pluck('id_user')->toArray());
        $nextTurnIndex = ($currentTurnIndex + 1) % count($players);
        Redis::set('lobby:'.$lobbyId.':current_turn', $players[$nextTurnIndex]->id_user);
        broadcast(new TurnChangedEvent($lobbyId))->toOthers();
    }

    public function endGame($lobbyId){
        $lobby = Lobby::findOrFail($lobbyId);
        $lobby->has_ended = true;
        $lobby->save();
    }

    public function GameIsOn($lobbyId){
        $lobby = Lobby::findOrFail($lobbyId);
        if(!($lobby->has_started) || $lobby->has_ended){
            return redirect()->route('game.showGameplay', ['lobbyId' => $lobbyId]);
        }
    }
    public function playerInGame($lobbyId){
        $lobby = Lobby::findOrFail($lobbyId);
        $users = $lobby->getUsers();
        if($users->pluck('id_user')->contains(auth()->user()->id_user)){
            return true;
        }
        else{
            return false;
        }
    }

    public function checkPermission($lobbyId){
        $this->GameIsOn($lobbyId);
        $this->playerInGame($lobbyId);

        $currentTurn = Redis::get('lobby:'.$lobbyId.':current_turn');

        if ($currentTurn != auth()->user()->id_user) {
            return redirect()->route('game.showGameplay', ['lobbyId' => $lobbyId])->with('error', 'It is not your turn to play.');
        }
    }

    public function passTurn($lobbyId){
        $this->checkPermission($lobbyId);

        $this->nextTurnOthers($lobbyId, auth()->user()->id_user);

        return redirect()->route('game.showGameplay', ['lobbyId' => $lobbyId]);
    }
}
