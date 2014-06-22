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
		expect(scope.order.pizza_size).toBeDefined();
		expect(scope.order.pizza_base).toBeDefined();
		expect(scope.order.pizza_toppings).toBeDefined();

		expect(scope.order.pizza_size.price).toBe(0);
		expect(scope.order.pizza_base.price).toBe(0);
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

	it("should start at step 1", function() {
		expect(scope.step).toBe(1);
	});

	it("should correctly change the state when a size is selected", function() {
		scope.selectSize(mock_sizes[0]);

		expect(scope.order.pizza_size).toEqual(mock_sizes[0]);
		expect(scope.step).toBe(2);
	});

	it("should correctly change the state when a size is selected", function() {
		scope.selectBase(mock_bases[0]);

		expect(scope.order.pizza_base).toEqual(mock_bases[0]);
		expect(scope.step).toBe(3);
	});

	it("should correctly change the state when a topping is added", function() {
		scope.addTopping(mock_toppings[0]);

		expect(scope.order.pizza_toppings.length).toBe(1);
		expect(scope.order.pizza_toppings[0]).toEqual(mock_toppings[0]);
		expect(scope.step).toBe(4);

		scope.addTopping(mock_toppings[1]);
		expect(scope.order.pizza_toppings.length).toBe(2);
		expect(scope.order.pizza_toppings[0]).toEqual(mock_toppings[0]);
		expect(scope.order.pizza_toppings[1]).toEqual(mock_toppings[1]);
		expect(scope.step).toBe(4);
	});

	it("should not add the same topping more than once", function() {
		scope.addTopping(mock_toppings[0]);
		scope.addTopping(mock_toppings[0]);

		expect(scope.order.pizza_toppings.length).toBe(1);
	});

	it("should correctly calculate the total", function() {
		scope.selectSize(mock_sizes[0]); /* 2.10 */
		scope.selectBase(mock_bases[0]); /* 1.30 */
		scope.addTopping(mock_toppings[0]); /* 1.40 */
		scope.addTopping(mock_toppings[1]); /* 1.90 */

		expect(scope.total()).toEqual("6.70");
	});

});
