<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWordsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('words', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('user_id')->nullable();
			$table->integer('region_id')->nullable();;
			$table->string('word')->nullable();;
			$table->string('word_an')->nullable();
			$table->string('word_fonetic')->nullable();
			$table->string('dialect')->nullable();
			$table->text('description')->nullable();
			$table->nullableTimestamps();;
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::drop('words');
	}

}
