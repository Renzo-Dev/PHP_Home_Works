<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\AuthenRequest;
use http\Client\Curl\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function __construct() {}

    public function create()
    {
        return view('Auth.Register');
    }

    public function store(AuthenRequest $request)
    {
        // создаем нового плльзователя
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

//        return response()->json(['message' => 'User registered successfully', 'user' => $user], 201);
        // Создание токена доступа
        $token = $user->createToken('AuthToken')->accessToken;

        // Возврат ответа с токеном доступа
        return response()->json([
            'message' => 'User registered successfully',
            'user' => $user,
            'access_token' => $token,
        ], 201);
    }
}
