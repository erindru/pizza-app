<?php

namespace Pizza\Models\Order;

class Order extends \Eloquent {

	public function size() {
		return $this->belongsTo("Pizza\Models\Pizza\PizzaSize", "pizza_size_id");
	}

	public function base() {
		return $this->belongsTo("Pizza\Models\Pizza\PizzaBase", "pizza_base_id");
	}

	public function toppings() {
		return $this->belongsToMany("Pizza\Models\Pizza\PizzaTopping", "orders_toppings", "pizza_topping_id", "order_id");
	}

}