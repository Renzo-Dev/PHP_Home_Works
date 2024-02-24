<?php

use App\Http\Controllers\BookController;
use Illuminate\Support\Facades\Route;

Route::get('/', [BookController::class, 'index'])->name('book.index');
Route::prefix('book')->group(function () {
    Route::get('create', [BookController::class, 'create'])->name('book.add');
});
