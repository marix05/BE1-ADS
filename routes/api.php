<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\KaryawanController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
Route::post("/login", [AuthController::class, 'login'])->name('auth.login');
Route::post("/register", [AuthController::class, 'register'])->name('auth.register');

Route::middleware('auth:sanctum')->group(function () {
    Route::post("/logout", [AuthController::class, 'logout'])->name('auth.logout');
    Route::delete("/user/{id}", [UserController::class, 'destroy'])->name('user.destroy');

    Route::get('karyawan', [KaryawanController::class, 'index'])->name('karyawan');
    Route::post('karyawan', [KaryawanController::class, 'store'])->name('karyawan.store');
    Route::get('karyawan/first-joined', [KaryawanController::class, 'karyawanFirstJoined'])->name('karyawan.firstJoined');
    Route::get('karyawan/with-cuti', [KaryawanController::class, 'karyawanWithCuti'])->name('karyawan.withCuti');
    Route::get('karyawan/sisa-cuti', [KaryawanController::class, 'karyawanSisaCuti'])->name('karyawan.sisaCuti');
    Route::get('karyawan/{noInduk}', [KaryawanController::class, 'show'])->name('karyawan.show');
    Route::put('karyawan/{noInduk}', [KaryawanController::class, 'update'])->name('karyawan.update');
    Route::delete('karyawan/{noInduk}', [KaryawanController::class, 'destroy'])->name('karyawan.destroy');
});

