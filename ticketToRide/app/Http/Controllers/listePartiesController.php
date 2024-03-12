<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class listePartiesController extends Controller
{
    public function index($parametre1='', $parametre2='')
    {
        return view('listeParties', ['parametre1' => $parametre1, 'parametre2' => $parametre2]);
    }
}
