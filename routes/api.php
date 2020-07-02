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
Route::get('commerces', 'ApiController@getCommerces');

Route::post('reservation', 'ApiController@storeReservation');
Route::get('commerce/{id}', 'ApiController@getDataFromCommerceId');

Route::post('service', 'ApiController@storeService');
Route::get('service/{id}', 'ApiController@getService');
Route::post('order', 'ApiController@storeOrder');
Route::post('payment', 'ApiController@storePayment');
Route::post('rating', 'ApiController@storeRating');


Route::post("login", "Api\AuthController@login");
Route::post("register", "Api\AuthController@register");

