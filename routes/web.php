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

Route::get('/', 'HomePageController@index')->name('homePage');
Route::post('/', 'HomePageController@searchByNameProduct')->name('searchByNameProduct');

Route::group(['prefix' => 'seller', 'middleware' => 'leveluser'], function() {
	Route::group(['prefix' => 'product'], function() {
		Route::get('/', ['as' => 'seller.product', 'uses' => 'ProductController@index']);
		Route::get('/new', ['as' => 'seller.product.new', 'uses' => 'ProductController@getAddProduct']);
		Route::post('/new', ['as' => 'seller.product.postNew', 'uses' => 'ProductController@postAddProduct']);
		Route::get('/edit/{id}', ['as' => 'seller.product.edit', 'uses' => 'ProductController@getEditProduct']);
		Route::post('/edit/{id}', ['as' => 'seller.product.postEdit', 'uses' => 'ProductController@postEditProduct']);
		Route::post('delImg', ['as' => 'seller.product.delImg', 'uses' => 'ProductController@delImgProduct']);
		Route::post('delAgencyProduct', ['as' => 'seller.product.dellAgencyProduct', 'uses' => 'ProductController@delAgencyProduct']);
		Route::post('delProduct/{id}', ['as' => 'seller.product.delProduct', 'uses' => 'ProductController@delProduct']);
		Route::post('setDefaultImg', ['as' => 'seller.product.setDefaultImg', 'uses' => 'ProductController@setDefaultImg']);
		
	});
	Route::group(['prefix' =>'agency'], function() {
		Route::get('/', ['as' => 'seller.agency', 'uses' => 'AgencyController@index']);
		Route::post('/delete/{id}', ['as' => 'seller.agency.delAgency', 'uses' => 'AgencyController@delAgency']);
		Route::get('/new', ['as' => 'seller.agency.new', 'uses' => 'AgencyController@getAddAgency']);
		Route::post('/new', ['as' => 'seller.agency.postNew', 'uses' => 'AgencyController@postAddAgency']);
		Route::get('/edit/{id}', ['as' => 'seller.agency.edit', 'uses' => 'AgencyController@getEditAgency']);
		Route::post('edit/{id}', ['as' => 'seller.agency.postEdit', 'uses' => 'AgencyController@postEditAgency']);
		Route::post('/delImg', ['as' => 'seller.agency.delImg', 'uses' => 'AgencyController@delImgAgency']);
	});
	Route::group(['prefix' =>'order'], function() {
		Route::get('/', ['as' => 'seller.order', 'uses' => 'OrderController@index']);
		Route::get('/viewOrderDetail/{id}', 'OrderController@viewOrderDetail');
		Route::post('/setStatus', ['as' => 'seller.order.setStatus', 'uses' => 'OrderController@setStatus']);
		Route::post('/editOrderDetail', ['as' => 'seller.order.editOrderDetail', 'uses' => 'OrderController@editOrderDetail']);
		Route::post('/deleteOrderDetail', ['as' => 'seller.order.deleteOrderDetail', 'uses' => 'OrderController@deleteOrderDetail']);
		Route::post('/deleteOrder', ['as' => 'seller.order.deleteOrder', 'uses' => 'OrderController@deleteOrder']);
	});
});


Route::group(['prefix' => 'buyer'], function() {
	Route::get('signin', ['as' => 'buyer.signin', 'uses' => 'BuyerController@getLogin']);
	Route::get('payment', ['as' => 'buyer.payment', 'uses' => 'BuyerController@getPayment'])->middleware('buyer');

	Route::group(['prefix' => 'profile'], function() {
		Route::get('/', ['as' => 'buyer.profile', 'uses' => 'BuyerController@getProfile'])->middleware('buyer');
		Route::post('/', ['as' => 'buyer.profile', 'uses' => 'BuyerController@postProfile'])->middleware('buyer');
		Route::post('/account', ['as' => 'buyer.profile.account', 'uses' => 'BuyerController@getInfoAccount'])->middleware('buyer');
		Route::post('/changePass', ['as' => 'buyer.profile.changePass', 'uses' => 'BuyerController@postChangePassword'])->middleware('buyer');
		Route::post('/listOrder', ['as' => 'buyer.profile.listOrder', 'uses' => 'BuyerController@listOrder'])->middleware('buyer');
		Route::get('/orderDetail/{id}', ['as' => 'buyer.profile.orderDetail', 'uses' => 'OrderController@viewOrderDetail'])->middleware('buyer');
		Route::post('/deleteOrder', ['as' => 'buyer.profile.deleteOrder', 'uses' => 'OrderController@deleteOrder']);
	});
});

Route::get('getDataCart', 'CartController@getDataCart')->name('getDataCart');

Route::get('auth/{provider}', 'BuyerController@redirectToProvider');
Route::get('auth/{provider}/callback', 'BuyerController@handleProviderCallback');


Route::get('/products/{slug}/{productId}', 'SingleProductController@getData')->name('singleProductList');
Route::get('/cart', 'CartController@index')->name('cart');
Route::post('/payment', 'CartController@orderProduct')->name('order');

Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');

Route::get('signin', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('signin', 'Auth\LoginController@login');

Route::get('signup', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('signup', 'Auth\RegisterController@register');

Route::get('search/{min}/{max}', 'HomePageController@searchByPriceSlide')->name('searchPrice');