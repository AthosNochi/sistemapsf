<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateEnfermeirosTable.
 */
class CreateEnfermeirosTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('enfermeiros', function(Blueprint $table) {
			$table->increments('id')->unsigned()->nullable();

			$table->string('name');
			$table->string('cpf', 11)->unique()->nullable();
			$table->char('phone', 11);
 
			 //Auth data
			$table->string('email', 80)->unique();
			$table->string('password', 254)->nullable();
			$table->string('tipo');
			
			 //Auth data
  
			  //Permission
			 //---//
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
		Schema::table('enfermeiros', function (Blueprint $table) {
		});
		Schema::drop('enfermeiros');
	}
}
