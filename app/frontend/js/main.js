var app = angular.module("pizza-app", ["ngRoute"]);

app.constant("BASE_URL", "/pizza-app/public/");

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