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

//Admin
Route::prefix('admin')->group(function () {

    //Cadastro dos dados da Empresa
    Route::get('/dadosCadastrais', 'CompanyController@showCompanyForm')->name('company.data')->middleware('auth:admin');
    Route::post('/dadosCadastrais', 'CompanyController@registerComnpany')->name('company.register.data')->middleware('auth:admin');
    Route::post('/dadosCadastrais/update', 'CompanyController@updateCompany')->name('company.update.data')->middleware('auth:admin');
    //Pedido
    Route::get('/pedido', 'OrderController@listOrder')->name('order.list')->middleware('auth:admin');

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
    Route::post('/product/update', 'ProductController@updateProduct')->name('product.update');
    Route::post('/product/delete/image', 'ProductController@apagarImagem')->name('product.delete.image');
    Route::post('/product/update/image', 'ProductController@atualizarImagemPrincipal')->name('product.update.image');
    Route::post('/blingproduct/update', 'ProductController@updateBlingProduct')->name('bling.product.update');
    Route::get('/product', 'ProductController@showProductAdminPage')->name('product.register')->middleware('auth:admin');
    Route::post('/blingproduct', 'ProductController@cadastrarProdutosBling')->name('bling.save.products');
    Route::post('/bling/skuproduct', 'ProductController@consultaSku')->name('bling.sku.products');
    Route::post('/bling/bond/categories', 'ProductBlingController@integracaoSistCatBling')->name('bling.bond.sist.categories');
    Route::post('/bling/update/bond/categories', 'ProductBlingController@updateBondBlingSist')->name('bling.update.bond');
    Route::post('/bling/delete/bond/categories', 'ProductBlingController@deleteBondBlingSist')->name('bling.delete.bond');
    Route::post('/bling/consult/bond/categories', 'ProductBlingController@consultCategoriesBlingSist')->name('bling.consult.bond.categories');
    Route::post('/bling/verify/categories', 'ProductBlingController@verifyBlingCategory')->name('bling.verify.sist.categories');
    Route::post('/product/verify/sku', 'ProductController@getProductData')->name('verify.sku.products');
    Route::get('/product/verify/category', 'ProductController@getCategory')->name('verify.category.products');
    Route::get('/product/verify/subcategory', 'ProductController@getSubCategory')->name('verify.subcategory.products');


    //Variação do produto
    Route::post('/product/variation', 'ProductController@cadastrarVariacaoProduto')->name('product.variation.save')->middleware('auth:admin');
    Route::get('/product/variation/{cd_produto}', 'ProductController@showProductPageVariation')->middleware('auth:admin');

    //Form categoria/subcategoria e cadastro
    Route::get('/category', 'CategoryController@showCategoryForm')->name('category.register')->middleware('auth:admin');
    Route::post('/category', 'CategoryController@crudCategoria')->name('category.save');
    Route::get('/subcat/{cd_categoria}', 'CategoryController@selectSubCategory')->name('category.subcategory')->middleware('auth:admin');
    Route::post('/subcategory', 'CategoryController@crudSubCategoria')->name('subcategory.save');
    Route::post('/catbling', 'CategoryController@verificaCatBling')->name('category.bling.save');
    Route::post('/subcatbling', 'CategoryController@verificaSubCatBling')->name('subcategory.bling.save');
    Route::post('/assocbling', 'CategoryController@associarCatSubCatBling')->name('assoc.bling.save');

    //Associa categoria/subcategoria
    Route::post('/catsubcat', 'CategoryController@associarCategoriaSubCategoria')->name('catsubcat.associate');

    //Form tamanho e cadastro
    Route::get('/size', 'SizeController@showSizeForm')->name('size.register')->middleware('auth:admin');
    Route::post('/tamanholetra', 'SizeController@cadastrarNovoTamanhoLetra')->name('lettersize.save');
    Route::post('/tamanholetra/update', 'SizeController@updateSizeLetter')->name('lettersize.update');
    Route::post('/tamanholetra/delete', 'SizeController@deleteSizeLetter')->name('lettersize.delete');
    Route::post('/tamanhonumero', 'SizeController@cadastrarNovoTamanhoNumero')->name('numbersize.save');
    Route::post('/tamanhonumero/update', 'SizeController@updateSizeNumber')->name('numbersize.update');
    Route::post('/tamanhonumero/delete', 'SizeController@deleteSizeNumber')->name('numbersize.delete');

    //Form cor e cadastro
    Route::get('/color', 'ColorController@showColorForm')->name('color.page')->middleware('auth:admin');
    Route::post('/color/update', 'ColorController@updateColor')->name('color.update');

    //Integração
    //Bling
    Route::get('/product/bling', 'ProductBlingController@importFromBling')->name('product.list.bling')->middleware('auth:admin');
    Route::get('/product/bling/bondcategory', 'ProductBlingController@vinculoCategorias')->name('bond.category.bling')->middleware('auth:admin');
    Route::get('api/bling/{pagina}', 'ProductBlingController@searchProds')->name('search.api.bling')->middleware('auth:admin');
    Route::get('api/bling/cat/{id}', 'ProductBlingController@searchCatFather')->name('searchCat.api.bling')->middleware('auth:admin');
    Route::get('api/category', 'ProductBlingController@getCategories')->name('category.api.bling')->middleware('auth:admin');
    Route::get('api/storecat', 'ProductBlingController@getStoreCategories')->name('storeCategory.api.bling')->middleware('auth:admin');
    Route::get('/product/verify/companydata', 'ProductBlingController@CompanyData')->name('verify.company.data');

    Route::get('/data', 'UserController@showUserForm')->name('admin.data')->middleware('auth:admin');

    //Edição do site
    Route::get('/hotpost', 'PageController@showHotPostPage')->name('hotpost.edit')->middleware('auth:admin');
    Route::get('/banner', 'PageController@showBannerPage')->name('banner.edit')->middleware('auth:admin');

    //Editar menus
    Route::get('/menu', 'MenuController@showEditMenuPage')->name('menu.edit')->middleware('auth:admin');
    Route::post('/menu', 'MenuController@saveMenus')->name('menu.save.non.use');
    Route::post('/menu/save', 'MenuController@crudMenu')->name('menu.save');
    Route::post('/menu/save/categoryorder', 'MenuController@salvarOrdemCategoria')->name('menu.save.category.order');
    Route::get('/menu/consult/categoryorder', 'MenuController@consultarOrdemCategorias')->name('menu.consult.category.order');
    Route::post('/menu/controlenav', 'MenuController@controleMenuNav')->name('menu.control.nav');

    //Associa menu/categoria
    Route::post('/menucat/associate', 'MenuController@associarMenuCategoria')->name('menucat.associate');

    //Sorteio
    Route::get('lottery/participant', 'LotteryController@showViewParticipant')->name('lottery.participant.page')->middleware('auth:admin');
    Route::get('lottery/prize', 'LotteryController@showViewPrize')->name('lottery.prize.page')->middleware('auth:admin');
    Route::post('lottery/save/participant', 'LotteryController@registerParticipant')->name('lottery.save.participant')->middleware('auth:admin');
    Route::post('lottery/consult', 'LotteryController@verificaCpfCnpj')->name('lottery.consult.cpf.participant')->middleware('auth:admin');
    Route::post('lottery/consult/wpp', 'LotteryController@verificaWpp')->name('lottery.consult.wpp.participant')->middleware('auth:admin');
    Route::post('lottery/update/participant', 'LotteryController@updateParticipantData')->name('lottery.update.participant')->middleware('auth:admin');
    Route::post('lottery/oldparticipant/save', 'LotteryController@oldParticipantLottery')->name('old.participant.lottery')->middleware('auth:admin');
    Route::post('lottery/public/save', 'LotteryController@savePublic')->name('lottery.save.public')->middleware('auth:admin');
    Route::post('lottery/winner/save', 'LotteryController@saveWinner')->name('lottery.save.winner')->middleware('auth:admin');
    Route::post('lottery/winner/reset', 'LotteryController@resetWinners')->name('lottery.reset.winner')->middleware('auth:admin');

    Route::get('/productconfig', 'PageController@showConfigProductPage')->name('product.config');

    Route::get('/', 'HomeController@showIndexAdminPage')->name('admin.dashboard')->middleware('auth:admin');
    Route::get('/products/list', 'ProductController@listaProduto')->name('products.list')->middleware('auth:admin');
    Route::get('/products/list/query', 'ProductController@consultaProduto')->name('products.list.query')->middleware('auth:admin');

    //Faz o logout do usuário
    Route::get('/logout', 'Auth\UserLoginController@userLogout')->name('admin.logout');

    //Resetar senha
    Route::post('/password/email', 'Auth\UserForgotPasswordController@sendResetLinkEmail')->name('admin.password.email');
    Route::get('/password/reset', 'Auth\UserForgotPasswordController@showLinkRequestForm')->name('admin.password.request')->middleware('auth:admin');
    Route::post('/password/reset', 'Auth\UserResetPasswordController@reset');
    Route::get('/password/reset/{token}', 'Auth\UserResetPasswordController@showResetForm')->name('admin.password.reset');
    //----------------
});

