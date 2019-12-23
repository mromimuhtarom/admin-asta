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

Route::post('avatars/file', 'PlayersController@avatar');
Route::post('insert/abuse_transaction', 'AbuseTransactionReportController@api_insert_abuse_transaction');
Route::post('Avatar-profile', 'PlayersController@avatarplayer');
Route::post('terserah', function(Request $request) {
    $a = $request->clive;
    return $a;
});