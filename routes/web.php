<?php

use Illuminate\Support\Facades\Route;
use App\Models\Campeon;
use App\Http\Controllers\Auth\LoginController;


use App\Http\Controllers\CampeonController;
use App\Http\Controllers\Auth\PasswordResetController;



// Home
Route::get('/', function () {
    $allowedValues = [9, 12, 15]; // Valores permitidos
    $perPage = in_array(request('perPage'), $allowedValues) ? request('perPage') : 9; // Validar valor
    $order = in_array(request('order'), ['asc', 'desc']) ? request('order') : 'asc'; // Validar orden

    return view('home', compact('perPage', 'order'));
})->name('home');


//LOGIN / LOGOUT
//Login
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);

//Logout
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

//Redirección a la página de inicio después de iniciar sesión
Route::get('/home-user', function () {
    return view('home-user');
})->middleware('auth');;

//Recuperar contraseña via correo electrónico
Route::get('/forgot-password', [PasswordResetController::class, 'showRequestForm'])->name('password.request');
Route::post('/forgot-password', [PasswordResetController::class, 'sendResetLink'])->name('password.email');

Route::get('/reset-password', [PasswordResetController::class, 'showResetForm'])->name('password.reset');
Route::post('/reset-password', [PasswordResetController::class, 'reset'])->name('password.update');


// Busqueda de campeones
Route::get('/search-campeones', function () {
    $search = request('search');
    $order = request('order', 'asc');
    $perPage = request('perPage', 9);

    $campeones = Campeon::where('name', 'like', "%$search%")
        ->orderBy('name', $order)
        ->paginate($perPage);

    return view('partials.campeones-list', compact('campeones'));
})->name('search-campeones');


Route::get('/campeones/search', [CampeonController::class, 'search'])->name('campeones.search');