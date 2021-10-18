<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
class QxFields extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('qx_fields', function (Blueprint $table) {
            $table->id();
            $table->integer('access_id')->comment('权限配置表 id');
            $table->string('fields', 255)->comment('字段');
            $table->string('name')->comment('字段名称');
            $table->tinyInteger('search')->default('0')->comment('用于搜索   0=否  1=是');
            $table->timestamps();
            $table->softDeletes();
        });
        DB::statement("ALTER TABLE `qx_fields` comment '权限配置'");
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
