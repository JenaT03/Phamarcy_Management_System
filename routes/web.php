<?php

use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\StaffController;
use App\Http\Controllers\Admin\SupplierController;
use App\Http\Controllers\Admin\UserController;
use App\Models\Category;
use App\Models\Customer;
use App\Models\User;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/manage-home', function () {
    return view('admin.dashboard.index');
})->name('manage-home');

Route::get('/home', function () {
    return view('client.layouts.app');
});

Route::resource('roles', RoleController::class);
Route::resource('users', UserController::class);
Route::resource('customers', CustomerController::class);
Route::get('customers/detail', [CustomerController::class, 'detail'])->name('customers.detail');
Route::resource('staffs', StaffController::class);
Route::get('staffs/detail', [StaffController::class, 'detail'])->name('staffs.detail');
Route::resource('brands', BrandController::class);
Route::resource('suppliers', SupplierController::class);
Route::resource('categories', CategoryController::class);
Route::resource('products', ProductController::class);




// Auth::routes();
