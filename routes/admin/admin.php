<?php

Route::middleware(['web','admin'])->group(function () {
    Route::get('parser/genders', ['as' => 'genders', 'uses' => 'ParserController@Genders']);

    Route::get('admin',['as'=>'admin','uses'=>'Admin\AdminController@Admin']);
    Route::get('admin/logout',['as'=>'admin/logout','uses'=>'Admin\RegisterController@AdminLogout']);
    //==========================TRANSLATER====================//
    Route::get('admin/translation',['as' => 'admin/translation','uses' => 'AdminController@test']);
    Route::post('admin/translation',['as' => 'admin/translation/set','uses' => 'AdminController@set']);
    //==========================TRANSLATER====================//
});

Route::group(['middleware' => ['web','guest_admin']],function(){
    Route::post('admin/login',['as'=>'admin/login','uses'=>'Admin\RegisterController@AdminLogin']);
    Route::get('admin/login',['as'=>'admin/login',function(){
        return view('admin.login.login');
    }]);

    //names

    Route::get('admin/names',['as'=>'admin/names','uses'=>'Admin\NamesController@Names']);
    Route::delete('admin/names',['as'=>'admin/names','uses'=>'Admin\NamesController@NamesDelete']);
    Route::get('admin/name/{id?}',['as'=>'admin/name','uses'=>'Admin\NamesController@Name']);
    Route::post('admin/name/{id?}',['as'=>'admin/name','uses'=>'Admin\NamesController@NamePost']);
    Route::post('admin/products_delete_img',['as'=>'admin/products_delete_img','uses'=>'Admin\NamesController@DeleteImage']);



    Route::get('admin/usages',['as'=>'admin/usages','uses'=>'Admin\UsagesController@Usages']);
    Route::delete('admin/usages',['as'=>'admin/usages','uses'=>'Admin\UsagesController@UsagesDelete']);
    Route::get('admin/usage/{id?}',['as'=>'admin/usage','uses'=>'Admin\UsagesController@Usage']);
    Route::post('admin/usage/{id?}',['as'=>'admin/usage','uses'=>'Admin\UsagesController@UsagePost']);


    Route::get('admin/images',['as'=>'admin/images','uses'=>'Admin\ImagesController@Images']);
    Route::delete('admin/images',['as'=>'admin/images','uses'=>'Admin\ImagesController@ImagesDelete']);
    Route::get('admin/image/{id?}',['as'=>'admin/image','uses'=>'Admin\ImagesController@Image']);
    Route::post('admin/image/{id?}',['as'=>'admin/image','uses'=>'Admin\ImagesController@ImagePost']);


    Route::get('file/{name}',function(){
        \App\Http\Controllers\Admin\NamesController::GetImage(1);
    });
});


?>

