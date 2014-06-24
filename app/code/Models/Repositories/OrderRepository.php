<?php

namespace Pizza\Models\Repositories;

use Pizza\Models\Order\Order;
use Pizza\Models\Order\Pizza;
use Pizza\Models\Pizza\PizzaSize;
use Pizza\Models\Pizza\PizzaBase;
use Pizza\Models\Pizza\PizzaTopping;

class OrderRepository {

	public function getOrder($id) {
		return Order::find($id);
	}

	public function addOrder(array $data) {
		$order = new Order();
		$order->customer_name = $data["customer_name"];
		$order->customer_address = $data["customer_address"];
		$order->save();

		foreach ($data["pizzas"] as $pizza) {
			$db_pizza = new Pizza();
			$size = PizzaSize::find($pizza["size"]["id"]);
			$base = PizzaBase::find($pizza["base"]["id"]);

			$db_pizza->order()->associate($order);
			$db_pizza->size()->associate($size);
			$db_pizza->base()->associate($base);
			$db_pizza->save();

			foreach ($pizza["toppings"] as $topping) {
				$topping = PizzaTopping::find($topping["id"]);
				if ($topping) {
					$db_pizza->toppings()->attach($topping);
				}
			}

			$db_pizza->save();
		}

		$order->save();
		return $order;
	}

	public function deleteOrder(Order $order) {
		return $order->delete();
	}

	public function getAllOrders() {
		return Order::with(array("pizzas", "pizzas.size", "pizzas.base", "pizzas.toppings"))->orderBy("created_at", "desc")->get();
	}

}