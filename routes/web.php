<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/test', function () {
    return view('test');
});
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/dogs', [\App\Http\Controllers\DogController::class, 'index'])->name('dogs.index');
Route::post('/dog', [\App\Http\Controllers\DogController::class, 'store'])->name('dog.store');
Route::get('/dog/{id}/edit', [\App\Http\Controllers\DogController::class, 'edit'])->name('dog.edit');
Route::put('/dog/{id}', [\App\Http\Controllers\DogController::class, 'update'])->name('dog.update');
Route::delete('/dog/{id}', [\App\Http\Controllers\DogController::class, 'destroy'])->name('dog.destroy');

