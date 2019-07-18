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

Route::get('/', function () {
    return view('welcome');
});

Route::group(['prefix' => 'seller', 'middleware'=>'auth'], function() {
	Route::group(['prefix' => 'product'], function() {
		Route::get('/', ['as' => 'seller.product', 'uses' => 'ProductController@index']);
		Route::get('/new', ['as' => 'seller.product.new', 'uses' => 'ProductController@getAddProduct']);
		Route::post('/new', ['as' => 'seller.product.postNew', 'uses' => 'ProductController@postAddProduct']);

		
	});
	Route::group(['prefix' =>'agency'], function() {
		Route::get('/{id?}', ['as' => 'seller.agency', 'uses' => 'AgencyController@index']);
		Route::post('/{id}', ['as' => 'seller.agency.delAgency', 'uses' => 'AgencyController@delAgency']);
		Route::get('/new', ['as' => 'seller.agency.new', 'uses' => 'AgencyController@getAddAgency']);
		Route::post('/new', ['as' => 'seller.agency.postNew', 'uses' => 'AgencyController@postAddAgency']);
		Route::get('/edit/{id}', ['as' => 'seller.agency.edit', 'uses' => 'AgencyController@getEditAgency']);
		Route::post('edit/{id}', ['as' => 'seller.agency.postEdit', 'uses' => 'AgencyController@postEditAgency']);
		Route::get('/delImg/{id}', ['as' => 'seller.agency.delImg', 'uses' => 'AgencyController@delImgAgency']);
		
	});
});

Route::get('test', function (){
	return view('test');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('signin', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('signin', 'Auth\LoginController@login');

Route::get('signup', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('signup', 'Auth\RegisterController@register');