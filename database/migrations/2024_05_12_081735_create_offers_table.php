<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateOffersTable extends Migration {

	public function up()
	{
		Schema::create('offers', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->integer('restaurant_id')->unsigned();
			$table->string('name');
			$table->longText('description');
			$table->string('image');
			$table->datetime('start_from')->nullable();
			$table->datetime('end_to');
		});
	}

	public function down()
	{
		Schema::drop('offers');
	}
}