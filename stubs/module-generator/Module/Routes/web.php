<?php

use Modules\{Module}\Http\Controllers\{Module}Controller;
use Illuminate\Support\Facades\Route;
app()->make('router')->aliasMiddleware('permisson', \Spatie\Permission\Middlewares\PermissionMiddleware::class);

Route::middleware('auth')->prefix('admin/{module-}')->group(function() {
    Route::controller({Module}Controller::class)->group(function () {
        Route::get('/', 'index')->middleware(['permisson:read {module}'])->name('{module}.index');
        Route::post('/', 'store')->middleware(['permisson:create {module}'])->name('{module}.store');
        Route::post('/show', 'show')->middleware(['permisson:read {module}'])->name('{module}.show');
        Route::put('/', 'update')->middleware(['permisson:update {module}'])->name('{module}.update');
        Route::delete('/', 'destroy')->middleware(['permisson:delete {module}'])->name('{module}.destroy');
    });
});
