<?php

use App\Http\Controllers\Admin\AdminUserController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

Route::get('/', 'App\Http\Controllers\HomeController@index')->name("home.index");
Route::get('/about', 'App\Http\Controllers\HomeController@about')->name("home.about");
Route::get('/products', 'App\Http\Controllers\ProductController@index')->name("product.index");
Route::get('/products/{id}', 'App\Http\Controllers\ProductController@show')->name("product.show");

Route::get('/cart', 'App\Http\Controllers\CartController@index')->name("cart.index");
Route::get('/cart/delete', 'App\Http\Controllers\CartController@delete')->name("cart.delete");
Route::post('/cart/add/{id}', 'App\Http\Controllers\CartController@add')->name("cart.add");

Route::middleware('auth')->group(function () {
    Route::get('/cart/purchase', 'App\Http\Controllers\CartController@purchase')->name("cart.purchase");
    Route::get('/my-account/orders', 'App\Http\Controllers\MyAccountController@orders')->name("myaccount.orders");
});

Route::middleware('admin')->group(function () {
    Route::get('/admin', 'App\Http\Controllers\Admin\AdminHomeController@index')->name("admin.home.index");
    Route::get('/admin/products', 'App\Http\Controllers\Admin\AdminProductController@index')->name("admin.product.index");
    Route::post('/admin/products/store', 'App\Http\Controllers\Admin\AdminProductController@store')->name("admin.product.store");
    Route::delete('/admin/products/{id}/delete', 'App\Http\Controllers\Admin\AdminProductController@delete')->name("admin.product.delete");
    Route::get('/admin/products/{id}/edit', 'App\Http\Controllers\Admin\AdminProductController@edit')->name("admin.product.edit");
    Route::put('/admin/products/{id}/update', 'App\Http\Controllers\Admin\AdminProductController@update')->name("admin.product.update");
    Route::get('/admin/categories', 'App\Http\Controllers\Admin\AdminCategoryController@index')->name("admin.category.index");
    Route::post('/admin/categories/store', 'App\Http\Controllers\Admin\AdminCategoryController@store')->name("admin.category.store");
    Route::delete('/admin/categories/{id}/destroy', 'App\Http\Controllers\Admin\AdminCategoryController@destroy')->name("admin.category.destroy");
    Route::get('/admin/categories/{id}/edit', 'App\Http\Controllers\Admin\AdminCategoryController@edit')->name("admin.category.edit");
    Route::put('/admin/categories/{id}/update', 'App\Http\Controllers\Admin\AdminCategoryController@update')->name("admin.category.update");
    Route::get('/admin/filtered-products', 'App\Http\Controllers\Admin\AdminProductController@filterparcategory')->name("admin.product.filterparcategory");
    Route::get('/admin/supplier','App\Http\Controllers\Admin\AdminSupplierController@index')->name("admin.supplier.index");
    Route::post('/admin/supplier/store','App\Http\Controllers\Admin\AdminSupplierController@store')->name("admin.supplier.store");
    Route::delete('/admin/supplier/{id}/destroy','App\Http\Controllers\Admin\AdminSupplierController@destroy')->name("admin.supplier.destroy");
    Route::get('/admin/supplier/{id}/edit','App\Http\Controllers\Admin\AdminSupplierController@edit')->name("admin.supplier.edit");
    Route::put('/admin/supplier/{id}/update','App\Http\Controllers\Admin\AdminSupplierController@update')->name("admin.supplier.update");
    Route::get('/admin/filtered-products-supplier', 'App\Http\Controllers\Admin\AdminProductController@filterparsupplier')->name("admin.product.filterparsupplier");

});

Route::middleware(['auth', 'superadmin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/users', [AdminUserController::class, 'index'])->name('user.index');
    Route::post('/users/store', [AdminUserController::class, 'store'])->name('user.store');
    Route::get('/users/{id}/edit', [AdminUserController::class, 'edit'])->name('user.edit');
    Route::put('/users/{id}/update', [AdminUserController::class, 'update'])->name('user.update');
    Route::delete('/users/{id}/delete', [AdminUserController::class, 'destroy'])->name('user.delete');
});

Auth::routes();
