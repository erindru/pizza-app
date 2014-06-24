<?php

use Pizza\Models\Repositories\OrderRepository;

class OrderRepositoryTest extends TestCase {

	public function setUp() {
		parent::setUp();

		Artisan::call("migrate");
		$this->seed();

		$this->repo = new OrderRepository();
	}

	public function testAddOrder() {
		$order = json_decode('{"pizzas":[{"size":{"id":2,"name":"Medium","price":"2.90"},"base":{"id":2,"name":"Italian","price":"1.70"},"toppings":[{"id":1,"name":"Cheese","price":"1.40"}]}],"customer_name":"Test Customer","customer_address":"Test Address"}', true);

		$order = $this->repo->addOrder($order);

		$this->assertCount(1, $order->pizzas);

		$pizza = $order->pizzas->first();
		$this->assertEquals("Medium", $pizza->size->name);
		$this->assertEquals(2.90, $pizza->size->price);

		$this->assertEquals("Italian", $pizza->base->name);
		$this->assertEquals(1.70, $pizza->base->price);

		$this->assertCount(1, $pizza->toppings);

		$topping = $order->pizzas->first()->toppings->first();
		$this->assertEquals("Cheese", $topping->name);
		$this->assertEquals(1.40, $topping->price);

		$this->assertEquals("Test Customer", $order->customer_name);
		$this->assertEquals("Test Address", $order->customer_address);

		$order = $this->repo->getOrder($order->id);
		$this->assertEquals("Test Customer", $order->customer_name);
		$this->assertEquals("Test Address", $order->customer_address);
	}

}