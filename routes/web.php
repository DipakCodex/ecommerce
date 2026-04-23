<?php


use App\Http\Controllers\Frontend\AuthController;

use App\Http\Controllers\Frontend\PageController;
use App\Http\Controllers\Frontend\CartController;
// use Illuminate\Container\Attributes\Auth;
use Illuminate\Support\Facades\Route;


// Route::get('/', function () {
//     return view('welcome');
// });

Route::get("/", [PageController::class, "home"])->name("home");

Route::Post("/dokan-registration", [PageController::class, "dokan_registration"])->name("dokan_registration");

// Routes/web.php ma yesto huna parchha:
Route::get('auth/google', [AuthController::class, 'redirect'])->name('auth.google');



Route::get("/product/{slug}", [PageController::class, "product"])->name("product");
Route::get("/products", [PageController::class, "products"])->name("products");
Route::get("/deals", [PageController::class, "deals"])->name("deals");

Route::middleware("guest")->group(function () {
    Route::get("/login", [AuthController::class, "login"])->name("login");
    Route::get("/google/redirect", [AuthController::class, "redirect"])->name("google.redirect");
    Route::get("/google/callback", [AuthController::class, "callback"])->name("google.callback");
});

Route::middleware("auth")->group(function () {
    Route::delete("/logout", [AuthController::class, "logout"])->name("logout");


Route::get("/carts", [CartController::class, "index"])->name("cart.index");
    Route::post("/add-to-cart", [CartController::class, "store"])->name("cart.store");
    Route::post('/checkout/direct', [CartController::class, 'direct'])->name('checkout.direct');
    Route::post('/cart/update/{id}', [CartController::class, 'update'])->name('cart.update');
    Route::delete('/cart/remove/{id}', [CartController::class, 'delete'])->name('cart.remove'); // Method name matched 'remove' or 'delete'
    Route::delete('/cart/clear', [CartController::class, 'clear_cart'])->name('cart.clear');

       Route::post('/checkout/dokan/{dokan}', [CartController::class, 'checkoutDokan'])->name('checkout.dokan');

});
