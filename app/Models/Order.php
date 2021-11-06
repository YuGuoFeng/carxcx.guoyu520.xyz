<?php

namespace App\Models;

use Dcat\Admin\Traits\HasDateTimeFormatter;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
	use HasDateTimeFormatter;
    protected $table = 'order';
    public $timestamps = false;

    protected $fillable = [
        'approach_number','user_id','order_id',
        'name','mobile','wl_company','car_number',
        'trailer_number','pay_time','state',
        'pay_data','add_time','qr_code_id'
    ];

    public function getOrderNumber(){
        $count = (int) self::whereBetween('add_time',[strtotime(date("Y-m-d")),strtotime(date("Y-m-d",strtotime('+1 day')))])->count();
        return $count+1;
    }

    // 生成订单号
    public  function getNewOrderId()
    {
        // $count = (int) self::where('release_time',['>=',strtotime(date("Y-m-d"))],['<',strtotime(date("Y-m-d",strtotime('+1 day')))])->count();
        $date =  date('Ymd',time());
        $count = $this->getOrderNumber();
        $order_id = $date.(10000+$count);
        $approach_number = $date.'-'.$count;
        return compact('order_id','approach_number');
    }

}
