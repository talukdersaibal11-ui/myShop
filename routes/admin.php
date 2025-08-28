<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\SubCategoryController;
use Illuminate\Support\Facades\Route;

Route::controller(AuthController::class)->group(function(){
    Route::post('/login', 'login');
});


Route::middleware(['auth:sanctum'])->group(function(){
    Route::prefix('category')->group(function(){
        Route::controller(CategoryController::class)->group(function(){
            Route::get("/", 'index');
            Route::post("/", 'store');
            Route::put("/{id}", 'update');
            Route::delete("/{id}", 'destroy');
        });
    });

    Route::prefix('subcategory')->group(function(){
        Route::controller(SubCategoryController::class)->group(function(){
            Route::get("/", 'index');
            Route::post("/", 'store');
            Route::put("/{id}", 'update');
            Route::delete("/{id}", 'destroy');
        });
    });
});
