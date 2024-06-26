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
        $this->middleware('banned');
        $this->middleware('auth');
    }

    
    public function showView()
    {
        $user = auth()->user();
        if (!$user->is_admin) {
            return redirect()->route('welcome')->with('error', "You cannot access this page.");
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
                return true; 
            } else {
                return false; 
            }
    }
}
