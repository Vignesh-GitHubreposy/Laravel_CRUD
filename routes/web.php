<?php

use Illuminate\Support\Facades\Auth;
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
    return view('welcome');
});

Auth::routes();

Route::get('/customer', [App\Http\Controllers\CustomerController::class, 'index'])->name('index');
Route::get('/edit/{id}', [App\Http\Controllers\CustomerController::class, 'edit'])->name('edit');
Route::get('/delete/{id}', [App\Http\Controllers\CustomerController::class, 'destroy'])->name('destroy');
Route::post('/add', [App\Http\Controllers\CustomerController::class, 'store'])->name('store');
Route::post('/update', [App\Http\Controllers\CustomerController::class, 'update'])->name('update');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
