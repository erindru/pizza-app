<?php

namespace Pizza\Models\Order;

class Order extends \Eloquent {

	protected $appends = array("price");

	public function pizzas() {
		return $this->hasMany("Pizza\Models\Order\Pizza");
	}

	public function getDates() {
		return array("created_at", "updated_at", "delivered_on");
	}

	public function getPriceAttribute() {
		$total = 0;
		$this->pizzas->each(function($pizza) use (&$total) {
			$total += $pizza->price;
		});
		return number_format($total, 2);
	}

}