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

$admin = User::ADMIN_ROLE;
$customer = User::CUSTOMER_ROLE;

Route::view('/', 'welcome');
Auth::routes(['confirm' => false]);

Route::middleware('auth')->group(function () use ($admin, $customer) {

    Route::get('dashboard', 'DashboardController@index')->name('dashboard');

    //only admin
    Route::middleware("role:{$admin}")->group(function (){
        Route::resource('commerce', 'CommerceController');
        Route::resource('image', 'ImageController');
    });

    //only customer
    Route::middleware("role:{$customer}")->group(function (){

        Route::get('category/general', 'CategoryController@getGeneral');
        Route::post('category/customer/create', 'CategoryController@createCategoryFromGeneral');
        Route::get('images/search/{term}', 'ImageController@search');
        Route::resource('supplier', 'SupplierController');
        Route::resource('product', 'ProductController');
        Route::resource('room', 'RoomController');
        Route::resource('cost', 'CostController');
        Route::resource('station', 'StationController');
        Route::resource('printer', 'PrinterController')->only('index', 'store');
        Route::prefix('room/{room}')->middleware(CheckRoom::class)->group(function (){
            Route::resource('table', 'TableController');
        });
    });

    //only admin & customer
    Route::middleware("role:{$admin}|{$customer}")->group(function (){
        Route::resource('category', 'CategoryController');
    });


});
