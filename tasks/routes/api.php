<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:api');
Route::get('tasks','ApiController@tasks');

Route::group(['prefix'=>'tasks'],function (){
    // Login And Register
    Route::post('login','ApiController@login');
    Route::post('register','ApiController@register');
});

Route::group(['prefix'=>'user_task','middleware'=>'auth:api'],function (){

    // Control Tasks
    Route::get('user','ApiController@task');
    Route::post('add/task','ApiController@addTask');
    Route::post('edit/task','ApiController@editTask');
    Route::post('delete/task','ApiController@DeleteTask');

    // Control Images
    Route::post('add/image','ApiController@AddImage');
    Route::get('user/image','ApiController@userImage');


});