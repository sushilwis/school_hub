<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ParentMastersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('parent_masters', function (Blueprint $table) {
            $table->increments('id');
            $table->string('f_name',50);
            $table->string('l_name',50);
            $table->string('name',150);
            $table->string('mobile_no',50);
            $table->text('address');
            $table->integer('p_city');
            $table->integer('p_state');
            $table->integer('p_country');
            $table->integer('p_postal_code');

            $table->timestamps();
            $table->tinyInteger('is_deleted')->default('0');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('parent_masters');
    }
}
