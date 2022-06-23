<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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


Route::group(['middleware' => ['api', 'cross'], 'namespace' => 'Api',], function ($router) {
    Route::get('/', function () {
        echo 'worked!';
    });

    Route::post('login', 'AuthController@login');
    Route::post('register', 'AuthController@register');

    Route::group(['middleware' => ['jwt.auth']], function () {
        Route::get('me', 'AuthController@me');
        Route::post('logout', 'AuthController@logout');
        Route::apiResource('page', 'PageController');
        Route::post('follow/person/{id}', 'FollowerController@personFollower');
        Route::post('follow/page/{id}', 'FollowerController@pageFollower');

        Route::post('person/attach-post', 'PostController@store');
        Route::post('page/{pageId}/attach-post', 'PostController@store');

    });


});
