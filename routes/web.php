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
Route::get('name',['as'=>'name','uses'=>'HomeController@getName']);
Route::get('contactUsForm', 'HomeController@getContactUsForm' );
Route::any('search',['as' => 'search','uses' => 'SearchController@getSearchElements']);
Route::get('letter/{letter}',['as' => 'letter','uses' => 'SearchController@getSearchString']);
