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


Route::group(['prefix' => 'v1/users', 'middleware' => ['firebase']], function()
{
      Route::get('/', 'UserController@index');
      Route::get('/results', 'UserController@giveresults');
      Route::get('/timetable/{id}', 'UserController@getTimeTable');
      Route::post('/scan', 'ConfirmController@scan');
      Route::get('/confirm', 'ConfirmController@index');
      Route::get('/{id}', 'UserController@show');
      Route::put('/{id}', 'UserController@update');
      Route::delete('/{id}', 'UserController@destroy');
});

Route::group(['prefix' => 'v1/users', 'middleware' => ['firebase', 'scanner']], function()
{
      Route::post('/scan', 'ConfirmController@scan');
      Route::get('/confirm', 'ConfirmController@index');
});


Route::group(['prefix' => 'v1/courses', 'middleware' => ['firebase'] ], function()
{
      Route::get('/', 'CourseController@index');
      Route::get('/list', 'CourseController@list');
      Route::get('/{id}', 'CourseController@show');
});

Route::group(['prefix' => 'v1/courses', 'middleware' => ['firebase', 'admin'] ], function()
{
      Route::post('/', 'CourseController@store');
      Route::put('/{id}', 'CourseController@update');
      Route::put('/delete/{id}', 'CourseController@destroy');
});

Route::group(['prefix' => 'v1/notifications', 'middleware' => ['firebase']], function()
{
      Route::get('/{id}', 'NotificationController@show');
      Route::get('/seen/{id}', 'NotificationController@seen');
      Route::post('/', 'NotificationController@store');
      Route::delete('/{id}', 'NotificationController@destroy');
});

Route::group(['prefix' => 'v1/notificationtokens', 'middleware' => ['firebase']], function()
{
      Route::get('/{id}', 'NotificationTokenController@show');
      Route::post('/', 'NotificationTokenController@store');
      Route::put('/{id}', 'NotificationTokenController@update');
      Route::delete('/{id}', 'NotificationTokenController@destroy');
});

Route::group(['prefix' => 'v1/topics', 'middleware' => ['firebase']], function()
{
      Route::get('/', 'TopicController@index');
      Route::get('/{id}', 'TopicController@show');
});

Route::group(['prefix' => 'v1/topics', 'middleware' => ['firebase', 'admin']], function()
{
      Route::post('/', 'TopicController@store');
      Route::put('/{id}', 'TopicController@update');
      Route::put('/delete/{id}', 'TopicController@destroy');
});

Route::group(['prefix' => 'v1/topicdetails', 'middleware' => ['firebase']], function()
{
      Route::get('/', 'TopicDetailController@index');
      Route::get('/{id}', 'TopicDetailController@show');
      Route::get('/timetable/{id}', 'TopicDetailController@getTimeTable');
});

Route::group(['prefix' => 'v1/topicdetails', 'middleware' => ['firebase', 'admin']], function()
{
      Route::post('/', 'TopicDetailController@store');
      Route::put('/{id}', 'TopicDetailController@update');
      Route::delete('/{id}', 'TopicDetailController@destroy');
});

Route::group(['prefix' => 'v1/activities', 'middleware' => ['firebase']], function()
{
      Route::get('/', 'ActivityController@index');
      Route::get('/{id}', 'ActivityController@show');
});

Route::group(['prefix' => 'v1/activities', 'middleware' => ['firebase', 'admin']], function()
{
      Route::post('/', 'ActivityController@store');
      Route::put('/{id}', 'ActivityController@update');
      Route::put('/delete/{id}', 'ActivityController@destroy');
});

Route::group(['prefix' => 'v1/comments', 'middleware' => ['firebase']], function()
{
      Route::get('/', 'CommentController@index');
      Route::post('/', 'CommentController@store');
      Route::put('/{id}', 'CommentController@update');
      Route::delete('/{id}', 'CommentController@destroy');
});

Route::group(['prefix' => 'v1/batches', 'middleware' => ['firebase']], function()
{
      Route::get('/', 'BatchController@index');
      Route::get('/list', 'BatchController@list');
      Route::get('/{id}', 'BatchController@show');

});

Route::group(['prefix' => 'v1/batches', 'middleware' => ['firebase', 'admin']], function()
{
      Route::post('/', 'BatchController@store');
      Route::put('/{id}', 'BatchController@update');
      Route::put('/delete/{id}', 'BatchController@destroy');
});

Route::group(['prefix' => 'v1/likes' , 'middleware' => ['firebase']], function()
{
      Route::post('/', 'LikeController@store');
      Route::delete('/{id}', 'LikeController@destroy');
});


Route::group(['prefix' => 'v1/results', 'middleware' => ['firebase']], function()
{
      Route::get('/', 'ResultController@index');
      Route::get('/{id}', 'ResultController@show');
      Route::post('/', 'ResultController@store');
      Route::put('/{id}', 'ResultController@update');
      Route::delete('/{id}', 'ResultController@destroy');
});

Route::group(['prefix' => 'v1/assignments' , 'middleware' => ['firebase']], function()
{
      Route::get('/', 'AssignmentController@index');
      Route::get('/{id}', 'AssignmentController@show');
      Route::post('/', 'AssignmentController@store');
      Route::put('/{id}', 'AssignmentController@update');
      Route::delete('/{id}', 'AssignmentController@destroy');
});


Route::group(['prefix' => 'v1/intake', 'middleware' => ['firebase', 'superadmin']], function()
{
      Route::get('/', 'IntakeController@get');
      Route::put('/', 'IntakeController@update');
});


// SuperAdmin
Route::post('/v1/admin/login', 'AdminController@login');

Route::group(['prefix' => 'v1/admin', 'middleware' => ['firebase', 'superadmin']], function()
{
      Route::post('/', 'AdminController@index');
      Route::post('/promote', 'AdminController@store');
      Route::post('/demote/{id}', 'AdminController@destroy');
});

Route::group(['prefix' => 'v1/admin/logs', 'middleware' => ['firebase', 'superadmin']], function()
{
      Route::post('/', 'LogController@index');
      Route::delete('/{id}', 'LogController@destroy');
});

Route::group(['prefix' => 'v1/admin/reports'], function()
{
      Route::get('/admins', 'ReportsController@numberOfAdmin');
      Route::get('/eachmonth', 'ReportsController@numberOfUserPerMonth');
      Route::delete('/{id}', 'LogController@destroy');
});
