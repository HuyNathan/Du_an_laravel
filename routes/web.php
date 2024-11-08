<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\Users\LoginController as AdminLoginController;
use App\Http\Controllers\Admin\MainController;
use App\Http\Controllers\Admin\MenuController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\UploadController;
use App\Http\Services\UploadService;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\User\LoginController as UserLoginController;
use App\Http\Controllers\User\RegisterController;
use App\Http\Controllers\EmailController;
use App\Http\Controllers\Admin\ThongKeController;


Route::post('/send-email', [EmailController::class, 'sendEmail']);

Route::get('/register', [RegisterController::class, 'index'])->name('user.register');
Route::post('/register', [RegisterController::class, 'store'])->name('user.register.store');

Route::middleware('auth')->group(function () {
    Route::get('/home', function () {
        return view('home');
    })->name('home.page'); // Đổi tên
});

// Route cho người dùng (khách)
Route::get('user/login', [UserLoginController::class, 'index'])->name('user.login');
Route::post('user/login', [UserLoginController::class, 'store'])->name('user.login.submit');
Route::post('user/logout', [UserLoginController::class, 'logout'])->name('user.logout');

Route::get('admin/users/login', [AdminLoginController::class, 'index'])->name('admin.login');
Route::post('admin/users/login/store', [AdminLoginController::class, 'store']);

Route::middleware(['auth'])->group(function () {
    Route::prefix('admin')->group(function () {
        Route::get('/', [MainController::class, 'index'])->name('admin');
        Route::get('main', [MainController::class, 'index'])->name('admin.main');
        

        // Thống Kê
        Route::prefix('statistics')->group(function () {
            Route::get('/', [ThongKeController::class, 'index'])->name('admin.statistics');
        });

        // Menu
        Route::prefix('menus')->group(function () {
            Route::get('add', [MenuController::class, 'create'])->name('admin.menus.create');
            Route::post('add', [MenuController::class, 'store'])->name('admin.menus.store');
            Route::get('edit/{menu}', [MenuController::class, 'show']);
            Route::get('list', [MenuController::class, 'index'])->name('admin.menus.index');
            Route::delete('destroy/{id}', [MenuController::class, 'destroy'])->name('admin.menus.destroy');
            Route::put('update/{id}', [MenuController::class, 'update'])->name('admin.menus.update');
        });

        // Product List
        Route::prefix('products')->group(function () {
            Route::get('add', [ProductController::class, 'create'])->name('admin.products.create');
            Route::post('add', [ProductController::class, 'store'])->name('admin.products.store');
            Route::get('list', [ProductController::class, 'index'])->name('admin.products.index');
            Route::get('edit/{product}', [ProductController::class, 'show'])->name('admin.products.edit');
            Route::post('edit/{product}', [ProductController::class, 'update'])->name('admin.products.update');
            Route::delete('destroy/{id}', [ProductController::class, 'destroy'])->name('admin.products.destroy');
        });

        // Slider
        Route::prefix('sliders')->group(function () {
            Route::get('add', [SliderController::class, 'create'])->name('admin.slider.create');
            Route::post('add', [SliderController::class, 'store'])->name('admin.slider.store');
            Route::get('list', [SliderController::class, 'index'])->name('admin.slider.index');
            Route::get('edit/{slider}', [SliderController::class, 'show'])->name('admin.slider.edit');
            Route::post('edit/{slider}', [SliderController::class, 'update'])->name('admin.slider.update');
            Route::delete('destroy/{id}', [SliderController::class, 'destroy'])->name('admin.slider.destroy');
        });

        // Upload
        Route::post('upload/services', [UploadController::class, 'store'])->name('admin.upload');

        // Cart
        Route::get('customers', [\App\Http\Controllers\Admin\CartController::class, 'index'])->name('admin.customers.index');
        Route::get('customers/view/{customer}', [\App\Http\Controllers\Admin\CartController::class, 'show'])->name('admin.customers.show');
    });
});

// Route cho trang chủ
Route::get('/', [App\Http\Controllers\MainController::class, 'index'])->name('home'); // Giữ nguyên
Route::post('/services/load-product', [App\Http\Controllers\MainController::class, 'loadProduct']);

// Các route khác
Route::get('danh-muc/{id}-{slug}.html', [App\Http\Controllers\MenuController::class, 'index']);
Route::get('san-pham/{id}-{slug}.html', [App\Http\Controllers\ProductController::class, 'index']);
Route::post('add-cart', [App\Http\Controllers\CartController::class, 'index']);
Route::get('carts', [App\Http\Controllers\CartController::class, 'show']);
Route::post('update-cart', [App\Http\Controllers\CartController::class, 'update']);
Route::get('carts/delete/{id}', [App\Http\Controllers\CartController::class, 'remove']);
Route::post('carts', [App\Http\Controllers\CartController::class, 'addCart']);
