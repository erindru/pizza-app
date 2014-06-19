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

		Schema::create("pizza_sizes", function($table) {
			$table->increments("id");
			$table->string("name");
			$table->decimal("price", 5, 2);
		});

		Schema::create("pizza_bases", function($table) {
			$table->increments("id");
			$table->string("name");
			$table->decimal("price", 5, 2);
		});

		Schema::create("pizza_toppings", function($table) {
			$table->increments("id");
			$table->string("name");
			$table->decimal("price", 5, 2);
		});

		Schema::create("orders", function($table) {
			$table->increments("id");
			$table->timestamps();

			$table->integer("pizza_size_id")->unsigned()->nullable();
			$table->integer("pizza_base_id")->unsigned()->nullable();

			$table->foreign("pizza_size_id")->references("id")->on("pizza_sizes")->onDelete("cascade");
			$table->foreign("pizza_base_id")->references("id")->on("pizza_bases")->onDelete("cascade");
		});

		Schema::create("orders_toppings", function($table) {
			$table->increments("id");

			$table->integer("order_id")->unsigned();
			$table->integer("pizza_topping_id")->unsigned();

			$table->foreign("pizza_topping_id")->references("id")->on("pizza_toppings")->onDelete("cascade");
		});

	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::dropIfExists("orders_toppings");
		Schema::dropIfExists("orders");
		Schema::dropIfExists("pizza_toppings");
		Schema::dropIfExists("pizza_bases");
		Schema::dropIfExists("pizza_sizes");
	}

}

