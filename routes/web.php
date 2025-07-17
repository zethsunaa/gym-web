<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;

Route::get('/', function () {
    return view('index');
});

//Login
Route::get('/index', [LoginController::class, 'home']);
Route::get('/login', [LoginController::class, 'index']);
Route::post('/login/process', [LoginController::class, 'process_login']);
Route::post('/logout', [LoginController::class, 'process_logout'])->name('logout');

Route::get('/admin_dashboard', function () {
    return view('admin_dashboard');
});
Route::get('/chest', function () {
    return view('chest');
});

