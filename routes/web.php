<?php

use Illuminate\Support\Facades\Route;

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

use App\User;
use App\Http\Middleware\CheckRoom;

Route::view('/', 'welcome');
Auth::routes(['register' => false, 'reset' => false, 'confirm' => false]);

Route::middleware('auth')->group(function (){

    Route::get('dashboard', 'DashboardController@index')->name('dashboard');

    Route::middleware('role:'.User::ADMIN_ROLE)->group(function (){
        Route::resource('commerce', 'CommerceController');
    });

    Route::middleware('role:'.User::CUSTOMER_ROLE)->group(function (){

        Route::resource('category', 'CategoryController');
        Route::resource('product', 'ProductController');
        Route::resource('room', 'RoomController');

        Route::prefix('room/{room}')->middleware(CheckRoom::class)->group(function (){
            Route::resource('table', 'TableController');
        });
    });

});
