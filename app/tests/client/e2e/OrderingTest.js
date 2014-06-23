describe("Test the flow of a user placing an order", function() {

	beforeEach(function() {
		browser.get("http://localhost:8080/pizza-app/public/");
	});

	it("should display the correct title", function() {
		expect($("#title").getText()).toEqual("Outrageously Good Pizzas");
		expect($("#total").getText()).toEqual("Total: 0.00");
	});

	it("should show the available bases when a size is chosen", function() {
		expect(element(by.css(".step.step1")).getCssValue("display")).toEqual("block");
		expect(element(by.css(".step.step2")).isPresent()).toBe(false);

		var select = element(by.model("order.pizza_size"));
		var options = select.all(by.tagName("option"));
		options.get(1).click();

		expect(element(by.css(".step.step2")).isPresent()).toBe(true);
		expect(element(by.css(".step.step2")).getCssValue("display")).toEqual("block");
	});

	it("should show the available toppings when a base is chosen", function() {
		var select = element(by.model("order.pizza_size"));
		var options = select.all(by.tagName("option"));
		options.get(1).click();

		expect(element(by.css(".step.step2")).isPresent()).toBe(true);
		expect(element(by.css(".step.step3")).isPresent()).toBe(false);

		var select = element(by.model("order.pizza_base"));
		var options = select.all(by.tagName("option"));
		options.get(1).click();

		expect(element(by.css(".step.step3")).isPresent()).toBe(true);
		expect(element(by.css(".step.step3")).getCssValue("display")).toEqual("block");
	});

	it("should add a topping to the list when a topping is chosen", function() {
		var select = element(by.model("order.pizza_size"));
		var options = select.all(by.tagName("option"));
		options.get(1).click();

		var select = element(by.model("order.pizza_base"));
		var options = select.all(by.tagName("option"));
		options.get(1).click();


	});

	it("should update the price when a base is chosen", function() {

	});
});