<?php

use Illuminate\Http\Request;
use Compressor\Models\Encoding;
use Compressor\Http\Middleware\CheckUrl;

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

Route::group(['prefix' => 'send'], function () {
    // send a video to the encoder service
    Route::get('/', function (Request $request, Encoding $encoding) {
        $encoding->encode($request->url);
    })->middleware(CheckUrl::class);
});

// this is the callback received from the encoding service with an id and an event
Route::group(['prefix' => 'receive'], function () {
    // send a video to the encoder service
    Route::post('/', function (Request $request, Encoding $encoding) {
        return $encoding->callback($request->video_id, $request->event);
        // return Encode::video($request->video);
    });
});
