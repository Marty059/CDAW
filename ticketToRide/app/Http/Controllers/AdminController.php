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
        $user = new User();
        $users = $user->getUsers();
        return view('admin.showUsers');
    }

    public function showUsers()
    {
        $user = new User();
        $users = $user->getUsers();
        return response()->json(['data' => $users]);
    }
}
