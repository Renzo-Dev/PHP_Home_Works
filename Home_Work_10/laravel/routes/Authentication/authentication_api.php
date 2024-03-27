<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function (){

});

Route::post('/register',[RegisterController::class,'store']);
Route::post('/login',[LoginController::class,'login']);
