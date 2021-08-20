<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSectionsTable extends Migration {

	public function up()
	{
		Schema::create('sections', function(Blueprint $table) {
			$table->id();
			$table->timestamps();
			$table->string('Name_Section');
			$table->integer('Status');
			$table->bigInteger('Grade_id')->unsigned();
			$table->bigInteger('Class_id')->unsigned();
		});
	}

	public function down()
	{
		Schema::drop('sections');
	}
}
