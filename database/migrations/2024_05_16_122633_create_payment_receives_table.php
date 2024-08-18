<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePaymentReceivesTable extends Migration {

	public function up()
	{
		Schema::create('payment_receives', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->integer('restaurant_id')->unsigned();
			$table->string('amount');
		});
	}

	public function down()
	{
		Schema::drop('payment_receives');
	}
}