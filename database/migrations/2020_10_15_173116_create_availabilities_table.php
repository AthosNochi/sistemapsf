<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateAvailabilitiesTable.
 */
class CreateAvailabilitiesTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('availabilities', function(Blueprint $table) {
			$table->id();
			$table->bigInteger('id_medico');
			$table->string('consulta');
			$table->string('disponibilidade');
			$table->string('adicoes');
			$table->string('exclusoes');
            $table->timestamps();
			$table->softDeletes();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('availabilities');
	}
}
