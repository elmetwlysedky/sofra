<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateOrderProductsTable extends Migration {

	public function up()
	{
		Schema::create('order_products', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->integer('order_id')->unsigned();
			$table->integer('product_id')->unsigned();
			$table->decimal('price');
			$table->integer('quantity')->default('1');
			$table->string('special')->nullable();
		});
	}

	public function down()
	{
		Schema::drop('order_products');
	}
}