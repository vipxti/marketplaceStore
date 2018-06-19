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

    //Cadastro e login de usuário
    Route::get('/login', 'Auth\UserLoginController@showAdminLoginForm')->name('admin.login');
    Route::post('/login', 'Auth\UserLoginController@login')->name('admin.login.submit');
    Route::get('/register', 'Auth\UserRegisterController@showRegisterForm')->name('admin.register');
    Route::post('/register', 'Auth\UserRegisterController@create')->name('admin.register.submit');
    Route::get('/register/{cpf_cnpj}', 'Auth\UserRegisterController@verificaCpfCnpj');

    //Atualizar dados do usuário
    Route::post('/edit', 'UserController@atualizaDadosUsuario')->name('admin.edit');

    //Produto
    Route::post('/product', 'ProductController@cadastrarProduto')->name('product.save');
    Route::get('/product', 'ProductController@showProductPage')->name('product.register')->middleware('auth:admin');

    //Variação do produto
    Route::post('/productvariation', 'ProductController@cadastrarVariacaoProduto')->name('productvariation.save')->middleware('auth:admin');
    Route::get('/productvariationpage/{cd_produto}', 'ProductController@showProductPageVariation')->middleware('auth:admin');

    //Form categoria/subcategoria e cadastro
    Route::get('/category', 'CategoryController@showCategoryForm')->name('category.register')->middleware('auth:admin');
    Route::post('/category', 'CategoryController@cadastrarCategoria')->name('category.save');
    Route::get('/subcat/{cd_categoria}', 'CategoryController@selectSubCategory')->name('category.subcategory')->middleware('auth:admin');
    Route::post('/subcategory', 'CategoryController@cadastrarSubCategoria')->name('subcategory.save');

    //Associa categoria/subcategoria
    Route::post('/catsubcat', 'CategoryController@associarCategoriaSubCategoria')->name('catsubcat.associate');

    //Form tamanho e cadastro
    Route::get('/size', 'SizeController@showSizeForm')->name('size.register')->middleware('auth:admin');
    Route::post('/tamanholetra', 'SizeController@cadastrarNovoTamanhoLetra')->name('lettersize.save');
    Route::post('/tamanhonumero', 'SizeController@cadastrarNovoTamanhoNumero')->name('numbersize.save');

    //Form cor e cadastro
    Route::get('/color', 'ColorController@showColorForm')->name('color.page')->middleware('auth:admin')->middleware('auth:admin');
    Route::post('/color', 'ColorController@cadastrarNovaCor')->name('color.save');

    Route::get('/userdata', 'UserController@showUserForm')->name('user.data')->middleware('auth:admin')->middleware('auth:admin');

    //Edição do site
    Route::get('/hotpost', 'PageController@showHotPostPage')->name('hotpost.edit')->middleware('auth:admin');
    Route::get('/banner', 'PageController@showBannerPage')->name('banner.edit')->middleware('auth:admin');

    //Editar menus
    Route::get('/menu', 'MenuController@showEditMenuPage')->name('menu.edit')->middleware('auth:admin');
    Route::post('/menu', 'MenuController@saveMenus')->name('menu.save');

    Route::get('/productconfig', 'PageController@showConfigProductPage')->name('product.config');

    Route::get('/','HomeController@showIndexAdminPage')->name('admin.dashboard')->middleware('auth:admin');
    Route::get('/getproducts', 'ProductController@listaProduto')->name('products.list')->middleware('auth:admin');

    //Faz o logout do usuário
    Route::get('/logout', 'Auth\UserLoginController@userLogout')->name('admin.logout');

    //Resetar senha
    Route::post('/password/email', 'Auth\UserForgotPasswordController@sendResetLinkEmail')->name('admin.password.email');
    Route::get('/password/reset', 'Auth\UserForgotPasswordController@showLinkRequestForm')->name('admin.password.request')->middleware('auth:admin');
    Route::post('/password/reset', 'Auth\UserResetPasswordController@reset');
    Route::get('/password/reset/{token}', 'Auth\UserResetPasswordController@showResetForm')->name('admin.password.reset');
    //----------------

});

Route::prefix('page')->group(function (){

    Route::get('/products', 'ProductController@paginaProduto')->name('products.page');

    //Carrinho
    Route::get('/carrinho/{cd_produto}', 'PageController@showCart');
    Route::get('/checkout', 'PageController@showCheckout')->name('checkout.page');

});

Route::get('/cadastrocliente', 'ProductController@paginaCadastrocliente')->name('cadastrocliente.page');
Route::get('/logincliente', 'ProductController@paginaLogincliente')->name('logincliente.page');
Route::get('/painelcliente', 'ProductController@paginaPainelcliente')->name('painelcliente.page');
Route::get('/alteraremailcliente', 'ProductController@paginaAlteraremailcliente')->name('alteraremailcliente.page');
Route::get('/alterarsenhacliente', 'ProductController@paginaAlterarsenhacliente')->name('alterarsenhacliente.page');




