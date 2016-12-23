<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQpackageTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
    /**
     * Question package
     */
		Schema::create('qpackages', function(Blueprint $t)
		{
			$t->increments('id');
			$t->integer('exam_id');

      $t->timestamps();
		});

    Schema::create('qsortables', function(Blueprint $t)
			{
				$t->increments('id');
				$t->integer('qpackage_id');
				$t->integer('qtype_id');
	      $t->integer('index');
				$t->string('question_id');

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
		Schema::dropIfExists('qpackages');
		Schema::dropIfExists('qsortables');
	}

}
