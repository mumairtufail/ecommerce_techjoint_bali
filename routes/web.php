<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\{
    IndexController,
    ShopController,
    AboutController,
    ContactController,
    OrderController as WebOrderController,
    
};
use App\Http\Controllers\Admin\{
    IndexController as AdminIndexController,
    ProductController,
    CategoryController,
    OrderController,
    SettingsController,
    AuthController,
    ProductSizeController,
    ProductColorController,
};
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CustomerController;


/*
|--------------------------------------------------------------------------
| Frontend Routes
|--------------------------------------------------------------------------
*/

Route::get('/', [IndexController::class, 'index'])->name('web.view.index');
Route::get('/shop', [ShopController::class, 'view'])->name('web.view.shop');
Route::get('/about-us', [AboutController::class, 'view'])->name('web.view.about');
Route::get('/contact', [ContactController::class, 'view'])->name('web.view.contact');
Route::post('/contact', [ContactController::class, 'submitContact'])->name('web.contact.submit');
Route::get('/orders-web', [WebOrderController::class, 'view'])->name('web.order');

// Product Details Route
Route::get('/product/{id}', [ShopController::class, 'show'])->name('web.product.details');
// Route::get('/products/{id}', [ShopController::class, 'viewtest'])->name('web.products.view');

// New route to store the order

Route::get('/checkout', [WebOrderController::class, 'view'])->name('web.orders.view');
Route::get('/payment', [WebOrderController::class, 'payment'])->name('web.payment.view');
Route::post('/orders/store', [WebOrderController::class, 'storeWebOrders'])->name('web.orders.store');

// OTP validation endpoints
Route::post('/customer/send-otp', [CustomerController::class, 'sendOtp'])->name('customer.send-otp');
Route::post('/customer/verify-otp', [CustomerController::class, 'verifyOtp'])->name('customer.verify-otp');



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
    Route::get('/admin/products/create', [ProductController::class, 'create'])->name('admin.products.create'); // Add this
    Route::post('/admin/products', [ProductController::class, 'store'])->name('admin.products.store');
    Route::get('/admin/products/{product}', [ProductController::class, 'show'])->name('admin.products.show'); // Add this
    Route::get('/admin/products/{product}/edit', [ProductController::class, 'edit'])->name('admin.products.edit');
    Route::put('/admin/products/{product}', [ProductController::class, 'update'])->name('admin.products.update');
    Route::delete('/admin/products/{product}', [ProductController::class, 'destroy'])->name('admin.products.destroy');
    
    // Categories Management
    Route::get('/admin/categories', [CategoryController::class, 'index'])->name('admin.categories.index');
    Route::post('/admin/categories', [CategoryController::class, 'store'])->name('admin.categories.store');
    Route::get('/admin/categories/{category}/edit', [CategoryController::class, 'edit'])->name('admin.categories.edit');
    Route::put('/admin/categories/{category}', [CategoryController::class, 'update'])->name('admin.categories.update');
    Route::delete('/admin/categories/{category}', [CategoryController::class, 'destroy'])->name('admin.categories.destroy');
    
    // Orders
    Route::get('/admin/orders', [OrderController::class, 'index'])->name('admin.orders.index');
    Route::get('/admin/orders/{id}', [OrderController::class, 'show'])->name('admin.orders.show');
    Route::put('/admin/orders/{id}/status', [OrderController::class, 'updateStatus'])->name('admin.orders.updateStatus');

    // Product Sizes Management
    Route::get('/admin/sizes', [ProductSizeController::class, 'index'])->name('admin.sizes.index');
    Route::post('/admin/sizes', [ProductSizeController::class, 'store'])->name('admin.sizes.store');
    Route::put('/admin/sizes/{size}', [ProductSizeController::class, 'update'])->name('admin.sizes.update');
    Route::delete('/admin/sizes/{size}', [ProductSizeController::class, 'destroy'])->name('admin.sizes.destroy');
    Route::patch('/admin/sizes/{size}/toggle', [ProductSizeController::class, 'toggleStatus'])->name('admin.sizes.toggle');

    // Product Colors Management
    Route::get('/admin/colors', [ProductColorController::class, 'index'])->name('admin.colors.index');
    Route::post('/admin/colors', [ProductColorController::class, 'store'])->name('admin.colors.store');
    Route::put('/admin/colors/{color}', [ProductColorController::class, 'update'])->name('admin.colors.update');
    Route::delete('/admin/colors/{color}', [ProductColorController::class, 'destroy'])->name('admin.colors.destroy');
    Route::patch('/admin/colors/{color}/toggle', [ProductColorController::class, 'toggleStatus'])->name('admin.colors.toggle');
    // Banners
  

    // contact

    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::post('/update-profile', [ProfileController::class, 'update'])->name('profile.update');

    Route::get('/settings', [SettingsController::class, 'index'])->name('settings.index');
    Route::put('/settings/banners', [SettingsController::class, 'updateBanners'])->name('settings.update.banners');
    Route::get('/queries', [\App\Http\Controllers\QueryController::class, 'index'])->name('admin.queries.index');
    // Logout Route
    Route::post('/logout', [AuthController::class, 'logout'])->name('admin.logout');
});

Route::get('/login', function () {
    return view('Auth.login');
})->name('login');

Route::get('/create-storage-link', function () {
    $target = storage_path('app/public');
    $link = public_path('storage');

    if (file_exists($link)) {
        return 'The storage link already exists at <code>public/storage</code>.';
    }

    // Try to create the symlink
    try {
        symlink($target, $link);
        return 'Symlink created successfully! <br> public/storage → storage/app/public';
    } catch (\Exception $e) {
        return 'Failed to create symlink.<br>Error: ' . $e->getMessage();
    }
});
Route::get('/remove-storage-link', function () {
    $link = public_path('storage');

    if (file_exists($link)) {
        if (is_link($link)) {
            // It's a symlink
            unlink($link);
            return 'Symlink public/storage removed successfully!';
        } elseif (is_dir($link)) {
            // It's a directory
            $files = scandir($link);
            if (count($files) <= 2) {
                // Directory is empty (only . and ..)
                rmdir($link);
                return 'Directory public/storage (was not a symlink) and is now removed as it was empty.';
            } else {
                return 'public/storage is a directory and not empty. Not removing to prevent data loss.<br>Please remove files inside manually if you want to delete the folder.';
            }
        } else {
            return 'public/storage exists but is not a directory or symlink!';
        }
    } else {
        return 'public/storage does not exist.';
    }
});

Route::get('/force-reset-storage-link', function () {
    $link = public_path('storage');
    $target = storage_path('app/public');

    // Helper to recursively delete directory
    function rrmdir($dir) {
        if (!file_exists($dir)) return;
        foreach (scandir($dir) as $item) {
            if ($item == '.' || $item == '..') continue;
            $path = $dir . DIRECTORY_SEPARATOR . $item;
            if (is_dir($path)) {
                rrmdir($path);
            } else {
                unlink($path);
            }
        }
        rmdir($dir);
    }

    // Remove existing link or directory
    if (file_exists($link)) {
        if (is_link($link) || is_file($link)) {
            unlink($link);
        } elseif (is_dir($link)) {
            rrmdir($link); // Fully recursive delete!
        }
    }

    // Try to create the symlink
    try {
        symlink($target, $link);
        return 'Symlink recreated successfully! <br> public/storage → storage/app/public';
    } catch (\Exception $e) {
        return 'Failed to create symlink.<br>Error: ' . $e->getMessage();
    }
});


Route::post('/login', [AuthController::class, 'login'])->name('admin.login');
