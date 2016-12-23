<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuestionsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('questions', function(Blueprint $t)
		{
			$t->increments('id');

			$t->string('qtype_id');
			$t->text('question');
			$t->string('image')->nullable();
			$t->text('chA');
			$t->text('chB');
			$t->text('chC');
			$t->text('chD');
			$t->text('chE');
			$t->boolean('randomize');
			$t->char('answer', 1);

			$t->timestamps();
		});

		Schema::create('qtypes', function(Blueprint $t)
		{
			$t->increments('id');
			$t->string('name');

			$t->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('questions');
		Schema::dropIfExists('qtypes');
	}

}
