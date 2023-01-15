<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('subject_list', function (Blueprint $table) {
            $table->id();
            $table->string('subject')->nullable();
            $table->string('department')->nullable();
            $table->string('semester')->nullable();
            $table->string('year')->nullable();
            $table->string('sy')->nullable();
            $table->timestamps();
        });

        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('username')->unique()->nullable();
            $table->string('password')->nullable();
            $table->string('campus')->unique()->nullable();
            $table->string('academic_rank')->nullable();
            $table->string('year')->nullable();
            $table->string('self')->nullable();
            $table->string('sy')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });

        Schema::create('evaluator', function (Blueprint $table) {
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
            $table->rememberToken();
            $table->timestamps();
        });


        Schema::create('faculty', function (Blueprint $table) {
            $table->id();
            $table->string('id_number')->unique()->nullable();
            $table->bigInteger('campusid')->nullable();
            $table->string('password')->nullable();
            $table->string('campus')->nullable();
            $table->string('photos')->nullable();
            $table->string('name')->nullable();
            $table->string('department')->nullable();
            $table->string('academic_rank')->nullable();
            $table->string('status')->nullable();
            $table->string('year')->nullable();
            $table->string('semester')->nullable();
            $table->string('sy')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });

        Schema::create('faculty_subject_loading', function (Blueprint $table) {
            $table->id();
            $table->string('id_number')->nullable();
            $table->bigInteger('campusid')->nullable();
            $table->string('subject')->nullable();
            $table->string('campus')->nullable();
            $table->string('semester')->nullable();
            $table->string('school_year')->nullable();
            $table->string('department')->nullable();
            $table->string('section')->nullable();
            $table->string('year')->nullable();
            $table->string('program')->nullable();
            $table->string('sy')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });

      

        Schema::create('student_subject_loading', function (Blueprint $table) {
            $table->id();
            $table->string('id_number')->nullable();
            $table->string('evaluator_id')->nullable();
            $table->bigInteger('campusid')->nullable();
            $table->string('subject')->nullable();
            $table->string('campus')->nullable();
            $table->string('semester')->nullable();
            $table->string('school_year')->nullable();
            $table->string('comment')->nullable();
            $table->string('type')->nullable();
            $table->string('faculty_name')->nullable();
            $table->string('academic_rank')->nullable();
            $table->string('section')->nullable();
            $table->string('year')->nullable();
            $table->string('program')->nullable();
            $table->string('program2')->nullable();
            $table->string('sy')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });

        Schema::create('questionaire', function (Blueprint $table) {
            $table->id();
            $table->string('q1')->nullable();
            $table->string('q2')->nullable();
            $table->string('q3')->nullable();
            $table->string('q4')->nullable();
            $table->string('q5')->nullable();
            $table->string('q6')->nullable();
            $table->string('q7')->nullable();
            $table->string('q8')->nullable();
            $table->string('q9')->nullable();
            $table->string('q10')->nullable();
            $table->string('q11')->nullable();
            $table->string('q12')->nullable();
            $table->string('q13')->nullable();
            $table->string('q14')->nullable();
            $table->string('q15')->nullable();
            $table->string('q16')->nullable();
            $table->string('q17')->nullable();
            $table->string('q18')->nullable();
            $table->string('q19')->nullable();
            $table->string('q20')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });

        Schema::create('schedule', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('campusid')->nullable();
            $table->string('campus')->nullable();
            $table->string('start')->nullable();
            $table->string('end')->nullable();
            $table->string('semester')->nullable();
            $table->string('status')->nullable();
            $table->string('sy')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });

         Schema::create('results', function (Blueprint $table) {
            $table->id();
            $table->string('evaluatee_id')->nullable();
            $table->string('evaluator_id')->nullable();
            $table->string('commitment')->nullable();
            $table->bigInteger('campusid')->nullable();
            $table->string('campus')->nullable();
            $table->string('name')->nullable();
            $table->string('kos')->nullable();
            $table->string('til')->nullable();
            $table->string('mol')->nullable();
            $table->string('total')->nullable();
            $table->string('a')->nullable();
            $table->string('b')->nullable();
            $table->string('c')->nullable();
            $table->string('d')->nullable();
            $table->string('e')->nullable();
            $table->string('ccs')->nullable();
            $table->string('cte')->nullable();
            $table->string('cbm')->nullable();
            $table->string('caf')->nullable();
            $table->string('ccje')->nullable();
            $table->longText('comment')->nullable();
            $table->string('school_year')->nullable();
            $table->string('section')->nullable();
            $table->string('semester')->nullable();
            $table->string('department')->nullable();
            $table->string('academic_rank')->nullable();
            $table->string('status')->nullable();
            $table->string('year')->nullable();
            $table->string('sy')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
