<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\CampeonController;
use App\Http\Controllers\CampeonControllerLogin;

use App\Http\Controllers\PerfilController;

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\PasswordResetController;
use App\Http\Controllers\Auth\RegisterController;

use App\Http\Controllers\Admin\UsuariController;



// Home
Route::get('/', [CampeonController::class, 'index'])->name('home');
Route::get('/campeones-public/ajax', [CampeonController::class, 'ajax'])->name('campeones-public.ajax');

// Login
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);

// Logout
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Redirección a la página de inicio después de iniciar sesión
Route::get('/home-users', function () { return view('home-users'); })->middleware('auth');;

// Recuperar contraseña via correo electrónico
Route::get('/forgot-password', [PasswordResetController::class, 'showRequestForm'])->name('password.request');
Route::post('/forgot-password', [PasswordResetController::class, 'sendResetLink'])->name('password.email');

Route::get('/reset-password', [PasswordResetController::class, 'showResetForm'])->name('password.reset');
Route::post('/reset-password', [PasswordResetController::class, 'reset'])->name('password.update');

// Registro
Route::get('/register', [RegisterController::class, 'show'])->name('register');
Route::post('/register', [RegisterController::class, 'store']);


// Vistas dentro del Login
Route::middleware(['auth'])->group(function () {
    // Home user 
    Route::get('/home-users', [CampeonControllerLogin::class, 'index'])->name('home-users');
    Route::get('/campeones/ajax', [CampeonControllerLogin::class, 'ajax'])->name('campeones.ajax');
    
    // Editar Champions
    Route::get('/campeones/{id}/editar', [CampeonControllerLogin::class, 'edit'])->name('campeones.edit');
    Route::post('/campeones/{id}/actualizar', [CampeonControllerLogin::class, 'update'])->name('campeones.update');
    
    // Eliminar Champions
    Route::delete('/campeones/{id}/eliminar', [CampeonControllerLogin::class, 'destroy'])->name('campeones.destroy');
    
    // Crear Champion
    Route::get('/campeones/crear', [CampeonControllerLogin::class, 'create'])->name('campeones.create');
    Route::post('/campeones/guardar', [CampeonControllerLogin::class, 'store'])->name('campeones.store');

    // Editar Perfil
    Route::get('/perfil/editar', [PerfilController::class, 'edit'])->name('perfil.edit');
    Route::put('/perfil/actualizar', [PerfilController::class, 'update'])->name('perfil.update');

    // Cambiar contraseña
    Route::get('/perfil/cambiar-contrasenya', [PerfilController::class, 'editPassword'])->name('perfil.password');
    Route::put('/perfil/cambiar-contrasenya', [PerfilController::class, 'updatePassword'])->name('perfil.password.update');

    // Crear equipo
    Route::get('/equipos/crear')->name('equipos.create');
    Route::post('/equipos')->name('equipos.store');

    // Ver equipos
    Route::get('/equipos')->name('equipos.index');

    // Ver equipo individual (detalles)
    Route::get('/equipos/{equipo}')->name('equipos.show');

    // Administrar usuarios
    Route::get('/admin/usuarios', [UsuariController::class, 'index'])->name('admin.usuaris.index');
    Route::delete('/admin/usuarios/{nickname}', [UsuariController::class, 'destroy'])->name('admin.usuaris.destroy');
});

