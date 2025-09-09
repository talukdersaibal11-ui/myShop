<?php

use App\Http\Controllers\Admin\HRM\AttendanceController;
use App\Http\Controllers\Admin\HRM\DepartmentController;
use App\Http\Controllers\Admin\HRM\DesignationController;
use App\Http\Controllers\Admin\HRM\EmployeeController;
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

    Route::prefix('employee')->group(function(){
        Route::controller(EmployeeController::class)->group(function(){
            Route::get('/', 'index');
            Route::post('/', 'store');
            Route::get('/{id}', 'show');
            Route::put('/{id}', 'update');
            Route::delete('/{id}', 'destroy');
        });
    });

    Route::prefix('attendance')->group(function(){
        Route::controller(AttendanceController::class)->group(function(){
            Route::get('/', 'index');
            Route::post('/', 'store');
            Route::get('/{id}', 'show');
            Route::put('/{id}', 'update');
            Route::delete('/{id}', 'destroy');
        });
    });
});
