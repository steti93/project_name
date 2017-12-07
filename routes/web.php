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
Route::get('/', 'HomeController@getIndex' );
Route::get('names', 'HomeController@getNames' );
Route::get('usages',['as'=>'usages','uses'=>'HomeController@Usage']  );
Route::get('categories',['as'=>'categories','uses'=>'HomeController@Categories']  );
Route::get('name/{slug}',['as'=>'name','uses'=>'HomeController@getName']);
Route::get('contactUsForm', 'HomeController@getContactUsForm' );
Route::get('search/{text?}',['as' => 'search','uses' => 'SearchController@getSearchString']);
Route::get('letter/{letter?}',['as' => 'letter','uses' => 'SearchController@getSearchString']);
include_once 'admin/admin.php';