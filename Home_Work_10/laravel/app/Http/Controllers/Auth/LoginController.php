<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function __construct() {}

    // выводим форму входа
    public function create()
    {
        return view('Auth.Login');
    }

    public function login()
    {
        
    }
}
