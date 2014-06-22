// An example configuration file.
exports.config = {
	// The address of a running selenium server.
	seleniumAddress: 'http://localhost:4444/wd/hub',

	baseUrl: 'http://localhost:8080/pizza-app/public',

	// Capabilities to be passed to the webdriver instance.
	capabilities: {
		'browserName': 'chrome'
	},

	// Spec patterns are relative to the configuration file location passed
	// to proractor (in this example conf.js).
	// They may include glob patterns.
	specs: ['app/tests/client/e2e/**/*.js'],

	framework: "jasmine"
};