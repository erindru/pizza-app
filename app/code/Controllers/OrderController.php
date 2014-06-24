<?php

namespace Pizza\Controllers;

use Pizza\Models\Order\Order;
use Pizza\Models\Repositories\OrderRepository;

use \Input, \Validator, \Response;

class OrderController extends BaseController {

	public function __construct(OrderRepository $orders) {
		$this->orders = $orders;

		$this->beforeFilter("@checkAuthenticated", array("except" => array("postValidatePassword", "postIndex")));
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

	public function postValidatePassword() {
		return Response::json(array("valid" => $this->isCorrectPassword($this->getPasswordFromInput())));
	}

	public function deleteIndex() {
		$id = Input::get("id");
		$this->orders->deleteOrder($this->orders->getOrder($id));
		return Response::json(array("success" => true, "deleted" => true));
	}

	private function isCorrectPassword($password) {
		return $password == "thebestpasswordintheworld";
	}

	public function checkAuthenticated() {
		if (!$this->isCorrectPassword($this->getPasswordFromInput())) {
			return Response::json(array("success" => false, "error" => "invalid password!"));
		}
	}

	private function getPasswordFromInput() {
		return Input::get("password");
	}

}