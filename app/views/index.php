<!doctype html>
<html ng-app="pizza-app">
	<head>
		<title>Outrageously Good Pizza</title>
		<link rel="stylesheet" type="text/css" href="<?= URL::asset('css/compiled.css') ?>" />
	</head>
	<body ng-controller="MainController">
		<div id="main" class="container">
			<h1>Outrageously Good Pizzas</h1>
			<div ng-if="step >= 1">
				<h2>Choose your size!</h2>
				<select ng-model="order.pizza_size" ng-options="size.name + ' ($' + size.price + ')' for size in sizes" ng-change="sizeSelected()">
					<option value="">Please choose</option>
				</select>
			</div>
			<div ng-if="step >= 2">
				<h2>Choose your base!</h2>
				<select ng-model="order.pizza_base" ng-options="base.name + ' ($' + base.price + ')' for base in bases" ng-change="baseSelected()">
					<option value="">Please choose</option>
				</select>
			</div>
			<div ng-if="step >= 3">
				<h2>Choose your toppings!</h2>
				<select ng-model="order.current_topping" ng-options="topping.name + ' ($' + topping.price + ')' for topping in toppings">
					<option value="">Please choose</option>
				</select>
				<a href="" ng-if="order.current_topping" ng-click="addTopping()">Add topping</a>
				<div ng-repeat="topping in order.pizza_toppings">
					{{ topping.name }}
				</div>
			</div>
			<h3>Total: {{ total() }}</h3>
		</div>
		<script type="text/javascript" src="<?= URL::asset('js/compiled.js') ?>"></script>
	</body>
</html>