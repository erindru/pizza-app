<?php

class OrderControllerTest extends TestCase {

	public function setUp() {
		parent::setUp();

		$this->mockOrderRepository();
	}

	public function tearDown() {
		\Mockery::close();
	}

	public function testAddOrder() {
		$test_order = '{"pizzas":[{"size":{"id":2,"name":"Medium","price":"2.90"},"base":{"id":2,"name":"Italian","price":"1.70"},"toppings":[{"id":1,"name":"Cheese","price":"1.40"}]}],"customer_name":"Test Customer","customer_address":"Test Address"}';

		$this->repo->shouldReceive("addOrder")->once();
		$response = $this->call("POST", "/orders", array(), array(), array(), $test_order);
	}

	private function mockOrderRepository() {
		$class = "Pizza\Models\Repositories\OrderRepository";
		$this->repo = \Mockery::mock($class);
		App::instance($class, $this->repo);
	}

}