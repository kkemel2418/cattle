<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class SessionController extends Controller
{
    public function session(){

          echo ("<h1> teste sessao !!!!  </h1> ");

        session(['user_name' => 'Kelly Kemel']);

        session()->put('lastname', 'web');

        Session::put('email','kellykemel@gmail');

        var_dump(Session::all(), session()->all());
    }
}
