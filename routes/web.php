<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\AuthController;
use App\Http\Controllers\Frontend\PageController;
use App\Http\Controllers\Frontend\CartController; // Sirf ek baar import karein

// Public Routes
Route::get("/", [PageController::class, "home"])->name("home");
Route::post("/dokan-registration", [PageController::class, "dokan_registration"])->name("dokan_registration");
Route::get("/product/{slug}", [PageController::class, "product"])->name("product");
Route::get("/products", [PageController::class, "products"])->name("products");
Route::get("/deals", [PageController::class, "deals"])->name("deals");

// Guest Routes (Sirf unke liye jo logged in nahi hain)
Route::middleware("guest")->group(function () {
    Route::get("/login", [AuthController::class, "login"])->name("login");

    // Google Auth Routes
    Route::get("/auth/google", [AuthController::class, "redirect"])->name("google.redirect");
    Route::get("/google/callback", [AuthController::class, "callback"])->name("google.callback");
});

// Authenticated Routes (Sirf logged in users ke liye)
Route::middleware("auth")->group(function () {
    Route::delete("/logout", [AuthController::class, "logout"])->name("logout");

    // Cart Routes
    Route::get("/carts", [CartController::class, "index"])->name("cart.index");
    Route::post("/add-to-cart", [CartController::class, "store"])->name("cart.store");
    Route::patch('/cart/update/{id}', [CartController::class, 'update'])->name('cart.update');
    Route::delete('/cart/remove/{id}', [CartController::class, 'delete'])->name('cart.remove');
    Route::delete('/cart/clear', [CartController::class, 'clear_cart'])->name('cart.clear');

    // Checkout Routes
    Route::get('/checkout/{dokanId}', [CartController::class, 'checkoutDokan'])->name('checkout.dokan');
    Route::post('/checkout/direct', [CartController::class, 'direct'])->name('checkout.direct');

    Route::get('/product/{id}', [CartController::class, 'show'])->name('product.show');

});
