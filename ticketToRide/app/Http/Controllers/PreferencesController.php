<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class PreferencesController extends Controller
{
    public function __construct()
    {
        $this->middleware('banned');
        $this->middleware('auth');
    }

    public function index()
    {
        return view('preferences');
    }

    public function update(Request $request,){
        $retour = $request->validate([
            'username' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'password' => 'required|string|min:8|confirmed',
            'password_confirmation' => 'required|string|min:8',
        ]);
        $id_user = auth()->user()->id_user;
        $user = User::find($id_user);

        $user->username = $retour['username'];
        $user->email = $retour['email'];
        $user->password = bcrypt($retour['password']);
        $user->save();

        return redirect()->route('preferences');
    }
}
