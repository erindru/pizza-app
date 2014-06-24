angular.module("pizza-app").controller("MainController", function($scope, $http, BASE_URL) {

	$scope.order = {
		pizzas : []
	};

	$http.get(BASE_URL + "/pizza/sizes").success(function(data) {
		$scope.sizes = data;
	});

	$http.get(BASE_URL + "/pizza/bases").success(function(data) {
		$scope.bases = data;
	});

	$http.get(BASE_URL + "/pizza/toppings").success(function(data) {
		$scope.toppings = data;
	});

	$scope.step = 1;

	$scope.addPizza = function() {
		if ($scope.order.pizzas.length > 0) {
			var last_pizza = $scope.order.pizzas[$scope.order.pizzas.length - 1];
			if (!$scope.pizzaIsComplete(last_pizza)) {
				alert("You should really finish your current pizza before adding a new one.");
				return;
			}
		}
		$scope.order.pizzas.push({
			size: {
				price: 0
			},
			base: {
				price: 0
			},
			toppings: []
		});
	}

	$scope.addToppingToPizza = function(pizza, topping) {
		if (topping) {
			if (pizza.toppings.indexOf(topping) == -1) {
				pizza.toppings.push(topping);
			} else {
				alert("Youve already added that topping!");
			}
		}
	}

	$scope.removePizzaFromOrder = function(pizza) {
		$scope.order.pizzas.splice($scope.order.pizzas.indexOf(pizza), 1);
	}

	$scope.removeToppingFromPizza = function(pizza, topping) {
		pizza.toppings.splice(pizza.toppings.indexOf(topping), 1);
	}

	$scope.total = function() {
		var total = 0.00;
		for (var pizza in $scope.order.pizzas) {
			pizza = $scope.order.pizzas[pizza];
			total += parseFloat($scope.totalForPizza(pizza));
		}
		return total.toFixed(2);
	}

	$scope.totalForPizza = function(pizza) {
		var sum = parseFloat(pizza.size.price) + parseFloat(pizza.base.price);
		for(var topping in pizza.toppings) {
			topping = pizza.toppings[topping];
			sum += parseFloat(topping.price);
		}
		return sum.toFixed(2);
	}

	$scope.pizzaIsComplete = function(pizza) {
		return (pizza.size.price > 0 && pizza.base.price > 0 && pizza.toppings.length > 0);
	}

	$scope.hasCompletedPizzas = function() {
		for (var pizza in $scope.order.pizzas) {
			pizza = $scope.order.pizzas[pizza];
			if ($scope.pizzaIsComplete(pizza)) {
				return true;
			}
		}
		return false;
	}

	$scope.advanceToDeliveryDetails = function() {
		$scope.step = 2;
	}

	$scope.hasCompletedDeliveryDetails = function() {
		return $scope.order.customer_name && $scope.order.customer_address;
	}

	$scope.submitOrder = function() {
		$scope.submitting = true;
		$http.post(BASE_URL + "/orders", $scope.order).success(function(data) {
			$scope.submitting = false;
			console.log(data);
			if (data.success) {
				$scope.step = 3;
			} else {
				alert("Error submitting order: " + data.error);
			}
		});
	}

});