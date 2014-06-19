<?php

use Pizza\Models\Pizza\PizzaSize;
use Pizza\Models\Pizza\PizzaBase;
use Pizza\Models\Pizza\PizzaTopping;

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run() {
		$this->seedSizes();
		$this->seedBases();
		$this->seedToppings();
	}

	private function seedSizes() {
		DB::table("pizza_sizes")->delete();

		$size1 = array(
			"name" => "Small",
			"price" => 2.10
		);

		$size2 = array(
			"name" => "Medium",
			"price" => 2.90
		);

		$size3 = array(
			"name" => "Large",
			"price" => 3.10
		);

		$size4 = array(
			"name" => "Extra Large",
			"price" => 3.90
		);

		PizzaSize::create($size1);
		PizzaSize::create($size2);
		PizzaSize::create($size3);
		PizzaSize::create($size4);
	}

	private function seedBases() {
		DB::table("pizza_bases")->delete();

		$base1 = array(
			"name" => "Cheesy Crust",
			"price" => 1.30
		);

		$base2 = array(
			"name" => "Italian",
			"price" => 1.70
		);

		$base3 = array(
			"name" => "Deep Pan",
			"price" => 1.20
		);

		$base4 = array(
			"name" => "Stuffed Crust",
			"price" => 1.90
		);

		$base5 = array(
			"name" => "Thin",
			"price" => 2.50
		);

		PizzaBase::create($base1);
		PizzaBase::create($base2);
		PizzaBase::create($base3);
		PizzaBase::create($base4);
		PizzaBase::create($base5);
	}

	private function seedToppings() {
		DB::table("pizza_toppings")->delete();

		$topping1 = array(
			"name" => "Cheese",
			"price" => 1.40
		);

		$topping2 = array(
			"name" => "Salami",
			"price" => 1.90
		);

		$topping3 = array(
			"name" => "Ham",
			"price" => 1.70
		);

		$topping4 = array(
			"name" => "Pineapple",
			"price" => 1.65
		);

		$topping5 = array(
			"name" => "Bacon",
			"price" => 1.20
		);

		$topping6 = array(
			"name" => "Capsicum",
			"price" => 1.10
		);

		PizzaTopping::create($topping1);
		PizzaTopping::create($topping2);
		PizzaTopping::create($topping3);
		PizzaTopping::create($topping4);
		PizzaTopping::create($topping5);
		PizzaTopping::create($topping6);
	}

}
