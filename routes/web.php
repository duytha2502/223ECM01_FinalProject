<?php

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

use App\Http\Controllers\CustomerOrderController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\GithubController;
use Srmklive\PayPal\Facades\PayPal;
// use App\Http\Controllers\FacebookController;

Route::redirect('/', '/home');

Route::get('test', function(){
    $provider = PayPal::setProvider();
    dd($provider);    
});

Auth::routes([
    'verify' => true
]);

Route::get('/home', 'HomeController@index')->name('home')->middleware('verified');
Route::get('/contact', 'HomeController@contact')->name('contact');


Route::get('/products/search', 'ProductController@search')->name('products.search');
Route::get('/products/sortASC', 'ProductController@sortASC')->name('products.sortASC');
Route::get('/products/sortDESC', 'ProductController@sortDESC')->name('products.sortDESC');
Route::get('/products/sortNewest', 'ProductController@sortNewest')->name('products.sortNewest');
Route::resource('products', 'ProductController');

Route::get('/add-to-cart/{product}', 'CartController@add')->name('cart.add')->middleware('auth');
Route::get('/cart','CartController@index')->name('cart.index')->middleware('auth');
Route::get('/cart/destroy/{itemId}', 'CartController@destroy')->name('cart.destroy')->middleware('auth');
Route::get('/cart/update/{itemId}', 'CartController@update')->name('cart.update')->middleware('auth');
Route::get('/cart/checkout', 'CartController@checkout')->name('cart.checkout')->middleware('auth');
Route::get('/cart/apply-coupon', 'CartController@applyCoupon')->name('cart.coupon')->middleware('auth');
// Route::get('coupon/clearCoupon', [CartController::class,'clearCoupon'])->name('cart.clearCoupon');

Route::resource('orders', 'OrderController')->only('store')->middleware('auth');

Route::resource('shops','ShopController')->middleware('auth');


Route::get('paypal/checkout/{order}', 'PayPalController@getExpressCheckout')->name('paypal.checkout');
Route::get('paypal/checkout-success/{order}', 'PayPalController@getExpressCheckoutSuccess')->name('paypal.success');
Route::get('paypal/checkout-cancel', 'PayPalController@cancelPage')->name('paypal.cancel');


Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
    Route::get('/order/pay/{suborder}', 'SubOrderController@pay')->name('order.pay');
});


Route::group(['prefix' => 'seller', 'middleware' => 'auth', 'as' => 'seller.', 'namespace' => 'Seller'], function () {

    Route::redirect('/','seller/orders');

    Route::resource('/orders',  'OrderController');

    Route::get('/orders/delivered/{suborder}',  'OrderController@markDelivered')->name('order.delivered');
});

Route::get('customers/orders/index', [CustomerOrderController::class,'index'])->name('customer.order');
Route::get('customers/orders/index/{orderId}', [CustomerOrderController::class,'show']);
// Route::get('customers/orders/index/destroy/{orderId}', [CustomerOrderController::class,'destroy'])->name('customer.destroy');
// Route::get('customers/orders/index/delivered/{suborder}',  'CustomerOrderController@markDelivered')->name('customers.orders.delivered');
Route::get('customers/orders/index/delivered/{suborder}', [CustomerOrderController::class,'markCompleted'])->name('customers.orders.delivered');


//Google login URL
Route::get('auth/google',[GoogleController::class,'redirect'])->name('google-auth');
Route::get('auth/google/callback',[GoogleController::class,'callbackGoogle']);

//Facebook login URL
// Route::get('auth/facebook',[FacebookController::class,'redirect'])->name('facebook-auth');
// Route::get('auth/facebook/callback',[FacebookController::class,'callbackFacebook']);

//Google login URL
Route::get('auth/github',[GithubController::class,'redirect'])->name('github-auth');
Route::get('auth/github/callback',[GithubController::class,'callbackGithub']);