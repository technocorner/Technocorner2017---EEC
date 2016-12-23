<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExamsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('exams', function(Blueprint $t) {
			$t->increments('id');
			$t->integer('session');

			$t->integer('participant_id');
			$t->integer('qpackage_id');
			$t->dateTime('start_time')->nullable();
			$t->dateTime('end_time')->nullable();
			$t->integer('score')->nullable();

			$t->integer('score_true')->nullable();
			$t->integer('score_null')->nullable();
			$t->integer('score_false')->nullable();
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('exams');
	}

}
