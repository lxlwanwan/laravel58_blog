<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAuthRuleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('auth_rule', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name',20)->comment('名称');
            $table->string('method',40)->comment('方法');
            $table->tinyInteger('type')->default(1)->comment('类型');
            $table->integer('p_id')->default(0)->comment('分类');
            $table->tinyInteger('order')->default(1)->comment('排序');
            $table->tinyInteger('status')->default(1)->comment('1为显示，2为不显示');
            $table->tinyInteger('state')->default(0)->comment('0为正常，1为禁用');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('auth_rule');
    }
}
