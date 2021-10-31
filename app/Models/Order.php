<?php

namespace App\Models;

use Dcat\Admin\Traits\HasDateTimeFormatter;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
	use HasDateTimeFormatter;
    protected $table = 'order';
    public $timestamps = false;


    // 生成订单号
    public  function getNewOrderId()
    {
        // $count = (int) self::where('release_time',['>=',strtotime(date("Y-m-d"))],['<',strtotime(date("Y-m-d",strtotime('+1 day')))])->count();
        $count = (int) self::whereBetween('add_time',[strtotime(date("Y-m-d")),strtotime(date("Y-m-d",strtotime('+1 day')))])->count();
        return date('YmdHis',time()).(10000+$count+1);
    }

}
