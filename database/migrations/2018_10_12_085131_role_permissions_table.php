<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RolePermissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('role_permissions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('role_id');
            $table->integer('module_id');
            $table->integer('user_type_id');
            $table->integer('master_id');
            $table->tinyInteger('add')->default('0');
            $table->tinyInteger('edit')->default('0');
            $table->tinyInteger('delete')->default('0');
            $table->tinyInteger('view')->default('0');
            $table->tinyInteger('is_all')->default('0');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('role_permissions');
    }
}
