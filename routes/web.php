<?php

use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ReceiptController;
use App\Http\Controllers\Admin\ReceiptDetailController;
use App\Http\Controllers\Admin\ReleaseController;
use App\Http\Controllers\Admin\ReleaseDetailController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\StaffController;
use App\Http\Controllers\Admin\StatisticController;
use App\Http\Controllers\Admin\SupplierController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\WebsiteController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Client\IntroduceController;
use App\Http\Controllers\Client\HomeController;
use App\Http\Controllers\Client\NewsController;
use App\Http\Controllers\Client\ProductController as ClientProductController;
use App\Http\Controllers\Client\ProfileController;
use App\Models\Category;
use App\Models\Customer;
use App\Models\Release;
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

//Home
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/introduce', [IntroduceController::class, 'show'])->name('introduce');

Route::get('/contact', [HomeController::class, 'contact'])->name('contact');

Route::get('/news/{user}', [NewsController::class, 'show'])->name('news');
Route::get('/news', [NewsController::class, 'showAll'])->name('all-news');


Route::get('product/{category_id}', [ClientProductController::class, 'index'])->name('client.products.index');
Route::get('product-detail/{id}', [ClientProductController::class, 'show'])->name('client.products.show');
Route::get('/product/filter/{category_id}', [ClientProductController::class, 'filter'])->name('products.filter');
//Register
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register.index');
Route::post('/customers', [CustomerController::class, 'store'])->name('customers.store');
Route::get('users/create', [UserController::class, 'create'])->name('users.create');
Route::post('/users', [UserController::class, 'store'])->name('users.store');

//Login
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login.index');
Route::post('/login', [LoginController::class, 'login'])->name('login');



