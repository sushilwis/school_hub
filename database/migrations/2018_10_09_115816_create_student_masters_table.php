<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentMastersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_masters', function (Blueprint $table) {
            $table->increments('id');
            $table->string('user_name',255);
            $table->integer('org_id');
            $table->string('f_name',50);
            $table->string('l_name',50);
            $table->string('name',255);
            $table->text('address');
            $table->integer('std_city');
            $table->integer('std_state');
            $table->integer('std_country');
            $table->integer('std_postal_code');
            $table->timestamps();
            $table->tinyInteger('id_deleted')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('student_masters');
    }
}
