<?php

use App\Http\Controllers\listePartiesController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/', function(){
     return view('hello', ['message' => 'Bonjour']);
 });




Route::get('liste-parties/{j1?}/{j2?}', [listePartiesController::class, 'index']);