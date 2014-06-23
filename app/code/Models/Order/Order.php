<?php

namespace Pizza\Models\Order;

class Order extends \Eloquent {

	public function pizzas() {
		return $this->hasMany("Pizza\Models\Order\Pizza");
	}

	public function getDates() {
		return array("created_at", "updated_at", "delivered_on");
	}

}