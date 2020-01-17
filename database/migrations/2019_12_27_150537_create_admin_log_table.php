<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdminLogTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admin_log', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name',20);
            $table->tinyInteger('type')->default(1);
            $table->text('content')->nullable();
            $table->string('ip',20)->default(0);
            $table->string('time',10);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('admin_log');
    }
}
