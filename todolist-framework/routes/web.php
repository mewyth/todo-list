<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\jadwalController;

//halaman utama
Route::resource('/jadwal', \App\Http\Controllers\jadwalController::class);
//login
Route::get('/login', [jadwalController::class, 'login'])->name('login');
Route::post('/login', [jadwalController::class, 'loginPost'])->name('login.post');
//register
Route::get('/register', [jadwalController::class, 'register'])->name('register');
Route::post('/register', [jadwalController::class, 'registerPost'])->name('register.post');

//logout
Route::get('/logout', [jadwalController::class, 'logout'])->name('logout');

//admin
Route::get('/admin', [jadwalController::class, 'viewAdmin'])->name('admin.index');

//testing
Route::get('/test', [jadwalController::class, 'test'])->name('test');