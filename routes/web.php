<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UrlController;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::middleware('auth')->group(function () {
    Route::get('/url', [UrlController::class, 'index'])->name('url.list');
    Route::get('/url/create', [UrlController::class, 'create'])->name('url.create');
    Route::post('/url', [UrlController::class, 'update'])->name('url.update');
    Route::delete('/url', [UrlController::class, 'destroy'])->name('url.destroy');
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
