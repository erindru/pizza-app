<?php

use Pizza\Models\Order\Pizza;
use Pizza\Models\Pizza\PizzaBase;
use Pizza\Models\Pizza\PizzaSize;
use Pizza\Models\Pizza\PizzaTopping;

/**
 * @group database
 */
class PizzaTest extends TestCase {

	public function setUp() {
		parent::setUp();

		Artisan::call("migrate");
		$this->seed();
	}

	public function testSizeRelation() {
		$size = PizzaSize::create(array("name" => "Size1", "price" => 1));

		$pizza = new Pizza();
		$pizza->order_id = 1;
		$pizza->size()->associate($size);
		$pizza->save();

		$this->assertEquals("Size1", $pizza->size->name);
		$this->assertEquals($size->id, $pizza->pizza_size_id);
	}

	public function testBaseRelation() {
		$base = PizzaBase::create(array("name" => "Base1", "price" => 1));

		$pizza = new Pizza();
		$pizza->order_id = 1;
		$pizza->base()->associate($base);
		$pizza->save();

		$this->assertEquals("Base1", $pizza->base->name);
		$this->assertEquals($base->id, $pizza->pizza_base_id);
	}

	public function testToppingsRelation() {
		$topping1 = PizzaTopping::create(array("name" => "Topping1", "price" => 1));
		$topping2 = PizzaTopping::create(array("name" => "Topping2", "price" => 1));
		$topping3 = PizzaTopping::create(array("name" => "Topping3", "price" => 1));

		$this->assertGreaterThan(0, $topping1->id);

		$pizza = new Pizza();
		$pizza->order_id = 1;
		$pizza->save();

		$pizza->toppings()->attach($topping1);
		$pizza->toppings()->attach($topping3);
		$pizza->save();

		$this->assertEquals(2, $pizza->toppings->count());
		$this->assertEquals("Topping1", $pizza->toppings->first()->name);
		$this->assertEquals("Topping3", $pizza->toppings->last()->name);
	}

}
