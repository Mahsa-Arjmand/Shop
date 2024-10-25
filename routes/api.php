<?php
use App\Http\Controllers\ProductController;

Route::post('products', [ProductController::class, 'store']); // Create product
Route::put('products/{id}', [ProductController::class, 'update']); // Update product
Route::delete('products/{id}', [ProductController::class, 'destroy']); // Delete product
Route::get('products', [ProductController::class, 'index']); // Get all products
Route::get('products/customer/{customerId}', [ProductController::class, 'getProductsByCustomer']); // Get all products specific to a user
