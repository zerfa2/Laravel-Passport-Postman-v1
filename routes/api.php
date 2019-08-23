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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group([
    "prefix"=>"v1", 
    "namespace" => "Api\V1", 
    "middleware" =>["auth:api"]
],function(){
    Route::apiResources([
        'posts'=>'PostController',
        'users'=>'UserController',
        'comments' =>'CommentController'

    ]);
    // Route::apiResource('posts','PostController');


    //! Se crea un controller para el relationships
    Route::get('/posts/{post}/relationships/author','PostRelationShipController@author')->name('post.relationships.author');
    Route::get('/posts/{post}/author','PostRelationShipController@author')->name('post.author');

    Route::get('/posts/{post}/relationships/comments','PostRelationShipController@comments')->name('post.relationships.comments');
    Route::get('/posts/{post}/comments','PostRelationShipController@comments')->name('post.comments');

});

Route::post('login', 'Api\AuthController@login');
Route::post('signup','Api\AuthController@signup');
