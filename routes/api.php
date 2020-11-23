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

Route::post('login', 'API\UserController@login');
Route::post('register', 'API\UserController@register');



Route::group(['middleware' => 'auth:api'], function(){
    Route::get('user/detail', 'Api\UserController@details');
     //------------------------------ CUSTOMER ADDRESS -----------------//
     Route::post('customeraddress/created', 'Api\CustomerAddressController@newCustomerAddress');
     Route::get('customeraddress/getaddressbyid/{id}', 'Api\CustomerAddressController@getCustomerAddressById');
     Route::delete('customeraddress/deleteaddress/{id}', 'Api\CustomerAddressController@deleteCustomerAddress');
     Route::put('customeraddress/updateaddress/{id}', 'Api\CustomerAddressController@updateCustomerAddress');
     //--------------------------------- end ----------------------------//
    Route::post('logout', 'Api\UserController@logout');
   
}); 

