<?php

use App\Http\Controllers\Api\v1\CategoriesController;
use App\Http\Controllers\Api\v1\ProductsController;
use Illuminate\Support\Facades\Route;

// Route::resource('products', ProductsController::class);
// Route::resource('categories', CategoriesController::class);

Route::resources([
    'products' => ProductsController::class,
    'categories' => CategoriesController::class,
]);

Route::get('categories/{category}/products', [CategoriesController::class, 'products']);
