<?php

namespace Pizza\Controllers;

use Pizza\Models\Order\Order;
use Pizza\Models\Repositories\OrderRepository;

use \Input, \Validator, \Response;

class OrderController extends BaseController {

	public function __construct(OrderRepository $orders) {
		$this->orders = $orders;
	}

	public function postIndex() {
		$data = Input::all();
		$validator = Validator::make($data, array(

		));

		if ($validator->passes()) {
			$order = $this->orders->addOrder($data);
			return Response::json(array("success" => true, "order" => $order));
		}

		return Response::json(array("success" => false, "errors" => $validator->messages()));
	}

	public function getIndex() {
		return Response::json($this->orders->getAllOrders());
	}

}