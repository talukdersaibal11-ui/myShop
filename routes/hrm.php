<?php

use App\Http\Controllers\Admin\HRM\DepartmentController;
use App\Http\Controllers\Admin\HRM\DesignationController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum'])->group(function(){
    Route::prefix('department')->group(function(){
        Route::controller(DepartmentController::class)->group(function(){
            Route::get('/', 'index');
            Route::get('/list', 'list');
            Route::post('/', 'store');
            Route::get('/{id}', 'show');
            Route::put('/{id}', 'update');
            Route::delete('/{id}', 'destroy');
        });
    });

    Route::prefix('designation')->group(function(){
        Route::controller(DesignationController::class)->group(function(){
            Route::get('/', 'index');
            Route::get('/list', 'list');
            Route::post('/', 'store');
            Route::get('/{id}', 'show');
            Route::put('/{id}', 'update');
            Route::delete('/{id}', 'destroy');
        });
    });
});
