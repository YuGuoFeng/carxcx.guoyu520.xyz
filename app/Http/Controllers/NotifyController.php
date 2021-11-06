<?php

namespace App\Http\Controllers;


class NotifyController 
{
    /**
     *   支付  异步回调
     */
    public function notify()
    {
        

        switch (strtolower($request->param('notify_type','wenxin'))){


            case 'cz_wenxin':

                $arr = self::wx_post(); 

                $post_data = $arr['post_data'];
                $postSign  = $arr['postSign'];
                $user_sign = $arr['user_sign'];
                if(($user_sign == $postSign))
                {
                    //商户系统的订单号，与请求一致。
                    $add_time = time();
                    $order_sn=$post_data['out_trade_no'];
                    $transaction_id=$post_data['transaction_id'];
                    if($post_data['return_code']=='SUCCESS'){
                         
                        try{
                            /* $arr['pay_info']    = $arr;
                            $arr['order_id']    = $order_sn; // 后台系统单号
                            $arr['wx_order_id'] = $transaction_id; //微信单号

                            $res = CzOrderService::paySuccess($arr);

                            if($res){
                               echo 'fail';exit(); 
                            }

                            echo 'success';exit(); */

                        }catch (\Exception $e){
                            echo 'fail';exit();
                        }


                    }else{

                        echo '微信支付失败';

                    }

                }
            break; 



            default:

                break;


        }
    
    }

    public static function wx_post()
    {
        $key = 'e10adc3949ba59abbe56e057f20f883e';

        $xml =file_get_contents("php://input");  //原生POST数据

        $post_data = self::xmlToArray("$xml"); //微信支付成功，返回回调地址url的数据：XML转数组Array

        // $post_json = '{"appid":"wx45298d5e5bae7cb4","bank_type":"OTHERS","cash_fee":"1","fee_type":"CNY","is_subscribe":"N","mch_id":"1603618364","nonce_str":"vzS9tF7bYIImwhvp4T3ijuApUvXQupbd","openid":"okMXF5KOkrZ_S80Xbuth0QKXnW1M","out_trade_no":"2020110911002810009","result_code":"SUCCESS","return_code":"SUCCESS","sign":"39864E15D4957FB2A426AC35B4BD8C18","time_end":"20201109110034","total_fee":"1","trade_type":"JSAPI","transaction_id":"4200000829202011091612032436"}';
        // $post_data = json_decode($post_json,true);
        $postSign = $post_data['sign'];
        unset($post_data['sign']);
        /// 微信官方提醒：
        ksort($post_data);// 对数据进行排序

        $str =self::ToUrlParams($post_data);//对数组数据拼接成key=value字符串

        $user_sign = strtoupper(md5($str.'&key='.$key));   //再次生成签名，与$postSign比较

        return compact('post_data','postSign','user_sign');

    }

     /// XML => PHP///

    public static  function xmlToArray($xml){

        //禁止引用外部xml实体

        libxml_disable_entity_loader(true);

        $xmlstring = simplexml_load_string($xml, 'SimpleXMLElement', LIBXML_NOCDATA);

        $val = json_decode(json_encode($xmlstring),true);

        return $val;
        //print_r($val);

    }

    public static  function ToUrlParams( $params ){

        $string = '';
        if( !empty($params) ){
            $array = array();
            foreach( $params as $key => $value ){
                $array[] = $key.'='.$value;
            }
            $string = implode("&",$array);
        }
        return $string;

    }
}
