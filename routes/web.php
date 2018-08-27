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
/*
Route::get('/', function () {
    return view('layout');
});
*/
//Route::get('about','testController@about');

// frontend controller
Route::get('/','HomeController@index');




//backend controller
Route::get('/logout','SuperAdminController@logout');
Route::get('/admin','AdminController@index');
Route::get('/dashboard','AdminController@show_dashboard');
Route::post('/admin-dashboard','AdminController@dashboard');



//category related route
Route::get('/add-category','CategoryController@index');
Route::get('/all-category','CategoryController@all_category');
Route::post('/save-category','CategoryController@save_category');
Route::get('/inactive_category/{category_id}','CategoryController@inactive_category');
Route::get('/active_category/{category_id}','CategoryController@active_category');
Route::get('/edit_category/{category_id}','CategoryController@edit_category');
Route::post('/update_category/{category_id}','CategoryController@update_category');


//extra for practice api
Route::get('/new',function(){
    return view('check');
});
Route::get('/admin-api/{id}','AdminController@api');