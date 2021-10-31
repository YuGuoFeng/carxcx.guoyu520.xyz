<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;


     /**
    * 获取post 和 get 传值
    * [PostGet description]
     $array = [
        '返回的字段' => ['传的字段','默认值','是否为空的判断','提示'],
        'uniqid' => ['uniqid','',1,'请填写购物车唯一值'],
    ];
    */
   protected function ParamArr($array=[],$PostGet=[])
   {
        $data    = [];
        if(is_array($array) && !empty($array)){
            foreach ($array as $k=>$v) {
                $data[$k] =  $PostGet[$v[0]]??$v[1];
                if(!empty($v[2])){
                    if(!isset($data[$k])){
                        throw new \Exception($v[3]);
                    }
                }
            }
        }
        return $data;
   }
}
