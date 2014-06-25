var app = angular.module("pizza-app", ["ngRoute"]);

app.config(function($routeProvider) {

	$routeProvider.when("/", {
		controller: "MainController",
		templateUrl: "views/main.html"
	}).when("/admin", {
		controller: "AdminController",
		templateUrl: "views/admin.html"
	}).otherwise({
		redirecTo: "/"
	});

});