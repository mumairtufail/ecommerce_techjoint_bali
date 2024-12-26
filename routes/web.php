<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\{
    IndexController,
    ShopController,
    AboutController,
    ContactController,
};
use App\Http\Controllers\Admin\{
    IndexController as AdminIndexController,
    ProductController,
    OrderController,
    SettingsController,
    BannerController,
    AuthController,
};

/*
|--------------------------------------------------------------------------
| Frontend Routes
|--------------------------------------------------------------------------
*/

Route::get('/', [IndexController::class, 'index'])->name('web.view.index');
Route::get('/shop', [ShopController::class, 'view'])->name('web.view.shop');
Route::get('/about-us', [AboutController::class, 'view'])->name('web.view.about');
Route::get('/contact', [ContactController::class, 'view'])->name('web.view.contact');

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])->group(function () {
    // Dashboard
    Route::get('/home', [AdminIndexController::class, 'index'])->name('admin.dashboard');

    // Products Management - Individual Routes
    Route::get('/admin/products', [ProductController::class, 'index'])->name('admin.products.index');
    Route::post('/admin/products', [ProductController::class, 'store'])->name('admin.products.store');
    Route::get('/admin/products/{product}/edit', [ProductController::class, 'edit'])->name('admin.products.edit');
    Route::put('/admin/products/{product}', [ProductController::class, 'update'])->name('admin.products.update');
    Route::delete('/admin/products/{product}', [ProductController::class, 'destroy'])->name('admin.products.destroy');

    // Orders
    Route::get('/admin/orders', [OrderController::class, 'index'])->name('admin.orders.index');

    // Banners
    Route::apiResource('/admin/banners', BannerController::class);

    // Logout Route
    Route::post('/logout', [AuthController::class, 'logout'])->name('admin.logout');
});

Route::get('/login', function () {
    return view('Auth.login');
})->name('login');

Route::post('/login', [AuthController::class, 'login'])->name('admin.login');
