<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateNotificationsTable extends Migration {

	public function up()
	{
		Schema::create('notifications', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->string('title');
			$table->longText('content');
			$table->integer('client_id')->unsigned();
			$table->integer('order_id')->unsigned();
			$table->integer('restaurant_id')->unsigned();
		});
	}

	public function down()
	{
		Schema::drop('notifications');
	}
}