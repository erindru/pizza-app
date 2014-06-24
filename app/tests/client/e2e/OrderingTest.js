describe("Test the flow of a user placing an order", function() {
	var ptor = protractor.getInstance();
	var BASE_URL = ptor.baseUrl;

	console.log(ptor.baseUrl);

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

	it("should have a add pizza button", function() {
		ptor.findElement(by.css("#add-pizza")).then(function(e) {
			expect(e.isPresent()).toBe(true);
		});
		//expect(element(by.css("#add-pizza")).getCssValue("visibility")).toEqual("visible");
	});

/*
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

	});*/
});