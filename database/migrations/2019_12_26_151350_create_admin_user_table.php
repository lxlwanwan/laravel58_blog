<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdminUserTable extends Migration
{
    /**
     * Run the migrations.
     *php artisan make:migration create_users_table --create=admin_user
     * @return void
     */
    public function up()
    {
        Schema::create('admin_user', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name',30);
            $table->string('email',50)->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password',255);
            $table->string('last_ip',20);
            $table->tinyInteger('rule_id')->default(0)->comment('角色id');
            $table->tinyInteger('state')->default(0);
            $table->rememberToken();
            $table->string('create_time',10);
            $table->string('update_time',10)->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('admin_user');
    }
}
