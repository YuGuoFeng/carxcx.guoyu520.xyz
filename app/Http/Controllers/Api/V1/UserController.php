<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\ReponseData as r;
use Illuminate\Http\Request;
use App\Models\WxQrCode as wqcm;
use Illuminate\Support\Facades\DB;
use App\Models\Order ;
class UserController extends Controller
{

    // 获取小程序openid
    public function getWeiOpenId(Request $request){

    }

}