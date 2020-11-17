<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;


/**
 * Class CreateUsersTable.
 */
class CreateUsersTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users', function (Blueprint $table){
		   $table->increments('id')->unsigned()->nullable();
		   

            //People data
		   $table->string('name');
		   $table->string('cpf', 11)->unique()->nullable();
		   $table->string('rg', 50)->unique()->nullable();
           

            //Auth data
           $table->string('email', 80)->unique();
		   $table->string('password', 254)->nullable();

            //Permission
		   $table->boolean('isAdm')->nullable();
		   $table->bigInteger('adminId')->nullable();
		   

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
		Schema::table('users', function (Blueprint $table) {

		});
		Schema::drop('users');


	}
}
