<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    use RegistersUsers;

    protected $redirectTo = RouteServiceProvider::HOME;

    public function __construct()
    {
        $this->middleware('guest');
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:user'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'country' => ['required', 'string'], // Validation for the country field
        ]);
    }

    protected function create(array $data)
    {
        return User::create([
            'username' => $data['name'], // Assuming 'username' is the field name in the database
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'country' => $data['country'], // Storing the value of the 'country' field
            'is_admin' => false,
            'is_banned' => false,
        ]);
    }
}