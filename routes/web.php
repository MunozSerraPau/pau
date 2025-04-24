<?php

use Illuminate\Support\Facades\Route;
use App\Models\Campeon;
use App\Http\Controllers\Auth\LoginController;


use App\Http\Controllers\CampeonController;
use App\Http\Controllers\CampeonControllerLogin;
use App\Http\Controllers\Auth\PasswordResetController;

use App\Http\Controllers\Auth\RegisterController;


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
Route::get('/home-users', function () {
    return view('home-users');
})->middleware('auth');;

//Recuperar contraseña via correo electrónico
Route::get('/forgot-password', [PasswordResetController::class, 'showRequestForm'])->name('password.request');
Route::post('/forgot-password', [PasswordResetController::class, 'sendResetLink'])->name('password.email');

Route::get('/reset-password', [PasswordResetController::class, 'showResetForm'])->name('password.reset');
Route::post('/reset-password', [PasswordResetController::class, 'reset'])->name('password.update');

//Registro
Route::get('/register', [RegisterController::class, 'show'])->name('register');
Route::post('/register', [RegisterController::class, 'store']);

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

// Home user 
Route::get('/home-users', [CampeonControllerLogin::class, 'index'])->name('home-users')->middleware('auth');
Route::get('/campeones/ajax', [CampeonControllerLogin::class, 'ajax'])->name('campeones.ajax')->middleware('auth');

//Editar Champions
Route::get('/campeones/{id}/editar', [CampeonControllerLogin::class, 'edit'])->name('campeones.edit')->middleware('auth');
Route::post('/campeones/{id}/actualizar', [CampeonControllerLogin::class, 'update'])->name('campeones.update')->middleware('auth');

//Eliminar Champions
Route::delete('/campeones/{id}/eliminar', [CampeonControllerLogin::class, 'destroy'])->name('campeones.destroy')->middleware('auth');

//Crear Champion
Route::get('/campeones/crear', [CampeonControllerLogin::class, 'create'])->name('campeones.create')->middleware('auth');
Route::post('/campeones/guardar', [CampeonControllerLogin::class, 'store'])->name('campeones.store')->middleware('auth');
