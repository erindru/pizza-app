<?php

namespace Pizza\Models\Pizza;

class PizzaTopping extends \Eloquent {

	protected $table = "pizza_toppings";

	protected $fillable = array("name", "price");

	public $timestamps = false;

}