<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Spatie\Permission\Models\Role;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
})->name('index');

Auth::routes([
    'register'  => false,
    'reset'     => false,
    'confirm'   => false
]);

Route::middleware(['auth'])->get('/home', [DashboardController::class, 'index'])->name('home');

Route::prefix('admin')->middleware(['auth'])->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('admin');
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::controller(UserController::class)->group(function () {
        Route::get('user', 'index')->middleware(['permission:index user'])->name('user.index');
        Route::post('user', 'store')->middleware(['permission:store user'])->name('user.store');
        Route::get('user/{id}', 'show')->middleware(['permission:show user'])->name('user.show');
        Route::put('user/{id}', 'update')->middleware(['permission:update user'])->name('user.update');
        Route::delete('user/{id}', 'delete')->middleware(['permission:delete user'])->name('user.delete');
    });
});
