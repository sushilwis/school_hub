<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNoticeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notice', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('notice_type_id');
            $table->string('title', 100);
            $table->string('subject', 100);
            $table->text('text');
            $table->text('file_url');
            $table->tinyInteger('status');
            $table->integer('user_master_id');
            $table->integer('org_master_id');
            $table->integer('user_type_id');
            $table->integer('dept_id');
            $table->integer('create_by');
            $table->tinyInteger('is_Parent');
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
        Schema::dropIfExists('notice');
    }
}
