<?php

use Livewire\Volt\Volt;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


Route::permanentRedirect('/','/dashboard')->name('root');

Auth::routes();

Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('dashboard');

Route::middleware('auth:sanctum')->group(function () {
  Volt::route('/users', 'pages.users')->name('users');
});
