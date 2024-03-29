<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Lobby;
use App\Models\Jouer;
use Illuminate\Http\JsonResponse;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    
    public function showView()
    {
        $user = auth()->user();
        if (!$user->is_admin) {
            abort(404);
        }
        // $user = new User();
        // $users = $user->getUsers();
        return view('admin.showUsers');
    }

    public function showUsers()
    {
        $user = new User();
        $users = $user->getUsers();
        return response()->json(['data' => $users]);
    }

    public function banUser(Request $request, int $id_user){
        
        try { 
            $user = User::find($id_user);
            if ($user) {
                // Vérifiez l'action demandée
                $action = $request->input('action');
                if ($action == 'ban') {
                    $user->is_banned = true;
                } elseif ($action == 'unban') {
                    $user->is_banned = false;
                }
                $user->save();
                return true; // Vous pouvez retourner une réponse JSON si nécessaire
            } else {
                return false; // Ou retournez une réponse JSON pour indiquer que l'utilisateur n'a pas été trouvé
            }
        } catch (\Exception $e) {
            dd($e->getMessage()); // Affiche l'erreur pour le débogage
        }
    }
}
