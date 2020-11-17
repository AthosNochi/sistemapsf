<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateAnamnesesTable.
 */
class CreateAnamnesesTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('anamneses', function(Blueprint $table) {
			$table->increments('id')->nullable();
			$table->string('name', 50)->nullable();
			$table->string('gender', 50)->nullable();
			$table->char('age', 50)->nullable();
			$table->string('corEtnia', 50)->nullable();
			$table->string('estadoCivil', 50)->nullable();
			$table->string('profissao', 50)->nullable();
			$table->string('naturalidade', 50)->nullable();
			$table->string('address', 50)->nullable();
			$table->string('nomeMae', 50)->nullable();
			$table->string('religiao', 50)->nullable();
			$table->string('alergias', 50)->nullable();
			$table->string('queixaPrincipal', 100)->nullable();
			$table->string('historicoDoenca', 200)->nullable();
			$table->string('sintomas', 100)->nullable();
			$table->integer('id_patient')->unsigned()->nullable();
			$table->integer('secretaria_id')->nullable()->unsigned();
			$table->integer('doctor_id')->nullable()->unsigned();
			$table->integer('enfermeiro_id')->nullable()->unsigned();

			
			$table->foreign('id_patient')->references('id')->on('patients');
			$table->foreign('secretaria_id')->references('id')->on('secretarias');
			$table->foreign('doctor_id')->references('id')->on('doctors');
			$table->foreign('enfermeiro_id')->references('id')->on('enfermeiros');
            
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
		Schema::drop('anamneses');
	}
}
