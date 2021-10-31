<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\WxQrCodeController;
use App\Http\Controllers\Api\V1\UserController;
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


// v1
Route::group(['namespace'=>'Api'],function(){    
   
    Route::group(['prefix'=>'v1','namespace'=>'V1'],function(){
        // 根据二维码id 获取 信息
        Route::get('qr/data/{id}',[WxQrCodeController::class,'qrData']); 

        // 提交表单
        Route::post('form',[WxQrCodeController::class,'form']);
        // 获取小程序openid
        Route::get('getWeiOpenId',[UserController::class,'getWeiOpenId']);

    });

    
});