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
			$table->integer('user_id');
			$table->integer('region_id');
			$table->string('word');
			$table->string('word_an');
			$table->string('word_fonetic');
			$table->string('dialect');
			$table->text('description');
			$table->timestamps();
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
