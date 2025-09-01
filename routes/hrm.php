<?php

use App\Http\Controllers\Admin\HRM\DepartmentController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum'])->group(function(){
    Route::prefix('department')->group(function(){
        Route::controller(DepartmentController::class)->group(function(){
            Route::get('/', 'index');
            Route::get('/list', 'list');
            Route::post('/', 'store');
            Route::put('/{id}', 'update');
            Route::delete('/{id}', 'destroy');
        });
    });
});
