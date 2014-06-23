<?php

use Pizza\Models\Order\Order;
use Pizza\Models\Order\Pizza;

/**
 * @group database
 */
class OrderTest extends TestCase {

	public function setUp() {
		parent::setUp();

		Artisan::call("migrate");
		$this->seed();
	}

	public function testPizzasRelation() {
		$order = Order::create(array());

		$pizza = new Pizza(array("pizza_size_id" => 1, "pizza_base_id" => 1));
		$pizza->order()->associate($order);
		$pizza->save();

		$order->pizzas()->save($pizza);
		$order->save();

		$this->assertCount(1, $order->pizzas);
	}

}

