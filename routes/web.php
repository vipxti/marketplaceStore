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
    Route::post('/login', 'Auth\UserLoginController@login')->name('admin.login.submit')->middleware('auth:admin');
    Route::get('/register', 'Auth\UserRegisterController@showRegisterForm')->name('admin.register')->middleware('auth:admin');
    Route::post('/register', 'Auth\UserRegisterController@create')->name('admin.register.submit')->middleware('auth:admin');
    Route::get('/register/{cpf_cnpj}', 'Auth\UserRegisterController@verificaCpfCnpj')->middleware('auth:admin');

    //Preenche combobox do form cadastro de produtos
    Route::get('/cadProd', 'ProductController@showProductPage')->name('admin.cadProd')->middleware('auth:admin');
    //Form categoria/subcategoria e cadastro
    Route::get('/cadCatego', 'CategoryController@showCategoryForm')->name('admin.cadCatego')->middleware('auth:admin');
    Route::post('/category', 'CategoryController@cadastrarCategoria')->name('category.save')->middleware('auth:admin');
    Route::get('/subcat/{cd_categoria}', 'CategoryController@selectSubCategory')->name('category.subcategory')->middleware('auth:admin');
    Route::post('/subcategory', 'CategoryController@cadastrarSubCategoria')->name('subcategory.save')->middleware('auth:admin');

    //Associa categoria/subcategoria
    Route::post('/catsubcat', 'CategoryController@associarCategoriaSubCategoria')->name('catsubcat.associate')->middleware('auth:admin');

    //Form tamanho e cadastro
    Route::get('/cadTamanho', 'SizeController@showSizeForm')->name('admin.cadTamanho')->middleware('auth:admin');
    Route::post('/tamanholetra', 'SizeController@cadastrarNovoTamanhoLetra')->name('lettersize.save')->middleware('auth:admin');
    Route::post('/tamanhonumero', 'SizeController@cadastrarNovoTamanhoNumero')->name('numbersize.save')->middleware('auth:admin');

    //Form cor e cadastro
    Route::get('/cadCor', 'ColorController@showColorForm')->name('admin.cadCor')->middleware('auth:admin');
    Route::post('/cor', 'ColorController@cadastrarNovaCor')->name('color.save')->middleware('auth:admin');

    Route::get('/cadUsuario', 'UserController@showUserForm')->name('usuario.dados')->middleware('auth:admin');

    //Edição do site
    Route::get('/indexHotpost', 'PageController@showHotPostPage')->name('admin.indexHotpost')->middleware('auth:admin');
    Route::get('/indexBanner', 'PageController@showBannerPage')->name('admin.indexBanner')->middleware('auth:admin');

    //Editar menus
    Route::get('/indexMenu', 'MenuController@showEditMenuPage')->name('admin.indexMenu')->middleware('auth:admin');
    Route::post('/editmenu', 'MenuController@saveMenus')->name('menu.edit')->middleware('auth:admin');

    Route::get('/indexConfigproduto', 'PageController@showConfigProductPage')->name('admin.indexConfigproduto');

    Route::get('/','HomeController@showIndexAdminPage')->name('admin.dashboard')->middleware('auth:admin');
    Route::get('/listProd', 'ProductController@listaProduto')->name('admin.listProd')->middleware('auth:admin');

    //Faz o logout do usuário
    Route::get('/logout', 'Auth\UserLoginController@userLogout')->name('admin.logout')->middleware('auth:admin');

    //Página Embalagem
    Route::get('/cadEmbalagem', 'PackageController@mostrarPaginaEmbalagem')->name('admin.cadEmbalagem')->middleware('auth:admin');

    //Resetar senha
    Route::post('/password/email', 'Auth\UserForgotPasswordController@sendResetLinkEmail')->name('admin.password.email');
    Route::get('/password/reset', 'Auth\UserForgotPasswordController@showLinkRequestForm')->name('admin.password.request');
    Route::post('/password/reset', 'Auth\UserResetPasswordController@reset');
    Route::get('/password/reset/{token}', 'Auth\UserResetPasswordController@showResetForm')->name('admin.password.reset');
    //----------------
});

Route::post('/product', 'ProductController@cadastrarProduto')->name('product.save');
Route::post('/productvariation', 'ProductController@cadastrarVariacaoProduto')->name('productvariation.save');
Route::get('/productspage', 'ProductController@paginaProduto')->name('products.page');
Route::get('/productvariationpage', 'ProductController@showProductPageVariation')->name('product.variation.page');
