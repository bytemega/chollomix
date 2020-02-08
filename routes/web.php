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

Route::get('/','WebController@index')->name('welcome');
Route::get('products','ProductsController@index')->name('products');
Route::get('products/{hash}','ProductsController@view')->name('product-view');
Route::get('categories/{hash}','CategoriesController@view')->name('category-view');


Route::get('amazon','WebController@amazon');

Route::get('amazon/getProducts/{hash}','Stores\AmazonController@getProducts')->name('amazon.getProducts');
Route::get('amazon/getProductDetails/{hash}','Stores\AmazonController@getProductDetails')->name('amazon.importProduct');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');




Route::get('amazon/test','Stores\AmazonController@gtest')->name('amazon.test');