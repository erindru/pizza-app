describe("Test the flow of a user placing an order", function() {

	beforeEach(function() {
		browser.get("http://localhost:8080/pizza-app/public/");
	});

	it("should display the correct title", function() {
		expect($("#title").getText()).toEqual("Outrageously Good Pizzas");
		expect($("#total").getText()).toEqual("Total: 0.00");
		var size = element(by.model("order.pizza_size")).getAttribute("value");
		console.log("value:", size.getText());
		expect(size).toEqual("Please choose");
	});
});