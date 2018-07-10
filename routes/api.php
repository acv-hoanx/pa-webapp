<?php

use Illuminate\Http\Request;
use App\Http\Resources\Devices as DeviceResource;
use App\User;
use App\Devices;

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

Route::group(['prefix' => 'device'], function () {
    Route::post('add', 'DeviceController@addDevice');
    Route::put('token/push', 'DeviceController@tokenPush');
});
