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
define('STYLE',url('resources/views/admin'));
/*
app()->singleton('lang',function(){
    return App\Http\Controllers\SettingController::lang();
});
*/
Auth::routes();
Route::get('logout','UsersController@logout');
Route::group(['prefix'=>'admin','middleware'=>'auth'],function (){
    Route::get('/', 'UsersController@home');
    // Control Users
    Route::get('users', 'UsersController@index');
    Route::get('users/add', 'UsersController@create');
    Route::post('users/add', 'UsersController@store');
    Route::get('users/edit/{id}', 'UsersController@edit');
    Route::post('users/edit/{id}', 'UsersController@update');
    Route::post('users/delete/{id}', 'UsersController@destroy');

    // End Of Control Users

    // Control Users Tasks
    Route::get('tasks','TasksController@index');
    Route::get('tasks/add','TasksController@create');
    Route::post('tasks/add','TasksController@store');
    Route::get('tasks/edit/{id}','TasksController@edit');
    Route::post('tasks/edit/{id}','TasksController@update');
    Route::post('tasks/delete/{id}','TasksController@destroy');
    // End Of Control Users Tasks

    // Control Users Images
    Route::get('images','ImagesController@index');
    Route::get('images/add','ImagesController@create');
    Route::post('images/add','ImagesController@store');
    Route::get('images/edit/{id}','ImagesController@edit');
    Route::post('images/edit/{id}','ImagesController@update');
    Route::post('images/delete/{id}','ImagesController@destroy');


});
