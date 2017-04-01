<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

/* Setting controller group */
Route::group(['namespace' => 'Admin\Setting'],function (){

    //setting category
    Route::get('admin/category','CategoryController@index')->name('get_category');
    Route::post('admin/category','CategoryController@index')->name('post_category');

    Route::get('admin/post','NewPostController@index')->name('get_new_post');
    Route::post('admin/post','NewPostController@index')->name('post_new_post');



});
