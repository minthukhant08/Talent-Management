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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::group(['prefix' => 'v1/users'], function()
{
      Route::post('/', 'UserController@store');
});

Route::get('v1/courses/image/{id}', 'CourseController@image');
Route::get('v1/activities/image/{id}', 'ActivityController@image');

// 'middleware' => 'jwt.auth'

Route::group(['prefix' => 'v1/users'], function()
{
      Route::get('/', 'UserController@index');
      Route::get('/{id}', 'UserController@show');
      Route::put('/{id}', 'UserController@update');
      Route::delete('/{id}', 'UserController@destroy');
});

Route::group(['prefix' => 'v1/courses'], function()
{
      Route::get('/', 'CourseController@index');
      Route::get('/{id}', 'CourseController@show');
      Route::post('/', 'CourseController@store');
      Route::put('/{id}', 'CourseController@update');
      Route::delete('/{id}', 'CourseController@destroy');
});

Route::group(['prefix' => 'v1/notifications'], function()
{
      Route::get('/{id}', 'NotificationController@show');
      Route::post('/', 'NotificationController@store');
      Route::delete('/{id}', 'CourseController@destroy');
});

Route::group(['prefix' => 'v1/topics'], function()
{
      Route::get('/{id}', 'TopicController@show');
      Route::post('/', 'TopicController@store');
      Route::put('/{id}', 'TopicController@update');
      Route::delete('/{id}', 'TopicController@destroy');
});

Route::group(['prefix' => 'v1/activities'], function()
{
      Route::get('/', 'ActivityController@index');
      Route::get('/{id}', 'ActivityController@show');
      Route::post('/', 'ActivityController@store');
      Route::put('/{id}', 'ActivityController@update');
      Route::delete('/{id}', 'ActivityController@destroy');
});

Route::group(['prefix' => 'v1/comments'], function()
{
      Route::get('/', 'CommentController@index');
      Route::post('/', 'CommentController@store');
      Route::put('/{id}', 'CommentController@update');
      Route::delete('/{id}', 'CommentController@destroy');
});

Route::group(['prefix' => 'v1/batches'], function()
{
      Route::get('/', 'BatchController@index');
      Route::get('/{id}', 'BatchController@show');
      Route::post('/', 'BatchController@store');
      Route::put('/{id}', 'BatchController@update');
      Route::delete('/{id}', 'BatchController@destroy');
});

Route::group(['prefix' => 'v1/likes'], function()
{
      Route::post('/', 'LikeController@store');
      Route::delete('/{id}', 'LikeController@destroy');
});

Route::group(['prefix' => 'v1/replies'], function()
{
      Route::post('/', 'LikeController@store');
      Route::put('/{id}', 'BatchController@update');
      Route::delete('/{id}', 'LikeController@destroy');
});

Route::group(['prefix' => 'v1/intake'], function()
{
      Route::put('/update', 'IntakeController@update');
      Route::get('/', 'IntakeController@get');
});
