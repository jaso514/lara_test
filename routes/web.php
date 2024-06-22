<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\AdminController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;

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

Route::group(['middleware' => ['admin'], 'prefix' => 'back_admin', 'as' => 'admin.'], function() {

    Route::get('/', [AdminController::class, 'index'])->name('home');
    Route::get('/account_settings/profile', [AdminController::class, 'index'])->name('profile');
    Route::get('/account_settings/change_password', [AdminController::class, 'index'])->name('change_password');

    Route::resource('permission', PermissionController::class);

    Route::resource('role', RoleController::class);

    Route::resource('user', UserController::class);

});

require __DIR__.'/auth.php';
