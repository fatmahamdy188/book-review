<?php

use App\Http\Controllers\ReviewController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;

Route::get('/', function () {
    return redirect()->route('books.index');
});

Route::resource('books',BookController::class)
->only(['index','show']);

Route::resource('books.reviews',ReviewController::class)
->scoped(['review' =>'book'])
->only(['create','store']);


Route::post('books/{book}/reviews', [ReviewController::class, 'store'])
->middleware('throttle:reviews')
->name('books.reviews.store');