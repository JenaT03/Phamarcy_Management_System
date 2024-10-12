<?php

use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ReceiptController;
use App\Http\Controllers\Admin\ReceiptDetailController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\StaffController;
use App\Http\Controllers\Admin\SupplierController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Client\HomeController;
use App\Http\Controllers\Client\ProductController as ClientProductController;
use App\Http\Controllers\Client\ProfileController;
use App\Models\Category;
use App\Models\Customer;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Symfony\Component\HttpKernel\Profiler\Profile;

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

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login.index');
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register.index');
Route::post('/login', [LoginController::class, 'login'])->name('login');

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('product/{category_id}', [ClientProductController::class, 'index'])->name('client.products.index');
Route::get('product-detail/{id}', [ClientProductController::class, 'show'])->name('client.products.show');

Route::middleware('auth')->group(
    function () {
        Route::resource('profile', ProfileController::class);
        Route::post('/logout', function () {
            Auth::logout();
            return redirect('/');
        })->name('logout');
    }
);


Route::resource('users', UserController::class);
Route::resource('customers', CustomerController::class);

// Auth::routes();
Route::middleware('auth')->group(
    function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

        Route::resource('roles', RoleController::class);
        Route::get('customers/detail', [CustomerController::class, 'detail'])->name('customers.detail');
        Route::resource('staffs', StaffController::class);
        Route::get('staffs/detail', [StaffController::class, 'detail'])->name('staffs.detail');
        Route::resource('brands', BrandController::class);
        Route::resource('suppliers', SupplierController::class);
        Route::resource('categories', CategoryController::class);
        Route::resource('products', ProductController::class);
        Route::resource('receipts', ReceiptController::class);
        Route::post('receipts/finish_receipt/{id}', [ReceiptController::class, 'saveTotal'])->name('receipts.finish');
        Route::get('receiptdetails/create/{id}', [ReceiptDetailController::class, 'create'])->name('receiptdetails.create');
        Route::post('receiptdetails/store', [ReceiptDetailController::class, 'store'])->name('receiptdetails.store');
        Route::get('receiptdetails/edit/{id}/{receiptId}', [ReceiptDetailController::class, 'edit'])->name('receiptdetails.edit');
        Route::put('receiptdetails/update/{id}', [ReceiptDetailController::class, 'update'])->name('receiptdetails.update');
        Route::delete('receiptdetails/destroy/{id}/{receiptId}', [ReceiptDetailController::class, 'destroy'])->name('receiptdetails.destroy');
        Route::get('receiptdetails/index', [ReceiptDetailController::class, 'index'])->name('receiptdetails.index');


        //Route::resource('receiptdetails', ReceiptDetailController::class);
    }
);
