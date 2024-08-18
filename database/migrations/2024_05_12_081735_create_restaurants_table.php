<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateRestaurantsTable extends Migration {

	public function up()
	{
		Schema::create('restaurants', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->integer('category_id')->unsigned();
			$table->decimal('minimum_order');
			$table->decimal('delivery_charge')->nullable();
			$table->string('phone');
			$table->string('whats_app');
			$table->string('image');
			$table->integer('region_id')->unsigned();
			$table->string('name');
			$table->string('email');
			$table->string('password');
			$table->string('phone_owner');
            $table->string('pin_code')->nullable();
            $table->enum('is_active',['active','not_active'])->default('not_active');
		});
	}

	public function down()
	{
		Schema::drop('restaurants');
	}
}
