<?php

use App\Http\Controllers\BrandController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\CommuneController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\WilayaController;
use App\Http\Middleware\GlobalTokenAuth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;




Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});
Route::middleware("global_token")->group(function () {
    Route::apiResource('products',ProductController::class);
    Route::apiResource('categories',CategoryController::class);
    Route::apiResource('brands',BrandController::class);
    Route::apiResource('tags',TagController::class);
    Route::apiResource('wilayas',WilayaController::class);
    Route::apiResource('communes',WilayaController::class);
    Route::apiResource('cities',WilayaController::class);
    Route::apiResource('communes',CommuneController::class);
    Route::apiResource('cities',CityController::class);
    Route::get('search', [ProductController::class, 'search'])->name('search');
    Route::get('categories/{category}/products', CategoryController::class.'@products')->name('categories.products.all');
    Route::put('products/{product}/categories', [ProductController::class, 'syncCategories'])->name('products.categories.sync');
    Route::put('products/{product}/tags', [ProductController::class, 'syncTags'])->name('products.tags.sync');
    Route::put('products/{product}/sync', [ProductController::class, 'sync'])->name('products.sync');
    Route::post('products/{product}/uploadImage', [ProductController::class, 'uploadImage'])->name('products.uploadImage');
});

Route::prefix('v2')->group(function () {
    Route::middleware("global_token")->group(function () {
        Route::apiResource('products', App\Http\Controllers\v2\ProductController::class);
        Route::apiResource('categories',App\Http\Controllers\v2\CategoryController::class);
        Route::apiResource('brands',App\Http\Controllers\v2\BrandController::class);
        Route::apiResource('tags',App\Http\Controllers\v2\TagController::class);
        Route::apiResource('wilayas',App\Http\Controllers\v2\WilayaController::class);
        Route::apiResource('communes',App\Http\Controllers\v2\WilayaController::class);
        Route::apiResource('cities',App\Http\Controllers\v2\WilayaController::class);
        Route::apiResource('communes',App\Http\Controllers\v2\CommuneController::class);
        Route::apiResource('cities',App\Http\Controllers\v2\CityController::class);
        Route::get('search', [ProductController::class, 'search'])->name('search');
        Route::get('categories/{category}/products', App\Http\Controllers\v2\CategoryController::class.'@products')->name('categories.products.all');
        Route::put('products/{product}/categories', [App\Http\Controllers\v2\ProductController::class, 'syncCategories'])->name('products.categories.sync');
        Route::put('products/{product}/tags', [App\Http\Controllers\v2\ProductController::class, 'syncTags'])->name('products.tags.sync');
        Route::put('products/{product}/sync', [App\Http\Controllers\v2\ProductController::class, 'sync'])->name('products.sync');
        Route::post('products/{product}/uploadImage', [App\Http\Controllers\v2\ProductController::class, 'uploadImage'])->name('products.uploadImage');
    });
});


