describe("Test MainController", function() {
	var scope, httpBackend;

	var mock_sizes = [{"id":1,"name":"Small","price":"2.10"},{"id":2,"name":"Medium","price":"2.90"},{"id":3,"name":"Large","price":"3.10"},{"id":4,"name":"Extra Large","price":"3.90"}];
	var mock_bases = [{"id":1,"name":"Cheesy Crust","price":"1.30"},{"id":2,"name":"Italian","price":"1.70"},{"id":3,"name":"Deep Pan","price":"1.20"},{"id":4,"name":"Stuffed Crust","price":"1.90"},{"id":5,"name":"Thin","price":"2.50"}];
	var mock_toppings = [{"id":1,"name":"Cheese","price":"1.40"},{"id":2,"name":"Salami","price":"1.90"},{"id":3,"name":"Ham","price":"1.70"},{"id":4,"name":"Pineapple","price":"1.65"},{"id":5,"name":"Bacon","price":"1.20"},{"id":6,"name":"Capsicum","price":"1.10"}];

	beforeEach(angular.mock.module("pizza-app"));

	beforeEach(angular.mock.inject(function($rootScope, $controller, $httpBackend) {
		scope = $rootScope.$new();
		$controller("MainController", { $scope : scope, BASE_URL: "" });

		//mock HTTP responses
		httpBackend = $httpBackend;
		$httpBackend.when("GET", "/pizza/sizes").respond(mock_sizes);
		$httpBackend.when("GET", "/pizza/bases").respond(mock_bases);
		$httpBackend.when("GET", "/pizza/toppings").respond(mock_toppings);
	}));

	it("should start with an unpopulated order", function() {
		expect(scope.order).toBeDefined();
		expect(scope.order.pizzas).toBeDefined();
	});

	it("should populate sizes on load", function() {
		httpBackend.flush();
		expect(scope.sizes).toEqual(mock_sizes);
	});

	it("should populate bases on load", function() {
		httpBackend.flush();
		expect(scope.bases).toEqual(mock_bases);
	});

	it("should populate toppings on load", function() {
		httpBackend.flush();
		expect(scope.toppings).toEqual(mock_toppings);
	});

	it("should be able to add a pizza", function() {
		scope.addPizza();

		expect(scope.order.pizzas.length).toBe(1);
		expect(scope.order.pizzas[0].size).toBeDefined();
		expect(scope.order.pizzas[0].size.price).toBe(0);
		expect(scope.order.pizzas[0].base.price).toBe(0);
		expect(scope.order.pizzas[0].toppings).toBeDefined();
		expect(scope.order.pizzas[0].toppings.length).toBe(0);
	});

	it("should produce a correct total for a pizza", function() {
		httpBackend.flush();

		scope.addPizza();
		var pizza = scope.order.pizzas[0];

		pizza.size = scope.sizes[0]; /* 2.10 */
		pizza.base = scope.bases[0]; /* 1.30 */
		pizza.toppings.push(scope.toppings[0]); /* 1.40 */
		pizza.toppings.push(scope.toppings[1]); /* 1.90 */

		expect(scope.totalForPizza(pizza)).toEqual("6.70");
	});

	it("should produce a correct total for multiple pizzas", function() {
		httpBackend.flush();

		scope.addPizza();
		var pizza = scope.order.pizzas[0];

		pizza.size = scope.sizes[0]; /* 2.10 */
		pizza.base = scope.bases[0]; /* 1.30 */
		pizza.toppings.push(scope.toppings[0]); /* 1.40 */
		pizza.toppings.push(scope.toppings[1]); /* 1.90 */

		scope.addPizza();
		var pizza1 = scope.order.pizzas[1];

		pizza1.size = scope.sizes[1]; /* 2.90 */
		pizza1.base = scope.bases[1]; /* 1.70 */
		pizza1.toppings.push(scope.toppings[2]); /* 1.70 */
		pizza1.toppings.push(scope.toppings[3]); /* 1.65 */

		expect(scope.total()).toEqual("14.65");
	});


});
