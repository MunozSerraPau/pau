<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CampeonController;

Route::get('/', [CampeonController::class, 'index'])->name('home');

Route::get('/home', function () {
    return view('home');
}) -> name('home');

Route::get('/login', function () {
    return view('/layouts/login');
}) -> name('login');

Route::get('/singup', function () {
    return view('/layouts/singup');
}) -> name('singup');

Route::get('/campeones/search', [CampeonController::class, 'search'])->name('campeones.search');