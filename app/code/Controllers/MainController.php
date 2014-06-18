<?php

namespace Pizza\Controllers;

use \View;

class MainController extends BaseController {

	public function getIndex() {
		return View::make("index");
	}

}