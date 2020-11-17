<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Tipo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('tipo')->nullable();
            $table->integer('id_patient')->unsigned()->nullable();
            $table->integer('id_doctor')->unsigned()->nullable();
            $table->integer('secretaria_id')->unsigned()->nullable();
            $table->integer('id_enfermeiro')->unsigned()->nullable();
            $table->foreign('id_patient')->references('id')->on('patients');
            $table->foreign('id_doctor')->references('id')->on('doctors');
            $table->foreign('secretaria_id')->references('id')->on('secretarias');
            $table->foreign('id_enfermeiro')->references('id')->on('enfermeiros');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('tipo');
        });
    }
}
