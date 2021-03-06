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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/private-messages/{auth_user}/{receiver_id}','Api\ChatController@get_messages');
// Route::get('/get/messages',)


Route::post('/send/message/{auth_user}/{receiver_id}','Api\ChatController@send_message');
Route::get('/active/users','HomeController@userOnlineStatus');
