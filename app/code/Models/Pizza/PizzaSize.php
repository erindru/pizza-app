<?php

namespace Pizza\Models\Pizza;

class PizzaSize extends \Eloquent {

	protected $table = "pizza_sizes";

	protected $fillable = array("name", "price");

	public $timestamps = false;

}