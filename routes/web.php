<?php

use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\ChestController;
use App\Http\Controllers\LegController;
use App\Http\Controllers\BackController;
use App\Http\Controllers\ShoulderController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ChestViewController;

Route::get('/', function () {
    return view('index');
});

//Login
Route::get('/index', [LoginController::class, 'home']);
Route::get('/login', [LoginController::class, 'index']);
Route::post('/login/process', [LoginController::class, 'process_login']);
Route::post('/logout', [LoginController::class, 'process_logout'])->name('logout');


Route::get('/admin_dashboard', [AdminDashboardController::class,'index']);

// Chest Routes
Route::get('/chest_manage', [ChestController::class, 'read_chest']);
Route::post('/chest_insert', [ChestController::class,'insert_chest']);
Route::put('/chest_update', [ChestController::class,'update_chest']); // Rute UPDATE untuk Chest
Route::post('/chest_delete', [ChestController::class,'delete_chest']); // Tetap POST karena Anda mengaturnya begitu sebelumnya

// Leg Routes
Route::get('/leg_manage', [LegController::class,'read_leg']);
Route::post('/leg_insert', [LegController::class,'insert_leg']);
Route::put('/leg_update', [LegController::class,'update_leg']); // Rute UPDATE untuk Leg
Route::post('/leg_delete', [LegController::class,'delete_leg']); // Tetap POST

// Shoulder Routes
Route::get('/shoulder_manage', [ShoulderController::class,'read_shoulder']);
Route::post('/shoulder_insert', [ShoulderController::class,'insert_shoulder']);
Route::put('/shoulder_update', [ShoulderController::class,'update_shoulder']); // Rute UPDATE untuk Shoulder
Route::post('/shoulder_delete', [ShoulderController::class,'delete_shoulder']); // Tetap POST

// Back Routes
Route::get('/back_manage', [BackController::class,'read_back']);
Route::post('/back_insert', [BackController::class,'insert_back']);
Route::put('/back_update', [BackController::class,'update_back']); // Rute UPDATE untuk Back
Route::post('/back_delete', [BackController::class,'delete_back']); // Tetap POST

// User-facing Chest Exercises Route (New)
Route::get('/exercises/chest', [ChestViewController::class, 'index']); // Rute untuk menampilkan latihan dada ke pengguna
