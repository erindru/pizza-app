<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Initial extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create("orders", function($table) {
			$table->increments("id");
		});

	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {

	}

}

