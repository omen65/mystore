<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DetailController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DashboardProductController;
use App\Http\Controllers\DashboardSettingController;
use App\Http\Controllers\DashboardTransactionController;
use App\Http\Controllers\Admin\DahsboardController as AdminDashboardController;
use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ProductGalleryController;
use App\Http\Controllers\Admin\UserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/categories', [CategoryController::class, 'index'])->name('categories');
Route::get('/categories/{id}', [CategoryController::class, 'detail'])->name('categories-detail');
Route::get('/details/{id}', [DetailController::class, 'index'])->name('detail');
Route::get('/cart', [CartController::class, 'index'])->name('cart');
Route::get('/success', [CartController::class, 'success'])->name('success');
Route::get('/register/success', [RegisterController::class, 'success'])->name('register-success');

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
Route::get('/dashboard/products', [DashboardProductController::class, 'index'])->name('dashboard-product');
Route::get('/dashboard/product/add', [DashboardProductController::class, 'create'])->name('dashboard-product-create');
Route::get('/dashboard/product/{id}', [DashboardProductController::class, 'details'])->name('dashboard-product-details');

Route::get('/dashboard/transactions', [DashboardTransactionController::class, 'index'])->name('dashboard-transaction');
Route::get('/dashboard/transactions/{id}', [DashboardTransactionController::class, 'details'])->name('dashboard-transaction-details');

Route::get('/dashboard/settings', [DashboardSettingController::class, 'store'])->name('dashboard-setting-store');
Route::get('/dashboard/account', [DashboardSettingController::class, 'account'])->name('dashboard-setting-account');

Route::prefix('admin')
    // ->middleware('auth','admin')
    ->group(function () {
        Route::get('/', [AdminDashboardController::class, 'index'])->name('admin-dashboard');
        Route::resource('category', AdminCategoryController::class);
        Route::resource('user', UserController::class);
        Route::resource('product', ProductController::class);
        Route::resource('product-gallery', ProductGalleryController::class);
    });


Auth::routes();
