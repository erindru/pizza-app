<?php

use Pizza\Models\Order\Order;
use Pizza\Models\Pizza\PizzaSize;
use Pizza\Models\Pizza\PizzaBase;
use Pizza\Models\Pizza\PizzaTopping;

/**
 * @group database
 */
class OrderTest extends TestCase {

	public function setUp() {
		parent::setUp();

		Artisan::call("migrate");
		$this->seed();
	}

	public function testSizeRelation() {
		$size = PizzaSize::create(array("name" => "Size1", "price" => 1));

		$order = Order::create(array());
		$order->size()->associate($size);
		$order->save();

		$this->assertEquals("Size1", $order->size->name);
		$this->assertEquals($size->id, $order->pizza_size_id);
	}

	public function testBaseRelation() {
		$base = PizzaBase::create(array("name" => "Base1", "price" => 1));

		$order = Order::create(array());
		$order->base()->associate($base);
		$order->save();

		$this->assertEquals("Base1", $order->base->name);
		$this->assertEquals($base->id, $order->pizza_base_id);
	}

	public function testToppingsRelation() {
		$topping1 = PizzaTopping::create(array("name" => "Topping1", "price" => 1));
		$topping2 = PizzaTopping::create(array("name" => "Topping2", "price" => 1));
		$topping3 = PizzaTopping::create(array("name" => "Topping3", "price" => 1));

		$order = Order::create(array());
		$order->toppings()->attach($topping1);
		$order->toppings()->attach($topping3);
		$order->save();

		$this->assertEquals(2, $order->toppings->count());
		$this->assertEquals("Topping1", $order->toppings->first()->name);
		$this->assertEquals("Topping3", $order->toppings->last()->name);
	}

}

