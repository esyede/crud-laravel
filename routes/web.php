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


// no auth
Route::get('/', 'WelcomeController@welcome')->name('welcome');
Route::get('/home/test', 'Home\HomeController@test')->name('home.test'); // for testing purposes only
Route::get('/home/testpage', 'Home\HomeController@showTestPage')->name('home.testpage'); // for testing purposes only
Route::get('/home/json_progress', 'Home\HomeController@jsonProgress')->name('home.json_progress'); 


// auth
Auth::routes();

Route::get('/home', 'Home\HomeController@home')->name('home');
Route::get('/home/downloads', 'Home\HomeController@downloads')->name('home.downloads');
Route::get('/home/tutorials', 'Home\HomeController@tutorials')->name('home.tutorials');

// product.view
Route::get('/home/products/json', 'Products\ViewController@json_all')->name('home.products.json_all');
Route::get('/home/products/json/{id}', 'Products\ViewController@json_one')->name('home.products.json_one');
// product.ajax
Route::post('/home/products/add', 'Products\CrudController@add')->name('home.products.add');
Route::get('/home/products/edit/{id}', 'Products\CrudController@showEditForm')->name('home.products.edit'); // no ajax
Route::post('/home/products/edit/{id}', 'Products\CrudController@edit')->name('home.products.edit'); // no ajax
Route::post('/home/products/remove/{id}', 'Products\CrudController@remove')->name('home.products.remove');

// catalogs.view
Route::get('/home/catalogs/json', 'Catalogs\ViewController@json_all')->name('home.catalogs.json_all');
Route::get('/home/catalogs/json/{id}','Catalogs\ViewController@json_one')->name('home.catalogs.json_one');
Route::get('/home/catalogs', 'Catalogs\ViewController@all')->name('home.catalogs.all');
Route::get('/home/catalogs/{id?}', 'Catalogs\ViewController@one')->name('home.catalogs.one');
// catalogs.ajax
Route::post('/home/catalogs/add', 'Catalogs\CrudController@add')->name('home.catalogs.add');
Route::get('/home/catalogs/edit', 'Catalogs\CrudController@editJson')->name('home.catalogs.edit');
Route::post('/home/catalogs/edit', 'Catalogs\CrudController@edit')->name('home.catalogs.edit');
Route::post('/home/catalogs/remove', 'Catalogs\CrudController@remove')->name('home.catalogs.remove');

// users.view
Route::get('/home/users/json', 'Users\ViewController@json_all')->name('home.users.json_all');
Route::get('/home/users', 'Users\ViewController@all')->name('home.users.all');
// users.ajax
Route::post('/home/users/add', 'Users\CrudController@add')->name('home.users.add');
Route::get('/home/users/edit', 'Users\CrudController@editJson')->name('home.users.edit');
Route::post('/home/users/edit', 'Users\CrudController@edit')->name('home.users.edit');
Route::post('/home/users/renew', 'Users\CrudController@renew')->name('home.users.renew');
Route::post('/home/users/change_roles', 'Users\CrudController@change_roles')->name('home.users.change_roles');
Route::post('/home/users/remove', 'Users\CrudController@remove')->name('home.users.remove');
Route::post('/home/users/swap', 'Users\CrudController@swap')->name('home.users.swap');

// settings.pasword
Route::get('/home/settings/password', 'Settings\UserController@showPasswordForm')->name('home.settings.password');
Route::post('/home/settings/password', 'Settings\UserController@password')->name('home.settings.password');

// settings.shop
Route::get('/home/settings/shop', 'Settings\UserController@showShopForm')->name('home.settings.shop');
Route::post('/home/settings/shop/edit', 'Settings\UserController@shop')->name('home.settings.shop.edit');

// settings.data
Route::get('/home/settings/data', 'Settings\UserController@showDataForm')->name('home.settings.data');
Route::post('/home/settings/data/edit', 'Settings\UserController@data')->name('home.settings.data.edit');

// settings.site
Route::get('/home/settings/site', 'Settings\SitesController@site')->name('home.settings.site');
Route::post('/home/settings/site', 'Settings\SitesController@site')->name('home.settings.site.edit');

// links.view
Route::get('/home/downloads', 'Home\LinkController@showDownload')->name('home.downloads');
Route::get('/home/tutorials', 'Home\LinkController@showTutorial')->name('home.tutorials');
Route::get('/home/links/json_all/{id}', 'Home\LinkController@json_all')->name('home.links.json_all');
// links.ajax
Route::post('/home/links/add', 'Home\LinkController@add')->name('home.links.add');
Route::get('/home/links/edit', 'Home\LinkController@editJson')->name('home.links.edit');
Route::post('/home/links/edit', 'Home\LinkController@edit')->name('home.links.edit');
Route::post('/home/links/remove', 'Home\LinkController@remove')->name('home.links.remove');

Route::get('home/shop', 'Home\TestController@index');


