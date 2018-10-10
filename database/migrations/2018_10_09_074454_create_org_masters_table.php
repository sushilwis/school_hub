<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrgMastersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('org_masters', function (Blueprint $table) {
            $table->increments('id');
            $table->string('org_reg');
            $table->string('org_name');
            $table->text('org_address');
            $table->integer('org_city');
            $table->integer('org_state');
            $table->integer('org_country');
            $table->string('landmark',255);
            $table->string('org_img',255);
            $table->text('org_text');
            $table->text('org_about');
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
        Schema::dropIfExists('org_masters');
    }
}
