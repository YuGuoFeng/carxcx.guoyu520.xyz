<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
class Qx extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('qx', function (Blueprint $table) {
            $table->id();
            $table->string('title', 60)->nullable()->comment('分类名称');
            $table->string('apply', 255)->nullable()->comment('申请权限(角色id 多个用英文都好隔开)');
            $table->string('reading', 255)->nullable()->comment('阅读权限(角色id 多个用英文都好隔开)');
            $table->string('operation', 255)->nullable()->comment('处理权限(角色id 多个用英文都好隔开)');
            $table->tinyInteger('state')->default('0')->comment('状态[0:禁用, 1:启用]');
            $table->string('type', 60)->nullable()->comment('动作');
            $table->string('status', 60)->nullable()->comment('状态');
            $table->integer('wid', false, true)->default('0')->comment('工单ID');
            $table->timestamps();
            $table->softDeletes();
        });
        DB::statement("ALTER TABLE `qx` comment '权限配置'");
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
