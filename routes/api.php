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


Route::group(['prefix' => 'v1/users'], function()
{
      Route::get('/', 'UserController@index');
      Route::get('/giveresults', 'UserController@giveresults');
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
      Route::get('/', 'TopicController@index');
      Route::get('/{id}', 'TopicController@show');
      Route::post('/', 'TopicController@store');
      Route::put('/{id}', 'TopicController@update');
      Route::delete('/{id}', 'TopicController@destroy');
});

Route::group(['prefix' => 'v1/topicdetails'], function()
{
      Route::get('/', 'TopicDetailController@index');
      Route::get('/{id}', 'TopicDetailController@show');
      Route::post('/', 'TopicDetailController@store');
      Route::put('/{id}', 'TopicDetailController@update');
      Route::delete('/{id}', 'TopicDetailController@destroy');
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


Route::group(['prefix' => 'v1/results'], function()
{
      Route::get('/', 'ResultController@index');
      Route::get('/{id}', 'ResultController@show');
      Route::post('/', 'ResultController@store');
      Route::put('/{id}', 'ResultController@update');
      Route::delete('/{id}', 'ResultController@destroy');
});

Route::group(['prefix' => 'v1/assignments'], function()
{
      Route::get('/', 'AssignmentController@index');
      Route::get('/{id}', 'AssignmentController@show');
      Route::post('/', 'AssignmentController@store');
      Route::put('/{id}', 'AssignmentController@update');
      Route::delete('/{id}', 'AssignmentController@destroy');
});

Route::group(['prefix' => 'v1/intake'], function()
{
      Route::get('/', 'IntakeController@get');
      Route::post('/', 'IntakeController@update');
});

Route::post('/v1/admin/login', 'AdminController@login');
Route::post('/v1/admin', 'AdminController@index');
Route::post('/v1/admin/promote', 'AdminController@store')->middleware('superadmin');
Route::post('/v1/admin/demote', 'AdminController@destroy')->middleware('superadmin');

Route::group(['prefix' => 'v1/admin/logs'], function()
{
      Route::post('/', 'LogController@index');
      Route::delete('/{id}', 'LogController@destroy');
});

// Route::group(['prefix' => 'v1/admin'], function()
// {
//       Route::get('/', 'AdminController@index');
// });
