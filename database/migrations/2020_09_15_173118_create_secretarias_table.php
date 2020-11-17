<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateSecretariasTable.
 */
class CreateSecretariasTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('secretarias', function(Blueprint $table) {
			$table->increments('id')->unsigned()->nullable();

			$table->string('name');
		   	$table->string('cpf', 11)->unique()->nullable();
		   
			$table->string('rg', 11)->unique()->nullable();
			$table->string('phone', 11)->unique()->nullable();

            //Auth data
           	$table->string('email', 80)->unique();
		   	$table->string('password', 254)->nullable();
		   	$table->string('tipo');
			
			$table->rememberToken();
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
		Schema::drop('secretarias');
	}
}
