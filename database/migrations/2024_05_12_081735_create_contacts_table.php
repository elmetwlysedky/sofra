<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateContactsTable extends Migration {

	public function up()
	{
		Schema::create('contacts', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->string('name');
			$table->string('email');
			$table->string('title');
			$table->longText('message');
			$table->enum('type', array('suggestion', 'complaint', 'Enquiry'));
		});
	}

	public function down()
	{
		Schema::drop('contacts');
	}
}