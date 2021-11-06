<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\ReponseData as r;
use Illuminate\Http\Request;
use App\Models\WxQrCode as wqcm;
use Illuminate\Support\Facades\DB;
use App\Models\Order ;
use App\Services\WechatServices as ws;
use App\Library\AesUtil;
use App\Models\WxUser as wum;
class UserController extends Controller
{

    // 获取小程序openid
    public function getWeiOpenId(Request $request){

        try{
            $code = $request->get('code');
            if($code == null){
                throw new \Error('缺少code 值');
            }
            $data = (new ws)->getWeiOpenId($code);

            return r::rMsgData(200,'ok',$data); 
        }catch(\Exception $e){
            return r::tryMsg($e);
        }
    }
    // 获取微信手机号
    public function getTel(Request $request){

        try{
            $session = $request->session;
            $iv = $request->iv;
            $encryptedData = $request->encryptedData;


            if($session == null){
                throw new \Error('缺少code 值');
            }
            $data = (new ws)->decryptData($session, $iv, $encryptedData);

            return r::rMsgData(200,'ok',$data); 
        }catch(\Exception $e){
            return r::tryMsg($e);
        }
    }
    // 用户登陆
    public function loginUser(Request $request){
        try{
            
            $p = [
                'aes_data' => ['aes_data','',true,'加密数据'],
            ];
            $post = $this->ParamArr($p,$request->all());
            $json_str = (new AesUtil)->decrypt($post['aes_data']);
            if(!$json_str){
                throw new \Exception('解密失败！');
            }
            $data = json_decode($json_str,true);
            if(empty($data['name'])){
                throw new \Exception('缺少用户名称');
            }
            if(empty($data['phone'])){
                throw new \Exception('缺少手机号');
            }
            $row = (new wum)->where('phone',$data['phone'])->first();
            if($row){
                $id = $row['id'];
                $row->name = $data['name'];
                if(!empty($data['avatar'])){
                    $row->avatar = $data['avatar'];
                }
                $row->save();
            }else{
                $data['add_time'] = time();
                $id = (new wum)->insertGetId($data); 
            }
            $id_aes = (new AesUtil)->encrypt($id);
            return r::rMsgData(200,'ok',$id_aes); 
        }catch(\Exception $e){
            return r::tryMsg($e);
        }
    }

}