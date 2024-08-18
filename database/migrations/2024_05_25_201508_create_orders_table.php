<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateOrdersTable extends Migration {

	public function up()
	{
		Schema::create('orders', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->integer('client_id')->unsigned();
			$table->longText('notes')->nullable();
			$table->decimal('total_price')->default(0);
			$table->enum('status', array('pending', 'preparation', 'delivery', 'reject', 'accept'));
			$table->integer('restaurant_id')->unsigned();
			$table->decimal('delivery_charge')->default(0);
			$table->decimal('commission')->default(0);
		});
	}

	public function down()
	{
		Schema::drop('orders');
	}
}