Route::middleware('auth')->group(
    function () {
        // Route User
        Route::prefix('users')->controller(UserController::class)->name('users.')->group(
            function () {
                Route::get('/{user}', 'show')->name('show');
                Route::get('/{user}/edit',  'edit')->name('edit');
                Route::put('/{user}', 'update')->name('update');
                Route::delete('/{user}', 'destroy')->name('destroy');
            }
        );

        // Route Customer
        Route::prefix('customers')->controller(CustomerController::class)->name('customers.')->group(
            function () {
                Route::get('/', 'index')->name('index')->middleware('permission:show-customer');
                Route::get('/create', 'create')->name('create')->middleware('permission:create-customer');
                Route::get('/{customer}/edit', 'edit')->name('edit')->middleware('permission:edit-customer');
                Route::put('/{customer}', 'update')->name('update')->middleware('permission:edit-customer');
                Route::delete('/{customer}', 'destroy')->name('destroy')->middleware('permission:delete-customer');
                Route::get('/{customer}', 'show')->name('show')->middleware('permission:show-customer');
                Route::post('/{customer}', 'releaseList')->name('release-list')->middleware('permission:show-customer');
                Route::get('/{customer}/{release}/release', 'showDetailRelease')->name('show-detail')->middleware('permission:show-customer');
            }
        );

        //Route Profile
        Route::prefix('profile')->controller(ProfileController::class)->name('profile.')->group(
            function () {
                Route::get('/{id}/edit',  'edit')->name('edit');
                Route::get('/{id}', 'show')->name('show');
            }
        );

        //Route Logout
        Route::post('/logout', [LoginController::class, 'logout'])->name('logout');


        // Route Role
        Route::prefix('roles')->controller(RoleController::class)->name('roles.')->group(
            function () {
                Route::get('/', 'index')->name('index')->middleware('role:super-admin');
                Route::get('/create', 'create')->name('create')->middleware('role:super-admin');
                Route::post('/', 'store')->name('store')->middleware('role:super-admin');
                Route::get('/{role}', 'show')->name('show')->middleware('role:super-admin');
                Route::get('/{role}/edit',  'edit')->name('edit')->middleware('role:super-admin');
                Route::put('/{role}', 'update')->name('update')->middleware('role:super-admin');
                Route::delete('/{role}', 'destroy')->name('destroy')->middleware('role:super-admin');
            }
        );
        //Route Staff
        Route::prefix('staffs')->controller(StaffController::class)->name('staffs.')->group(
            function () {
                Route::get('/', 'index')->name('index')->middleware('permission:show-staff');
                Route::get('/create', 'create')->name('create')->middleware('permission:create-staff');
                Route::post('/', 'store')->name('store')->middleware('permission:create-staff');
                Route::get('/{staff}', 'show')->name('show')->middleware('permission:show-detail-staff');
                //Route::get('/detail/{staff}', 'showAll')->name('show')->middleware('permission:show-detail-all-staff');
                Route::get('/{staff}/edit',  'edit')->name('edit')->middleware('permission:edit-staff');
                Route::put('/{staff}', 'update')->name('update')->middleware('permission:edit-staff');
                Route::delete('/{staff}', 'destroy')->name('destroy')->middleware('permission:delete-staff');
            }
        );

        //Route Brand
        Route::prefix('brands')->controller(BrandController::class)->name('brands.')->group(
            function () {
                Route::get('/', 'index')->name('index')->middleware('permission:show-brand');
                Route::get('/create', 'create')->name('create')->middleware('permission:create-brand');
                Route::post('/', 'store')->name('store')->middleware('permission:create-brand');
                Route::get('/{brand}/edit',  'edit')->name('edit')->middleware('permission:edit-brand');
                Route::put('/{brand}', 'update')->name('update')->middleware('permission:edit-brand');
                Route::delete('/{brand}', 'destroy')->name('destroy')->middleware('permission:delete-brand');
            }
        );

        //Route Supplier
        Route::prefix('suppliers')->controller(SupplierController::class)->name('suppliers.')->group(
            function () {
                Route::get('/', 'index')->name('index')->middleware('permission:show-supplier');
                Route::get('/create', 'create')->name('create')->middleware('permission:create-supplier');
                Route::post('/', 'store')->name('store')->middleware('permission:create-supplier');
                Route::get('/{supplier}/edit',  'edit')->name('edit')->middleware('permission:edit-supplier');
                Route::put('/{supplier}', 'update')->name('update')->middleware('permission:edit-supplier');
                Route::delete('/{supplier}', 'destroy')->name('destroy')->middleware('permission:delete-supplier');
            }
        );

        //Route Category
        Route::prefix('categories')->controller(CategoryController::class)->name('categories.')->group(
            function () {
                Route::get('/', 'index')->name('index')->middleware('permission:show-category');
                Route::get('/create', 'create')->name('create')->middleware('permission:create-category');
                Route::post('/', 'store')->name('store')->middleware('permission:create-category');
                Route::get('/{category}/edit',  'edit')->name('edit')->middleware('permission:edit-category');
                Route::put('/{category}', 'update')->name('update')->middleware('permission:edit-category');
                Route::delete('/{category}', 'destroy')->name('destroy')->middleware('permission:delete-category');
            }
        );

        //Route Product
        Route::prefix('products')->controller(ProductController::class)->name('products.')->group(
            function () {
                Route::get('/', 'index')->name('index')->middleware('permission:show-product');
                Route::get('/create', 'create')->name('create')->middleware('permission:create-product');
                Route::post('/', 'store')->name('store')->middleware('permission:create-product');
                Route::get('/{product}', 'show')->name('show')->middleware('permission:show-product');
                Route::get('/{product}/edit',  'edit')->name('edit')->middleware('permission:edit-product');
                Route::put('/{product}', 'update')->name('update')->middleware('permission:edit-product');
                Route::delete('/{product}', 'destroy')->name('destroy')->middleware('permission:delete-product');
            }
        );

        //Route Receipt
        Route::prefix('receipts')->controller(ReceiptController::class)->name('receipts.')->group(
            function () {
                Route::get('/', 'index')->name('index')->middleware('permission:show-receipt');
                Route::get('/create', 'create')->name('create')->middleware('permission:create-receipt');
                Route::post('/', 'store')->name('store')->middleware('permission:create-receipt');
                Route::get('/{id}', 'show')->name('show')->middleware('permission:show-receipt');
                Route::get('/{id}/edit',  'edit')->name('edit')->middleware('permission:edit-receipt');
                Route::put('/{id}', 'update')->name('update')->middleware('permission:edit-receipt');
                Route::delete('/{id}', 'destroy')->name('destroy')->middleware('permission:delete-receipt');
                Route::post('/finish_receipt/{id}', 'saveTotal')->name('finish')->middleware('permission:create-receipt');
                Route::get('/print_receipt/{id}', 'generatePrintReceipt')->name('generate')->middleware('permission:print-receipt');
            }
        );



        //Route ReceiptDetail
        Route::prefix('receiptdetails')->controller(ReceiptDetailController::class)->name('receiptdetails.')->group(
            function () {
                Route::get('/', 'index')->name('index')->middleware('permission:show-receipt');
                Route::get('/create', 'create')->name('create')->middleware('permission:create-receipt');
                Route::post('/', 'store')->name('store')->middleware('permission:create-receipt');
                Route::get('/{id}', 'show')->name('show')->middleware('permission:show-receipt');
                Route::get('/edit/{id}/{receiptId}',  'edit')->name('edit')->middleware('permission:edit-receipt');
                Route::put('/{id}', 'update')->name('update')->middleware('permission:edit-receipt');
                Route::delete('/{id}/{receiptId}', 'destroy')->name('destroy')->middleware('permission:delete-receipt');
            }
        );

        //Route Release
        Route::prefix('releases')->controller(ReleaseController::class)->name('releases.')->group(
            function () {
                Route::get('/search', 'search')->name('search')->middleware('permission:show-release');
                Route::get('/create/{id}', 'create')->name('create')->middleware('permission:create-release');
                Route::post('/', 'store')->name('store')->middleware('permission:create-release');
                Route::get('/{id}', 'show')->name('show')->middleware('permission:show-release');
                Route::get('/edit/{id}/{customerId}',  'edit')->name('edit')->middleware('permission:edit-release');
                Route::put('/{id}', 'update')->name('update')->middleware('permission:edit-release');
                Route::delete('/{id}', 'destroy')->name('destroy')->middleware('permission:delete-release');
                Route::post('/finish/{id}', 'finish')->name('finish')->middleware('permission:create-release');
                Route::get('/generate/{id}', 'generateInvoice')->name('generate')->middleware('permission:print-release');
                Route::get('/index', 'index')->name('index')->middleware('permission:show-release');
            }
        );


        //Route ReleaseDetail
        Route::prefix('releasedetails')->controller(ReleaseDetailController::class)->name('releasedetails.')->group(
            function () {
                Route::get('/create/{id}', 'create')->name('create')->middleware('permission:create-release');
                Route::post('/store', 'store')->name('store')->middleware('permission:create-release');
                Route::get('/edit/{id}/{releaseId}', 'edit')->name('edit')->middleware('permission:edit-release');
                Route::put('/update/{id}', 'update')->name('update')->middleware('permission:edit-release');
                Route::delete('/destroy/{id}/{releaseId}', 'destroy')->name('destroy')->middleware('permission:delete-release');
                Route::get('/index', 'index')->name('index')->middleware('permission:show-release');
            }
        );


        //Route Statistic
        Route::prefix('statistics')->controller(StatisticController::class)->name('statistics.')->group(
            function () {
                Route::get('/products', 'productList')->name('productlist')->middleware('permission:products-statistic');
                Route::get('/receipts', 'showStatisticReceipt')->name('showreceiptlist')->middleware('permission:receipts-statistic');
                Route::post('/receipts', 'statisticReceipt')->name('receiptlist')->middleware('permission:receipts-statistic');
                Route::get('/releases', 'showStatisticRelease')->name('showreleaselist')->middleware('permission:releases-statistic');
                Route::post('/releases', 'statisticRelease')->name('releaselist')->middleware('permission:release-statistic');
                Route::post('/receipts/print', 'printReceiptsList')->name('printReceiptsList')->middleware('permission:receipts-statistic');
                Route::post('/releases/print', 'printReleasesList')->name('printReleasesList')->middleware('permission:releases-statistic');
            }
        );

        Route::prefix('website-management')->controller(WebsiteController::class)->name('website.')->group(
            function () {
                Route::get('/banners', 'indexBanner')->name('banners.index')->middleware('permission:website');
                Route::get('/banners/create', 'createBanner')->name('banners.create')->middleware('permission:website');
                Route::post('/banners/store', 'storeBanner')->name('banners.store')->middleware('permission:website');
                Route::delete('/banners/delete/{banner}', 'destroyBanner')->name('banners.destroy')->middleware('permission:website');

                Route::get('/introduce', 'showIntroduce')->name('introduce.index')->middleware('permission:website');
                Route::get('/introduce/edit', 'editIntroduce')->name('introduce.edit')->middleware('permission:website');
                Route::put('/introduce/update', 'updateIntroduce')->name('introduce.update')->middleware('permission:website');

                Route::get('/news', 'indexNews')->name('news.index')->middleware('permission:website');
                Route::get('/news/{news}', 'showNews')->name('news.show')->middleware('permission:website');
                Route::get('/news/health/create', 'createNews')->name('news.create')->middleware('permission:website');
                Route::post('/news/store', 'storeNews')->name('news.store')->middleware('permission:website');
                Route::get('/news/edit/{news}', 'editNews')->name('news.edit')->middleware('permission:website');
                Route::put('/news/update/{news}', 'updateNews')->name('news.update')->middleware('permission:website');
                Route::delete('/news/delete/{news}', 'destroyNews')->name('news.destroy')->middleware('permission:website');
            }
        );
    }
);
