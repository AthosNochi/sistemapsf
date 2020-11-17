<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreatePatientsTable.
 */
class CreatePatientsTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('patients', function(Blueprint $table) {
			$table->increments('id')->unsigned()->nullable();
			

			 //People data
			$table->char('gender', 11);
			$table->string('notes', 50);
			$table->string('birth', 11);
			$table->string('sus', 50);
			$table->string('address', 80);
			$table->string('name');
		   	$table->string('cpf', 11)->unique()->nullable();
		   	$table->string('rg', 50)->unique()->nullable();
           	$table->char('phone', 11);

            //Auth data
           	$table->string('email', 80)->unique();
			$table->string('password', 254)->nullable();
			$table->string('tipo')->nullable();

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
		Schema::table('patients', function (Blueprint $table) {
		});
		Schema::drop('patients');
	}
}
