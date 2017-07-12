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


Route::group([], function() {
	Route::match(['get','post'],'/',['uses'=>'Site\IndexController@execute','as'=>'home']);
	Route::get('/page/{alias}',['uses'=>'Site\PageController@execute','as'=>'page']);

	Route::auth(); // Маршруты для авторизации и аунтификации ( Создание views "php artisan make:auth")
});

//admin/service
Route::group(['prefix'=>'admin','middleware'=>'auth'], function() {
	// admin
	Route::get('/', function() {
		if(view()->exists('admin.index')) {
			$data = ['title' => 'Панель администратора'];
			
			return view('admin.index',$data);
		}
	});

	//admin/pages
	Route::group(['prefix'=>'pages'], function() {

		// /admin/pages
		Route::get('/',['uses'=>'Admin\PagesController@execute','as'=>'pages']);

		// /admin/pages/add
		Route::match(['get','post'], '/add', ['uses'=>'Admin\PagesAddController@execute','as'=>'pagesAdd']);

		// /admin/pages/edit/2
		Route::match(['get','post','delete'], '/edit/{page}', ['uses'=>'Admin\PagesEditController@execute','as'=>'pagesEdit']);
	});

	//admin/portfolios
	Route::group(['prefix'=>'portfolios'], function() {

		// /admin/portfolio
		Route::get('/',['uses'=>'Admin\PortfolioController@execute','as'=>'portfolios']);

		// /admin/portfolio/add
		Route::match(['get','post'], '/add', ['uses'=>'Admin\PortfolioAddController@execute','as'=>'portfoliosAdd']);

		// /admin/portfolio/edit/2
		Route::match(['get','post','delete'], '/edit/{portfolio}', ['uses'=>'Admin\PortfolioEditController@execute','as'=>'portfoliosEdit']);
	});

	//admin/services
	Route::group(['prefix'=>'services'], function() {

		// /admin/service
		Route::get('/',['uses'=>'Admin\ServiceController@execute','as'=>'services']);

		// /admin/service/add
		Route::match(['get','post'], '/add', ['uses'=>'Admin\ServiceAddController@execute','as'=>'servicesAdd']);

		// /admin/service/edit/2
		Route::match(['get','post','delete'], '/edit/{service}', ['uses'=>'Admin\ServiceEditController@execute','as'=>'servicesEdit']);
	});

	//admin/peoples
	Route::group(['prefix'=>'peoples'], function() {

		// /admin/peoples
		Route::get('/',['uses'=>'Admin\PeopleController@execute','as'=>'peoples']);

		// /admin/peoples/add
		Route::match(['get','post'], '/add', ['uses'=>'Admin\PeopleAddController@execute','as'=>'peoplesAdd']);

		// /admin/peoples/edit/2
		Route::match(['get','post','delete'], '/edit/{service}', ['uses'=>'Admin\PeopleEditController@execute','as'=>'peoplesEdit']);
	});
	
});

Auth::routes();

Route::get('/home', 'HomeController@index');
