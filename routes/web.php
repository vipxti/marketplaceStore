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
    Route::get('/register/{cpf_cnpj}', 'Auth\UserRegisterController@verificaCpfCnpj');

    //Preenche combobox do form cadastro de produtos
    Route::get('/cadProd', 'ProductController@getComboFields')->name('admin.cadProd');

    //Form categoria/subcategoria e cadastro
    Route::get('/cadCatego', 'CategoryController@showCategoryForm')->name('admin.cadCatego');
    Route::post('/category', 'CategoryController@cadastrarCategoria')->name('category.save');
    Route::post('/subcategory', 'CategoryController@cadastrarSubCategoria')->name('subcategory.save');
    Route::get('/subcat/{cd_categoria}', 'CategoryController@selectSubCategory')->name('category.subcategory');

    //Form tamanho e cadastro
    Route::get('/cadTamanho', 'SizeController@showSizeForm')->name('admin.cadTamanho');
    Route::post('/tamanho', 'SizeController@cadastrarNovoTamanho')->name('size.save');

    //Form cor e cadastro
    Route::get('/cadCor', 'ColorController@showColorForm')->name('admin.cadCor');
    Route::post('/cor', 'ColorController@cadastrarNovaCor')->name('color.save');

    Route::get('/cadUsuario', 'UserController@showUserForm')->name('usuario.dados');

    Route::get('/indexHotpost', function (){return view('pages.admin.indexHotpost');})->name('admin.indexHotpost');
    Route::get('/indexBanner', function (){return view('pages.admin.indexBanner');})->name('admin.indexBanner');
    Route::get('/indexMenu', function (){return view('pages.admin.indexMenu');})->name('admin.indexMenu');
    Route::get('/indexAparencia', function (){return view('pages.admin.indexAparencia');})->name('admin.indexAparencia');
    Route::get('/','HomeController@showIndexAdminPage')->name('admin.dashboard')->middleware('auth:admin');

    //Faz o logout do usuário
    Route::get('/logout', 'Auth\UserLoginController@userLogout')->name('admin.logout');

    //Resetar senha
    Route::post('/password/email', 'Auth\UserForgotPasswordController@sendResetLinkEmail')->name('admin.password.email');
    Route::get('/password/reset', 'Auth\UserForgotPasswordController@showLinkRequestForm')->name('admin.password.request');
    Route::post('/password/reset', 'Auth\UserResetPasswordController@reset');
    Route::get('/password/reset/{token}', 'Auth\UserResetPasswordController@showResetForm')->name('admin.password.reset');
});

Route::post('/product', 'ProductController@cadastrarProduto')->name('product.save');
