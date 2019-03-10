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

// Videos routes
Route::apiResource('videos', 'API\VideosController');

// Contents routes
Route::apiResource('video_contents', 'API\VideoContentsController');
Route::get('video_contents/videos/{id}', 'API\VideoContentsController@getByVideoId');

// Problems routes
Route::apiResource('video_problems', 'API\VideoProblemsController');
Route::apiResource('video_answers', 'API\VideoAnswersController');

// Anotations routes
Route::apiResource('anotations', 'API\AnotationsController');

// Interactions routes
Route::apiResource('interactions', 'API\InteractionsController');
Route::get('interactions/videos/{id}', 'API\InteractionsController@getByVideoId');
