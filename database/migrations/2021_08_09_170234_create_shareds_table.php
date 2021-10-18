<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
class CreateSharedsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shareds', function (Blueprint $table) {
            $table->id();
            $table->integer('qx_id')->comment('权限id');
            $table->json('value')->nullable()->comment('值');
            $table->tinyInteger('state')->default('0')->comment('状态[0:禁用, 1:启用]');
            $table->timestamps();
            $table->softDeletes();
        });
        DB::statement("ALTER TABLE `shareds` comment '共享文件'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('shareds');
    }
}