//App
Route::prefix('page')->group(function () {
    
    //Produtos
    Route::prefix('product')->group(function () {
        Route::get('/shop', 'ProductController@showShopProductsPage')->name('products.page');
        Route::get('/filter', 'ProductController@showShopProductsCatSubcat')->name('productsFilterCatSubCat.page');
        Route::get('/{slug}', 'ProductController@showProductDetails')->name('products.details');
        Route::post('/sizes', 'ProductController@getSizes')->name('product.sizes');
        Route::post('/getvariationdata', 'ProductController@getVariationData')->name('product.variation.data');
    });

    //Carrinho
    Route::prefix('cart')->group(function () {
        Route::get('/', 'CartController@showCartPage')->name('cart.page');
        Route::post('/', 'CartController@addToCart')->name('cart.buy');
        Route::post('/store', 'CartController@store')->name('cart.store');
        Route::post('/delete', 'CartController@deleteProduct')->name('cart.product.delete');
        Route::post('/clear', 'CartController@clearCart')->name('cart.clear');
        Route::get('/minus/{idx}', 'CartController@removeQuantityCart')->name('minus.quantity');
        Route::get('/plus/{idx}', 'CartController@addQuantityCart')->name('plus.quantity');
        Route::post('/shipping', 'CartController@calculateShipping')->name('shipping.calculate');
        Route::post('/shipping/data', 'CartController@getShippingData')->name('shipping.data');
        Route::post('/save/route', 'CartController@saveCartRoute')->name('cart.route');
    });

    //Pagamento
    Route::prefix('payment')->group(function () {
        Route::post('/checkout', 'PaymentController@createSessionId')->name('payment.checkout.session.id');
        Route::get('/checkout', 'PaymentController@showCheckoutPage')->name('payment.checkout');
        Route::get('/checkout/details/ticket', 'PaymentController@showOrderDetailsPage')->name('payment.order.ticket.details');
        Route::get('/checkout/details/creditcard', 'PaymentController@showOrderDetailsPage')->name('payment.order.creditcard.details');
        Route::post('/creditcard/saveinfo', 'PaymentController@saveCreditCardInformation')->name('payment.creditcard.info');
        Route::post('/ticket', 'PaymentController@ticketPayment')->name('payment.ticket');
        Route::post('/creditcard', 'PaymentController@creditCardPayment')->name('payment.creditcard');
        Route::get('/result', 'PaymentController@showResultPage')->name('payment.result');
    });

    //Cliente
    Route::prefix('client')->group(function () {
        Route::post('/save', 'Auth\ClientRegisterController@create')->name('client.save');
        Route::get('/register', 'Auth\ClientRegisterController@showRegisterForm')->name('client.register');
        Route::get('/login', 'Auth\ClientLoginController@showClientLoginForm')->name('client.login');
        Route::post('/login', 'Auth\ClientLoginController@login')->name('client.login.submit');
        Route::get('/dashboard', 'ClientController@showClientPage')->name('client.dashboard')->middleware('auth:web');
        Route::get('/logout', 'Auth\ClientLoginController@clientLogout')->name('client.logout');
        Route::get('/register/{cpf_cnpj}', 'Auth\ClientRegisterController@verificaCpfCnpj');
        Route::post('/address', 'ClientController@saveClientAddress')->name('client.address.save');
        Route::post('/register/verify/email', 'Auth\ClientRegisterController@verificaEmail')->name('client.verify.email');
    });

    //Terms
    Route::prefix('terms')->group(function () {
        Route::get('/', 'TermsController@companyTerms')->name('company.terms');
    });
});
