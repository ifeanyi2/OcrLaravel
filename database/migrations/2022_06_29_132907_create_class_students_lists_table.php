<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClassStudentsListsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    

    public function up()
    {
        Schema::create('class_students_lists', function (Blueprint $table) {
            $table->id();
            $table->integer('global_id');
            $table->integer('academic_session_id');
            $table->enum('first_term', ['0', '1'])->default(null);
            $table->enum('second_term',['0', '1'])->default(null);
            $table->enum('third_term', ['0', '1'])->default(null);
            $table->integer('term_id')->default(null);
            $table->integer('school_id')->nullable();
            $table->integer('class_id')->nullable();
            $table->integer('student_id')->nullable();
            $table->enum('status', ['Active', 'Inactive'])->default(null);
            $table->enum('sync_status', ['0', '1', '2'])->default('0');
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
        Schema::dropIfExists('class_students_lists');
    }
}
