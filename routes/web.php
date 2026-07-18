<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TecnicoController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\ProveedorController;
use App\Http\Controllers\AlmacenController;
use App\Http\Controllers\MarcaController;

use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('auth.login');
})->middleware('guest');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');


    # Users
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
    Route::post('/users', [UserController::class, 'store'])->name('users.store');
    Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');
    Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');

    #Techniques
    Route::get('/tecnicos', [TecnicoController::class, 'index'])->name('tecnicos.index');
    Route::post('/tecnicos', [TecnicoController::class, 'store'])->name('tecnicos.store');
    Route::get('/tecnicos/{tecnico}/edit', [TecnicoController::class, 'edit'])->name('tecnicos.edit');
    Route::put('/tecnicos/{tecnico}', [TecnicoController::class, 'update'])->name('tecnicos.update');
    Route::delete('/tecnicos/{tecnico}', [TecnicoController::class, 'destroy'])->name('tecnicos.destroy');

    #Clientes
    Route::get('/clientes', [ClienteController::class, 'index'])->name('clientes.index');
    Route::post('/clientes', [ClienteController::class, 'store'])->name('clientes.store');
    Route::get('/clientes/{cliente}/edit', [ClienteController::class, 'edit'])->name('clientes.edit');
    Route::put('/clientes/{cliente}', [ClienteController::class, 'update'])->name('clientes.update');
    Route::delete('/clientes/{cliente}', [ClienteController::class, 'destroy'])->name('clientes.destroy');

    #Proveedores
    Route::get('/proveedores', [ProveedorController::class, 'index'])->name('proveedores.index');
    Route::post('/proveedores', [ProveedorController::class, 'store'])->name('proveedores.store');
    Route::get('/proveedores/{proveedor}/edit', [ProveedorController::class, 'edit'])->name('proveedores.edit');
    Route::put('/proveedores/{proveedor}', [ProveedorController::class, 'update'])->name('proveedores.update');
    Route::delete('/proveedores/{proveedor}', [ProveedorController::class, 'destroy'])->name('proveedores.destroy');

    #Marcas y Modelos
    Route::get('/marcas-modelos', [AlmacenController::class, 'indexMarcasModelos'])->name('marcas_y_modelos.index');
    Route::post('/marcas', [MarcaController::class, 'store'])->name('marcas.store');
    Route::get('/marcas/{marca}/edit', [MarcaController::class, 'edit'])->name('marcas.edit');
    Route::put('/marcas/{marca}', [MarcaController::class, 'update'])->name('marcas.update');
    Route::delete('/marcas/{marca}', [MarcaController::class, 'destroy'])->name('marcas.destroy');

    Route::post('/modelos', [ModeloController::class, 'store'])->name('modelos.store');
    Route::get('/modelos/{modelo}/edit', [ModeloController::class, 'edit'])->name('modelos.edit');
    Route::put('/modelos/{modelo}', [ModeloController::class, 'update'])->name('modelos.update');
    Route::delete('/modelos/{modelo}', [ModeloController::class, 'destroy'])->name('modelos.destroy');
});

require __DIR__.'/auth.php';
