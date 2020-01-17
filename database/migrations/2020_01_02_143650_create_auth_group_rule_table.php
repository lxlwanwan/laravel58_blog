<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAuthGroupRuleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('auth_group_rule', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name',30)->comment('控制器名称');
            $table->string('controller',60)->comment('控制器');
            $table->tinyInteger('type')->default(1)->comment('类型');
            $table->string('icon',15)->nullable()->comment('图标');
            $table->integer('order')->default(1)->comment('排序');
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
        Schema::dropIfExists('auth_group_rule');
    }
}
