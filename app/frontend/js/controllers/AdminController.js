angular.module("pizza-app").controller("AdminController", function(BASE_URL, $scope, $http) {

	$scope.authenticate = function(password) {
		$scope.error = "";
		$http.post(BASE_URL + "orders/validate-password", { password : password }).then(function(data) {
			console.log(data);
			if (data.data.valid) {
				$scope.authenticated = true;
				$scope.loadOrders();
			} else {
				$scope.error = "Incorrect password, please try again.";
			}
		});
	}

	$scope.loadOrders = function() {
		$http.get(BASE_URL + "orders", { params: { password : $scope.password }}).then(function(data) {
			$scope.orders = data.data;
		});
	}

	$scope.removeOrder = function(order) {
		if (!confirm("Are you sure?")) { return; }
		$http.delete(BASE_URL + "orders", { params: { id : order.id, password: $scope.password }}).then(function(data) {
			$scope.loadOrders();
		});
	}

});