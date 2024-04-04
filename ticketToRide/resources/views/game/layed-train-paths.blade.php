@php
    use App\Models\Lobby;
    use Illuminate\Support\Facades\Redis;
    $lobby = Lobby::find($lobbyId);
    $players = $lobby->getUsers();
@endphp

<div class="players">
    @foreach ($players as $player)
        <div class="player-layed-trains">
            <h3>{{ $player->username }}</h3>
            @php
                $playerTrainPath = json_decode(Redis::get('lobby:'.$lobbyId.':player:'.$player->id_user.':layed_train_paths'));
            @endphp

            <ul class="list-group">
                @if (!$playerTrainPath)
                    <li class="list-group-item">No train paths laid</li>
                @else  
                    @foreach ($playerTrainPath as $trainPath)
                        <li class="list-group-item">
                            {{ $trainPath->city_1 }} to {{ $trainPath->city_2 }} : {{ $trainPath->length }} 
                            @if (!$trainPath->colour) 
                                (Any) 
                            @else 
                                ({{ $trainPath->colour }})
                            @endif
                        </li>
                    @endforeach
                @endif
            </ul>
        </div>
    @endforeach
</div>
