<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\SizeController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ColorController;
use App\Http\Controllers\Admin\SubCategoryController;

Route::controller(AuthController::class)->group(function(){
    Route::post('/login', 'login');
});


Route::middleware(['auth:sanctum'])->group(function(){
    Route::prefix('category')->group(function(){
        Route::controller(CategoryController::class)->group(function(){
            Route::get("/", 'index');
            Route::get("/list", 'list');
            Route::post("/", 'store');
            Route::put("/{id}", 'update');
            Route::delete("/{id}", 'destroy');
        });
    });

    Route::prefix('subcategory')->group(function(){
        Route::controller(SubCategoryController::class)->group(function(){
            Route::get("/", 'index');
            Route::get("/list", 'list');
            Route::post("/", 'store');
            Route::put("/{id}", 'update');
            Route::delete("/{id}", 'destroy');
        });
    });

    Route::prefix('brand')->group(function(){
        Route::controller(BrandController::class)->group(function(){
            Route::get("/", 'index');
            Route::get("/list", 'list');
            Route::post("/", 'store');
            Route::put("/{id}", 'update');
            Route::delete("/{id}", 'destroy');
        });
    });

    Route::prefix('size')->group(function(){
        Route::controller(SizeController::class)->group(function(){
            Route::get("/", 'index');
            Route::get("/list", 'list');
            Route::post("/", 'store');
            Route::put("/{id}", 'update');
            Route::delete("/{id}", 'destroy');
        });
    });

    Route::prefix('color')->group(function(){
        Route::controller(ColorController::class)->group(function(){
            Route::get("/", 'index');
            Route::get("/list", 'list');
            Route::post("/", 'store');
            Route::put("/{id}", 'update');
            Route::delete("/{id}", 'destroy');
        });
    });
});
