<?php

use Illuminate\Support\Facades\Route;
use App\Models\Category;
use App\Models\Product;
use App\Http\Controllers\Front\ProductController;
use App\Http\Controllers\Front\CartController;
use App\Http\Controllers\Front\CheckoutController;
use App\Http\Controllers\Front\AuthController;
use App\Http\Controllers\Front\PageController;
use App\Http\Controllers\Front\CategoryController;

Route::get('/', function () {
    $categories = Category::where('is_active', true)->take(6)->get();
    $products = Product::with('category')
        ->where('is_active', true)
        ->latest()
        ->take(10)
        ->get();
    $banners = \App\Models\Banner::where('is_active', true)->orderBy('sort_order')->get();

    return view('home', compact('categories', 'products', 'banners'));
})->name('home');

// Static Pages
Route::get('/tentang-kami', [PageController::class, 'about'])->name('pages.about');
Route::get('/cara-belanja', [PageController::class, 'howToShop'])->name('pages.how-to-shop');
Route::get('/faq', [PageController::class, 'faq'])->name('pages.faq');
Route::get('/kontak', [PageController::class, 'contact'])->name('pages.contact');

// API Locations
Route::get('/api/destinations', [\App\Http\Controllers\Front\LocationController::class, 'destinations'])->name('api.destinations');
Route::post('/api/cost', [\App\Http\Controllers\Front\LocationController::class, 'checkCost'])->name('api.cost');

// Categories
Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');

Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/products/{slug}', [ProductController::class, 'show'])->name('products.show');

Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
Route::post('/cart/update', [CartController::class, 'update'])->name('cart.update');
Route::post('/cart/remove', [CartController::class, 'remove'])->name('cart.remove');

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');
    Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.post');
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/dashboard', [\App\Http\Controllers\Front\DashboardController::class, 'index'])->name('dashboard');
    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
    Route::post('/checkout', [CheckoutController::class, 'store'])->name('checkout.store');
    Route::get('/checkout/success/{id}', [CheckoutController::class, 'success'])->name('checkout.success');
});

// Midtrans Webhook
Route::post('/midtrans/callback', [CheckoutController::class, 'callback'])->name('midtrans.callback')->withoutMiddleware([\Illuminate\Foundation\Http\Middleware\VerifyCsrfToken::class]);
