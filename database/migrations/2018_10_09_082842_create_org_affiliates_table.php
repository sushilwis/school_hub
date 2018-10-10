<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrgAffiliatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('org_affiliates', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('org_id');
            $table->string('affi_name',255);
            $table->string('affi_img',255);
            $table->string('affi_type',20);
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
        Schema::dropIfExists('org_affiliates');
    }
}
