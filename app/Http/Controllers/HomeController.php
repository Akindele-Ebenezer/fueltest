<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FuelTest;

class HomeController extends Controller
{ 
    public function index()
    {
        return view("login", [
            'EmailError' => '',
            'PasswordError' => '',
            'WrongCredentials' => ''
        ]);
    } 
}
