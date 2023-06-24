<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFormsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('forms', function (Blueprint $table) {
            $table->id();
            $table->string('student_name');
            $table->string('course');
            $table->string('grade');
            $table->string('school_name')->nullable();
            $table->string('gender');
            $table->string('birthday');
            $table->string('nationality');
            $table->string('mobile_number');
            $table->string('photo');
            $table->string('certificate_photo')->nullable();
            $table->string('father_name');
            $table->string('father_number');
            $table->string('query');
            $table->boolean('seen')->default('1');
            $table->boolean('past_data')->default('0');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('forms');
    }
}
