<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('id_number')->nullable();
            $table->bigInteger('campusid')->nullable();
            $table->string('campus')->nullable();
            $table->string('name')->nullable();
            $table->string('class_status')->nullable();
            $table->string('password')->nullable();
            $table->string('course')->nullable();
            $table->string('evaluator_rank')->nullable();
            $table->string('academic_rank')->nullable();
            $table->string('school_year')->nullable();
            $table->string('section')->nullable();
            $table->string('status')->nullable();
            $table->string('year')->nullable();
            $table->string('semester')->nullable();
            $table->string('sy')->nullable();
            $table->longText('signature')->nullable();
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
        Schema::dropIfExists('students');
    }
};
