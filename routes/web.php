<?php

use App\Http\Controllers\ProductController;
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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::group([ 'middleware' => "Admin"], function () {
    Route::get('/admin','Admin\AdminController@home')->name('home');
    Route::resource('admin/category', 'CategoryController');
    Route::resource('admin/color', 'ColorController');
    Route::resource('admin/size', 'SizeController');
    Route::resource('admin/product', 'ProductController');
    Route::get('/admin/order','Admin\OrderController@adminshoworder')->name('adminshoworder');
    Route::get('/admin/approve','Admin\OrderController@approve')->name('approve');
    Route::resource('admin/coupon', 'CuponController');
    // Route::get('/admin/order-list','Admin\OrderController@orderlist')->name('adminorderlist');
});

Route::get('/', 'PageController@home')->name('welcome');
Route::get('/search', 'PageController@search')->name('search');
Route::get('/productdetail/{id}', 'PageController@detaill')->name('productdetail');
Route::get('/hello', 'PageController@hello')->name('hello');

Route::get('/categoryfilter','CategoryController@filter')->name('categoryfilter');
Route::group([ 'middleware' => "guest"], function () {
    Route::GET('/register','AuthController@showRegister')->name('userRegister');
    Route::POST('/register','AuthController@postRegister')->name('register');
    Route::GET('/admin/login','Admin\AuthController@showLogin');
    Route::POST('/admin/login','Admin\AuthController@postLogin')->name('adminlogin');
    Route::GET('/login','AuthController@showLogin')->name('userLogin');
    Route::POST('/login','AuthController@postLogin')->name('login');

});

Route::group([ 'middleware' => "auth"], function () {
    Route::get('/logout', 'AuthController@logout')->name('logout');
    Route::post('/addtocart','AddtocartController@addtocart')->name('addtocart');
    Route::get('/cart','AddtocartController@cart')->name('cart');
    Route::post('/update-cart','AddtocartController@update_cart')->name('update-cart');

    Route::post('/makeorder','OrderController@makeorder')->name('makeorder');
    Route::get('/order','OrderController@showorder')->name('showorder');
    Route::delete('/deletecart/{id}','AddtocartController@delete_cart')->name('delete-cart');
    Route::post('/applycoupon','AddtocartController@apply_coupon')->name('applycoupon');
});









