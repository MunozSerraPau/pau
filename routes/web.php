<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $allowedValues = [9, 12, 15]; // Valores permitidos
    $perPage = in_array(request('perPage'), $allowedValues) ? request('perPage') : 9; // Validar valor
    $order = in_array(request('order'), ['asc', 'desc']) ? request('order') : 'asc'; // Validar orden

    return view('home', compact('perPage', 'order'));
})->name('home');

Route::get('/login', function () {
    return view('/layouts/login');
}) -> name('login');

Route::get('/singup', function () {
    return view('/layouts/singup');
}) -> name('singup');