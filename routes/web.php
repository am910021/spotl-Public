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

Route::get('/', 'IndexController@welcome');
Route::get('/home', 'IndexController@index')->name('home');
Route::get('/index', 'IndexController@index')->name('index');
Route::get('/announce', 'IndexController@announce')->name('announce');
Route::get('/update', 'IndexController@updateNote')->name('update');
Route::get('/banned', 'IndexController@blackList')->name('blackList');

//Route::name('member.')->prefix('/member')->middleware('member')->group(function () {
//    Route::get('/recharge-redeem', 'Member\RechargeRedeemController@index')->name('rechargeAndRedeem');
//});

Route::name('member.')->prefix('/member')->group(function () {
    Route::get('/recharge-redeem', 'Member\RechargeRedeemController@index')->name('rechargeAndRedeem');
    Route::get('/redeem', 'Member\RechargeRedeemController@index');
    Route::post('/redeem', 'Member\RechargeRedeemController@redeem')->name('redeem');
});

Route::name('admin.')->prefix('/admin')->group(function () {
    Route::get('/', 'Admin\AdminController@index')->name('main');
    Route::get('/code', 'Admin\CodeController@index')->name('code');
    Route::post('/code/query/', 'Admin\CodeController@query')->name('code.query');
    Route::get('/code/query/', function () {
        return redirect(route('admin.code'));
    });


    Route::get('/code/add', 'Admin\CodeController@form')->name('code.add');
    Route::post('/code/add', 'Admin\CodeController@add');

});

//origin auth
//Auth::routes();

Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::any('logout', 'Auth\LoginController@logout')->name('logout');

// Registration Routes...
Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('register', 'Auth\RegisterController@register');

// Password Reset Routes...
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset', 'Auth\ResetPasswordController@reset');


