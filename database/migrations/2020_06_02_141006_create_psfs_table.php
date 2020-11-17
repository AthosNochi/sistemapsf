<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;
/**
 * Class CreatePsfsTable.
 */
class CreatePsfsTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('psfs', function(Blueprint $table) {
            $table->increments('id');
			$table->string('name', 50);
			$table->string('endereco', 80);
			$table->char('phone', 11);
			$table->string('regiao', 50);
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
		Schema::drop('psfs');
	}
}
