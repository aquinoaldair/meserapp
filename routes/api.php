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


Route::get('commerce/table/{qr}/all', 'ApiController@getCommerceInformationFromQr')->name('table.qr');
Route::get('commerce', 'ApiController@getCommerces');

Route::post('reservation', 'ApiController@storeReservation');
