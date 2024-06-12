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

    Route::resource('permission', PermissionController::class);
    // Route::get('permissions/{permissionId}/delete', [PermissionController::class, 'destroy']);

    Route::resource('role', RoleController::class);
    // Route::get('roles/{roleId}/delete', [RoleController::class, 'destroy']);
    Route::get('role/{roleId}/give-permissions', [RoleController::class, 'addPermissionToRole']);
    Route::put('role/{roleId}/give-permissions', [RoleController::class, 'givePermissionToRole']);

    Route::resource('user', UserController::class);
    // Route::get('users/{userId}/delete', [UserController::class, 'destroy']);

});

require __DIR__.'/auth.php';
