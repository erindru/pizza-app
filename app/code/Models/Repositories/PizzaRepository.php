<?php

namespace Pizza\Models\Repositories;

use Pizza\Models\Pizza\PizzaSize;
use Pizza\Models\Pizza\PizzaBase;
use Pizza\Models\Pizza\PizzaTopping;

class PizzaRepository {

	public function getAvailableSizes() {
		return PizzaSize::all();
	}

	public function getAvailableBases() {
		return PizzaBase::all();
	}

	public function getAvailableToppings() {
		return PizzaTopping::all();
	}

}