<?php

namespace Pizza\Models\Pizza;

class PizzaBase extends \Eloquent {

	protected $table = "pizza_bases";

	protected $fillable = array("name", "price");

	public $timestamps = false;
}