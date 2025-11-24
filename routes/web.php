<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Rotas para autenticação por sessão e CRUD de produtos.
|
use App\Models\User;
use Illuminate\Support\Facades\Hash;

// criar usuário novo
User::create([
    'name' => 'teste',
    'password' => Hash::make('senha123'),
]);
*/

// Login (apenas para guests)
Route::get('login', [AuthController::class, 'showLogin'])
    ->middleware('guest')
    ->name('login');

Route::post('login', [AuthController::class, 'login'])
    ->middleware('guest')
    ->name('login.attempt');

// Logout (apenas para usuários autenticados)
Route::post('logout', [AuthController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');

// Rotas protegidas por autenticação
Route::middleware('auth')->group(function () {
    // Home -> lista de produtos
    Route::get('/', [ProductController::class, 'index'])->name('home');

    // Resource routes para CRUD de produtos
    Route::resource('products', ProductController::class);
});
