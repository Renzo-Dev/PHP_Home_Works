<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PhotoController;
use Illuminate\Support\Facades\Route;

Route::get('/',function (){
    return view('index');
});

Route::prefix('category')->group(function (){
    Route::get('create',[CategoryController::class,'create'])->name('category.create');
});

Route::prefix('photo')->group(function (){
    Route::get('create',[PhotoController::class,'create'])->name('photo.create');
});
