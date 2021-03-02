<?php

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



//route untuk landing page Home
Route::get('/', 'HomeController@index')->name('home');

//route untuk landing page category
Route::get('/category', 'CategoryController@index')->name('category');
Route::get('/category/{id}', 'CategoryController@detail')->name('category-detail');

//route untuk landing detail produk
Route::get('/details/{id}', 'DetailController@index')->name('detail');
Route::post('/details/{id}', 'DetailController@add')->name('detail-add');

//route untuk cart produk
Route::get('/success', 'CartController@success')->name('success');

//route untuk register sukses
Route::get('/register/success', 'Auth\RegisterController@success')->name('register-success');

//route untuk checkout
Route::post('/checkout/callback', 'CheckoutController@callback')->name('callback');



Route::group(['middleware' => ['auth']], function(){
    //route untuk cart produk
    Route::get('/cart', 'CartController@index')->name('cart');
    Route::delete('/cart/{id}', 'CartController@delete')->name('cart-delete');

    //route untuk checkout
    Route::post('/checkout', 'CheckoutController@process')->name('checkout');

    //route untuk dashboar User
    Route::get('/dashboard', 'DashboardController@index')->name('dashboard');

    //route untuk dashboard product
    Route::get('/dashboard/product', 'DashboardProductController@product')->name('dashboard-product');
    Route::get('/dashboard/product/add', 'DashboardProductController@create_product')
    ->name('dashboard-product-create');
    Route::post('/dashboard/product', 'DashboardProductController@store')
    ->name('dashboard-product-store');

    //route untuk dashboard detail product
    Route::get('/dashboard/product/{id}', 'DashboardDetailController@detail_product')
    ->name('detail-products');
    Route::post('/dashboard/product/{id}', 'DashboardDetailController@updateGallery')
    ->name('detail-products-update');
    Route::post('/dashboard/gallery/upload', 'DashboardDetailController@uploadGallery')
    ->name('detail-products-gallery-upload');
    Route::get('/dashboard/gallery/delete/{id}', 'DashboardDetailController@deleteGallery')
    ->name('detail-products-gallery-delete');


    //route untuk dashboard transaction
    Route::get('/dashboard/transaction', 'DashboardTransactionController@transaction')
    ->name('dashboard-transaction');
    Route::get('/dashboard/transaction/{id}', 'DashboardTransactionController@transaction_detail')
    ->name('dashboard-transaction-detail');
    Route::post('/dashboard/transaction/{id}', 'DashboardTransactionController@update')
    ->name('dashboard-transaction-update');

    //route untuk dashboard setting dan account
    Route::get('/dashboard/setting', 'DashboardSettingController@setting')
    ->name('dashboard-setting');
    Route::get('/dashboard/account', 'DashboardAccountController@account')
    ->name('dashboard-account');
    Route::post('/dashboard/account/{redirect}', 'DashboardSettingController@update')
    ->name('dashboard-redirect');

});

//route untuk dashboar Admin
Route::prefix('admin')
    ->namespace('Admin')
    ->middleware(['auth','admin'])
    ->group(function() { 
        Route::get('/', 'AdminController@index')->name('admin-dashboard');
        Route::resource('categories', 'CategoriController');
        Route::resource('user', 'UserController');
        Route::resource('product', 'ProductController');
        Route::resource('gallery', 'ProductGalleryController');
        Route::resource('transaction', 'TransactionController');

    });
    
Auth::routes();
