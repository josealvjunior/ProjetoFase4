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

Route::get('/', function () {
    return view('welcome');
});

Route::post('oauth/access_token', function(){
   return Response::json(Authorizer::issueAccessToken());
});

Route::group(['middleware'=>'oauth'], function(){

    Route::resource('client', 'ClientController',['except'=>'create', 'edit']);

    Route::resource('projects', 'ProjectsController',['except'=>'create', 'edit']);

    Route::group(['prefix'=>'projects'], function(){
        route::get('{id}/notes', 'ProjectNotesController@index');
        route::post('{id}/notes', 'ProjectNotesController@store');
        route::get('{id}/notes/{noteId}', 'ProjectNotesController@show');
        route::put('{id}/notes/{noteId}', 'ProjectNotesController@update');
        route::delete('{id}/notes/{noteId}', 'ProjectNotesController@destroy');

        route::get('{id}/task', 'ProjectTaskController@index');
        route::post('{id}/task', 'ProjectTaskController@store');
        route::get('{id}/task/{taskId}', 'ProjectTaskController@show');
        route::put('{id}/task/{taskId}', 'ProjectTaskController@update');
        route::delete('{id}/task/{taskId}', 'ProjectTaskController@destroy');

        route::get('{id}/members', 'ProjectMembersController@index');
        route::post('{id}/members', 'ProjectMembersController@store');
        route::get('{id}/members/{membersId}', 'ProjectMembersController@isMember');
        route::put('{id}/members/{membersId}', 'ProjectMembersController@update');
        route::delete('{id}/members/{membersId}', 'ProjectMembersController@destroy');

        Route::post('{id}/file','ProjectFileController@store');
        Route::delete('{id}/file/{projectFileId}', 'ProjectFileController@destroy');

    });
});

