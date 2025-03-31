<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
}) -> name('home');

Route::get('/home', function () {
    return view('home');
}) -> name('home');

Route::get('/login', function () {
    return view('/layouts/login');
}) -> name('login');

Route::get('/singup', function () {
    return view('/layouts/singup');
}) -> name('singup');