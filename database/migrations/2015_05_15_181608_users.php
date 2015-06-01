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
			$table->string('firstname')->nullable();
			$table->string('lastname')->nullable();
			$table->string('birth')->nullable();
			$table->string('adress')->nullable();
			$table->string('education')->nullable();
			$table->string('job')->nullable();
			$table->string('password')->nullable();
			$table->string('active')->nullable();
			$table->string('role')->nullable();
			$table->string('email')->nullable()->unique();
			$table->string('remember_token')->nullable();
			$table->nullableTimestamps();
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
