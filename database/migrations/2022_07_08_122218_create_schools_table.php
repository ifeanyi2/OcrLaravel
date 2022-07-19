<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSchoolsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('schools', function (Blueprint $table) {
            $table->id();
            $table->integer('global_id')->default(null)->nullable();
            $table->string('name');
            $table->string('address');
            $table->string('tag')->default('CATHOLIC');
            $table->integer('lga_id')->nullable();
            $table->integer('region_id')->nullable();
            $table->string('motto')->nullable();
            $table->string('logo')->nullable();
            $table->string('prefix')->nullable();
            $table->string('head')->nullable();
            $table->string('headSignature')->nullable();
            $table->string('website')->nullable();
            $table->string('themeColor')->nullable();
            $table->integer('academic_session_id')->nullable();
            $table->integer('current_term_id')->nullable();
            $table->integer('status')->nullable();
            $table->enum('syn_status', ['0', '1', '2'])->default('0');
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
        Schema::dropIfExists('schools');
    }
}
