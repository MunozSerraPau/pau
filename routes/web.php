<?php

use Illuminate\Support\Facades\Route;
use App\Models\Campeon;
use App\Http\Controllers\Auth\LoginController;



// Home
Route::get('/', function () {
    $allowedValues = [9, 12, 15]; // Valores permitidos
    $perPage = in_array(request('perPage'), $allowedValues) ? request('perPage') : 9; // Validar valor
    $order = in_array(request('order'), ['asc', 'desc']) ? request('order') : 'asc'; // Validar orden

    return view('home', compact('perPage', 'order'));
})->name('home');


Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/home-user', function () {
    return view('home-user');
});


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
