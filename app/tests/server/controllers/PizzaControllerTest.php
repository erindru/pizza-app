<?php

use Illuminate\Support\Collection;

use Pizza\Models\Pizza\PizzaSize;
use Pizza\Models\Pizza\PizzaBase;
use Pizza\Models\Pizza\PizzaTopping;

class PizzaControllerTest extends TestCase {

	private $mock;

	public function setUp() {
		parent::setUp();

		$this->mockPizzaRepository();
	}

	public function tearDown() {
		parent::tearDown();

		\Mockery::close();
	}

	public function testGetSizes() {
		$this->mock->shouldReceive("getAvailableSizes")->once()->andReturn($this->getTestSizes());
		$response = $this->call("GET", "/pizza/sizes");

		$data = $response->getData();
		$this->assertContentType("application/json");
		$this->assertCount(3, $data);
		$this->assertEquals("Size1", $data[0]->name);
		$this->assertEquals(3, $data[2]->price);
	}

	public function testGetBases() {
		$this->mock->shouldReceive("getAvailableBases")->once()->andReturn($this->getTestBases());
		$response = $this->call("GET", "/pizza/bases");

		$data = $response->getData();
		$this->assertContentType("application/json");
		$this->assertCount(3, $data);
		$this->assertEquals("Base1", $data[0]->name);
		$this->assertEquals(3, $data[2]->price);
	}

	public function testGetToppings() {
		$this->mock->shouldReceive("getAvailableToppings")->once()->andReturn($this->getTestToppings());
		$response = $this->call("GET", "/pizza/toppings");

		$data = $response->getData();
		$this->assertContentType("application/json");
		$this->assertCount(3, $data);
		$this->assertEquals("Topping1", $data[0]->name);
		$this->assertEquals(3, $data[2]->price);
	}

	/* Helpers */

	private function assertContentType($type) {
		$response = $this->client->getResponse();
		$this->assertEquals($type, $response->headers->get("Content-Type"));
	}

	private function mockPizzaRepository() {
		$pizzarepo = "Pizza\Models\Repositories\PizzaRepository";
		$this->mock = Mockery::mock($pizzarepo);
		App::instance($pizzarepo, $this->mock);
	}

	private function getTestSizes() {
		$ret = new Collection();

		$ret->push(new PizzaSize(array(
			"name" => "Size1",
			"price" => 1
		)));

		$ret->push(new PizzaSize(array(
			"name" => "Size2",
			"price" => 2
		)));

		$ret->push(new PizzaSize(array(
			"name" => "Size3",
			"price" => 3
		)));

		return $ret;
	}

	private function getTestBases() {
		$ret = new Collection();

		$ret->push(new PizzaBase(array(
			"name" => "Base1",
			"price" => 1
		)));

		$ret->push(new PizzaBase(array(
			"name" => "Base2",
			"price" => 2
		)));

		$ret->push(new PizzaBase(array(
			"name" => "Base3",
			"price" => 3
		)));

		return $ret;
	}

	private function getTestToppings() {
		$ret = new Collection();

		$ret->push(new PizzaTopping(array(
			"name" => "Topping1",
			"price" => 1
		)));

		$ret->push(new PizzaTopping(array(
			"name" => "Topping2",
			"price" => 2
		)));

		$ret->push(new PizzaTopping(array(
			"name" => "Topping3",
			"price" => 3
		)));

		return $ret;
	}

}
