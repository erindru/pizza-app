angular.module("pizza-app").controller("MainController", function($scope, $http, BASE_URL) {

	$scope.order = {
		pizza_size : { price: 0 },
		pizza_base : { price: 0 },
		pizza_toppings: []
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

	$scope.selectSize = function(size) {
		if (size) {
			$scope.order.pizza_size = size;
		}
		$scope.step = (size) ? 2 : 1;
	}

	$scope.selectBase = function(base) {
		if (base) {
			$scope.order.pizza_base = base;
		}
		$scope.step = (base) ? 3 : 2;
	}

	$scope.addTopping = function(topping) {
		if (topping) {
			if ($scope.order.pizza_toppings.indexOf(topping) == -1) {
				$scope.order.pizza_toppings.push(topping);
			}
		}
		$scope.step = (topping) ? 4 : 3;
	}

	$scope.total = function() {
		var sum = parseFloat($scope.order.pizza_size.price) + parseFloat($scope.order.pizza_base.price);
		for(var topping in $scope.order.pizza_toppings) {
			topping = $scope.order.pizza_toppings[topping];
			sum += parseFloat(topping.price);
		}
		return sum.toFixed(2);
	}

});