<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAgendamentosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('agendamentos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_patient')->unsigned()->nullable();
            $table->integer('id_doctor')->unsigned()->nullable();
            $table->integer('secretaria_id')->unsigned()->nullable();
            $table->integer('id_enfermeiro')->unsigned()->nullable();
            $table->string('descricao');
            $table->string('legenda');
            $table->datetime('datahora');
            $table->timestamps();

            
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
        Schema::dropIfExists('agendamentos');
    }
}