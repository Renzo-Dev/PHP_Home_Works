<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Mockery\Exception;

class RegisterController extends Controller
{

    // выводим форму регистрации
    public function create()
    {
        return redirect('/registration');
    }

    // добавление нового пользователя в БД с проверкой и валидацией
    public function store(Request $request)
    {
        return response(['Success' => 'Good'], 200);
    }
}
