<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
class Order extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order', function (Blueprint $table) {
            $table->id();
            $table->string('approach_number',200)->comment('进场编号');
            $table->integer('user_id')->comment('用户id');
            $table->string('order_id',200)->comment('订单号');
            $table->string('name',100)->comment('姓名');
            $table->string('mobile',100)->comment('手机号');
            $table->string('wl_company',200)->comment('物流公司');
            $table->string('car_number',200)->comment('车牌号');
            $table->string('trailer_number',200)->comment('挂车号');
            $table->integer('pay_time',)->comment('支付时间');
            $table->tinyInteger('state')->default('0')->comment('支付状态   0=否  1=是');
            $table->string('pay_data',255)->nullable()->comment('微信支付信息');
            $table->timestamps();
        });
        DB::statement("ALTER TABLE `order` comment '订单号'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
