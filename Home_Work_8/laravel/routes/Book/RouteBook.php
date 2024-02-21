<?php
use App\Http\Controllers\BookController;
use Illuminate\Support\Facades\Route;

Route::get('/book', [BookController::class, 'show'])->name('show.book');

//Route::prefix('book')->group(function (){
//    Route::get('/book',[BookController::class,'show'])->name('book.show');
//    Route::get('/book',[BookController::class,'create'])->name('book.store');
//});
