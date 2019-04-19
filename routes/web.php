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

Auth::routes();


Route::group(['middleware'=>'user'],function () {


    Route::get('/home', 'HomeController@index')->name('home');

    Route::get('/createGroup', function () {
        return view('group_form');
    });

    Route::post('/make/group', 'groupController@make_group'); //No interface

    Route::get('/showGroup', 'groupController@showGroups');

    Route::get('/group/community/{x?}', 'groupController@group_community');

    Route::post('group/joinUser/{x?}', 'groupUserController@group_joinUser');   //No interface
    Route::get('group/joinUser/{x?}', 'groupUserController@group_joinUser');   //No interface

    Route::get('/user/profile', 'userController@show_mygroups');

    Route::post('/user/profile/image', 'userController@edit_profile_image');  //No interface

    Route::post('/add/comment/{x?}', 'commentController@add_comment');  //No interface

    Route::post('/add/second/comment/{x?}', 'commentController@add_second_comment');  //No interface

    Route::post('/add/question/{x?}', 'questionController@add_question');  //No interface

    Route::post('/add/question/answer/{x?}', 'questionController@add_answer');  //No interface


    Route::get('/events/calender', 'eventController@index');

    Route::post('/create/event{x?}', function () {
        return view('event_form');
    });

    Route::get('/create/event{x?}', function () {
        return view('event_form');
    });

    Route::post('/add/event/{x?}', 'eventController@add_event');    //No interface

    Route::get('event/details/{x?}', 'eventController@event_details');


});

