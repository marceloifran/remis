<?php

use App\Http\Controllers\ChoferController;
use App\Http\Controllers\ExtrasController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VehiculoController;
use App\Http\Controllers\ViajeController;
use App\Http\Controllers\ZonasController;
use App\Models\extras;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
  return redirect('/login');
}); 

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::resource('usuarios', UserController::class)->middleware('auth');
    Route::resource('extras', ExtrasController::class)->middleware('auth');
    Route::resource('viajes', ViajeController::class)->middleware('auth');
    Route::resource('zonas', ZonasController::class)->middleware('auth');

    Route::get('/api/zonas/{id}', [ViajeController::class, 'buscarZona']);
    
    Route::post('/viajes', [ViajeController::class,'store'])->name('viajes.store');

    Route::delete('viajes/{viaje}', [ViajeController::class, 'destroy'])->name('viajes.destroy');


});

require __DIR__.'/auth.php';
