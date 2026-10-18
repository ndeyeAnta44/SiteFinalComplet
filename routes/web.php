<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;

/*
|--------------------------------------------------------------------------
| FRONT
|--------------------------------------------------------------------------
*/

// Accueil
Route::get('/', [HomeController::class, 'index']);

// Boutique + Recherche
Route::get('/shop', [StoreController::class, 'shop']);
Route::get('/search', [StoreController::class, 'shop']); // même méthode, lit ?q=

// Catégorie
Route::get('/category/{id}', [StoreController::class, 'byCategory']);

// Produit détail
Route::get('/product/{id}', function ($id) {
    $product = \App\Models\Product::with('category')->findOrFail($id);
    return view('product', compact('product'));
});

/*
|--------------------------------------------------------------------------
| PANIER
|--------------------------------------------------------------------------
*/
Route::get('/cart',              [CartController::class, 'index']);
Route::get('/add-to-cart/{id}',  [CartController::class, 'add']);
Route::post('/cart/update',      [CartController::class, 'update']);
Route::get('/cart/remove/{id}',  [CartController::class, 'remove']);
Route::get('/cart/clear',        [CartController::class, 'clear']);

/*
|--------------------------------------------------------------------------
| CHECKOUT / COMMANDES
|--------------------------------------------------------------------------
*/
Route::get('/checkout',  [OrderController::class, 'checkout'])->middleware('auth');
Route::post('/checkout', [OrderController::class, 'placeOrder'])->middleware('auth');
Route::get('/orders',    [OrderController::class, 'myOrders'])->middleware('auth');
Route::get('/orders/{id}', [OrderController::class, 'show'])->middleware('auth');

/*
|--------------------------------------------------------------------------
| AUTH
|--------------------------------------------------------------------------
*/
Route::get('/login',    [AuthController::class, 'showLogin'])->name('login');
Route::post('/login',   [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegister']);
Route::post('/register',[AuthController::class, 'register']);
Route::post('/logout',  [AuthController::class, 'logout'])->name('logout');

/*
|--------------------------------------------------------------------------
| ADMIN
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {

    // Dashboard
    Route::get('/', function () {
        return view('admin.dashboard');
    });

    // PRODUITS
    Route::get('/products',              [AdminProductController::class, 'index']);
    Route::get('/products/create',       [AdminProductController::class, 'create']);
    Route::post('/products',             [AdminProductController::class, 'store']);
    Route::get('/products/{id}/edit',    [AdminProductController::class, 'edit']);
    Route::put('/products/{id}',         [AdminProductController::class, 'update']);
    Route::delete('/products/{id}',      [AdminProductController::class, 'destroy']);

    // CATÉGORIES
    Route::get('/categories',            [CategoryController::class, 'index']);
    Route::post('/categories',           [CategoryController::class, 'store']);
    Route::put('/categories/{id}',       [CategoryController::class, 'update']);
    Route::delete('/categories/{id}',    [CategoryController::class, 'destroy']);

    // COMMANDES
    Route::get('/orders',                [OrderController::class, 'adminIndex']);
    Route::put('/orders/{id}/status',    [OrderController::class, 'updateStatus']);

    // UTILISATEURS
    Route::get('/users', function () {
        $users = \App\Models\User::latest()->get();
        return view('admin.users', compact('users'));
    });
});
