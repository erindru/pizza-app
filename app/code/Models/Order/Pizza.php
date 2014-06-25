<?php

namespace Pizza\Models\Order;

class Pizza extends \Eloquent {

	protected $table = "orders_pizzas";

	protected $fillable = array("pizza_size_id", "pizza_base_id");

	protected $appends = array("price");

	public $timestamps = false;

	public function order() {
		return $this->belongsTo("Pizza\Models\Order\Order");
	}

	public function size() {
		return $this->belongsTo("Pizza\Models\Pizza\PizzaSize", "pizza_size_id");
	}

	public function base() {
		return $this->belongsTo("Pizza\Models\Pizza\PizzaBase", "pizza_base_id");
	}

	public function toppings() {
		return $this->belongsToMany("Pizza\Models\Pizza\PizzaTopping", "orders_pizzas_toppings", "pizza_id", "pizza_topping_id");
	}

	public function getPriceAttribute() {
		$price = $this->size->price + $this->base->price;
		$this->toppings->each(function($topping) use (&$price) {
			$price += $topping->price;
		});
		return number_format($price, 2);
	}

}