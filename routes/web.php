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

Route::get('/', 'HomeController@showIndexPage')->name('index');

Route::prefix('admin')->group(function () {
    Route::get('/login', 'Auth\UserLoginController@showAdminLoginForm')->name('admin.login');
    Route::post('/login', 'Auth\UserLoginController@login')->name('admin.login.submit');
    Route::get('/register', 'Auth\UserRegisterController@showRegisterForm')->name('admin.register');
    Route::post('/register', 'Auth\UserRegisterController@create')->name('admin.register.submit');
    Route::get('/cadProd', function (){return view('pages.admin.cadProduto');})->name('admin.cadProd');
    Route::get('/cadCatego', function (){return view('pages.admin.cadCatego');})->name('admin.cadCatego');
    Route::get('/cadUsuario', function (){return view('pages.admin.cadUsuario');})->name('usuario.dados');
    Route::get('/', 'HomeController@showIndexAdminPage')->name('admin.dashboard')->middleware('auth:admin');
    Route::get('/logout', 'Auth\UserLoginController@userLogout')->name('admin.logout');

    //Resetar senha
    Route::post('/password/email', 'Auth\UserForgotPasswordController@sendResetLinkEmail')->name('admin.password.email');
    Route::get('/password/reset', 'Auth\UserForgotPasswordController@showLinkRequestForm')->name('admin.password.request');
    Route::post('/password/reset', 'Auth\UserResetPasswordController@reset');
    Route::get('/password/reset/{token}', 'Auth\UserResetPasswordController@showResetForm')->name('admin.password.reset');
});

Route::post('/product', 'ProductController@createProduct')->name('product.save');
