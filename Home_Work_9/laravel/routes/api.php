<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PhotoController;
use Illuminate\Support\Facades\Route;

// “реализовать CRUD для категорий и фотографий (в том числе - перемену категории для фото)”

Route::apiResource('api_photos_web', PhotoController::class);
Route::apiResource('api_categories', CategoryController::class);
