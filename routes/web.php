<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfileController;

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
Route::get('/user_dashboard', [UserController::class, 'dashboard'])->name('user_dashboard');
Route::get('/admin_dashboard', [AdminController::class, 'dashboard'])->name('admin_dashboard');
Route::post('/update-type/{userId}', [AdminController::class, 'updateType'])->name('admin.updateType');
Route::post('/upload-profile-image', [ProfileController::class, 'uploadProfileImage'])->name('upload-profile-image');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
