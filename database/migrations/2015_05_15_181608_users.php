<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Users extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('users', function($table) {
			$table->increments('id');
			$table->string('firstname');
			$table->string('lastname');
			$table->string('birth');
			$table->string('adress');
			$table->string('education');
			$table->string('job');
			$table->string('password');
			$table->string('active');
			$table->string('role');
			$table->string('email')->unique();
			$table->string('remember_token');
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::drop('users');
	}

}
