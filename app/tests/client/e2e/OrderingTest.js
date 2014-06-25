describe("Test the flow of a user placing an order", function() {
	var ptor = protractor.getInstance();
	var BASE_URL = ptor.baseUrl;

	beforeEach(function() {
		browser.get(BASE_URL + "/#/");
	});

	it("should redirect / to #/", function() {
		browser.get(BASE_URL + "/");
		browser.getLocationAbsUrl().then(function(url) {
			expect(url.split("#")[1]).toBe("/");
		});
	});

	it("should display the correct title", function() {
		expect($("#title").getText()).toEqual("Extremely Simple Pizzas");
	});

	it("should start with a total of 0.00", function() {
		expect($("#total").getText()).toEqual("Total Cost: $0.00");
	});

	it("should have a add pizza button", function() {
		expect($("#add-pizza").isPresent()).toBe(true);
	});

	it("should show the base, size and topping dropdowns when the add pizza button is clicked", function() {
		$("#add-pizza").click();

		element.all(by.repeater("pizza in order.pizzas")).then(function(rows) {
			expect(rows.length).toBe(1);
			expect(rows[0].element(by.model("pizza.size")).isPresent()).toBe(true);
			expect(rows[0].element(by.model("pizza.base")).isPresent()).toBe(true);
			expect(rows[0].element(by.model("pizza.current_topping")).isPresent()).toBe(true);
		});
	});

	it("should show the 'I am happy with my order' button when a pizza is filled out", function() {
		$("#add-pizza").click();

		expect($("#happy-with-order").isPresent()).toBe(false);

		element.all(by.repeater("pizza in order.pizzas")).then(function(rows) {
			var row = rows[0];
			row.element(by.model("pizza.size")).all(by.tagName("option")).then(function(options) {
				options[1].click();
			});

			expect($("#happy-with-order").isPresent()).toBe(false);

			row.element(by.model("pizza.base")).all(by.tagName("option")).then(function(options) {
				options[1].click();
			});

			expect($("#happy-with-order").isPresent()).toBe(false);

			row.element(by.model("pizza.current_topping")).all(by.tagName("option")).then(function(options) {
				options[1].click();
			});

			expect($("#happy-with-order").isPresent()).toBe(true);
		});
	});
});