<?php

namespace Pizza\Controllers;

use Pizza\Models\Repositories\PizzaRepository;

class PizzaController extends BaseController {

	private $pizzas;

	public function __construct(PizzaRepository $pizzas) {
		$this->pizzas = $pizzas;
	}

	public function getSizes() {
		return \Response::json($this->pizzas->getAvailableSizes());
	}

	public function getBases() {
		return \Response::json($this->pizzas->getAvailableBases());
	}

	public function getToppings() {
		return \Response::json($this->pizzas->getAvailableToppings());
	}

}