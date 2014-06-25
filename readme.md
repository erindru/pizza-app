## Extremely Simple Pizza

# Technology Choices

- Built in PHP/MySQL as that is what I am immediately familar with without spending extra time looking up documentation. I did think about doing it in Java/Spring but decided against it as I believe the goal was to demonstrate modern programming knowledge, which can be done in less time with the tools I am immediately familar with.
- API-based backend driven by AngularJS frontend
- Stylus is the CSS preprocessor in use for no reason other than I like it, and have been using it successfully for the past 6 months
- PHP Dependencies managed using Composer, JS dependencies managed using Bower and Tasks managed using Grunt.
- PHP unit tests are using PHPUnit, JS unit tests are using Karma/Jasmine and end-to-end tests are using Selenium/Karma/Protractor
- Note this has only been tested on a modern Linux environment, behaviour in other environments is unknown

# Installation just to get it running

I have committed the compiled assets to this repo in order to get the project up and running quickly with minimal dependencies.

Additionally, I have a version installed and running at http://pizza-app.liquid-awesome.net in case you have difficulties getting it running (I am assuming that
 this toolchain is unfamiliar to you)

1. Make sure `composer` is installed. Also, make sure the php mcrypt (`php5-mcrypt` on ubuntu) extension is installed.
1. Clone this repo
1. Run `composer install` to pull in Laravel and other PHP dependencies
1. Modify `sample.env.php` with your mysql details and then rename it to `.env.php`
1. Run `php artisan migrate --seed` to create the db tables and seed sample data
1. Configure an apache vhost to point to the `public` directory. Alternatively, for a quick and easy webserver, run `php artisan serve`

# Installation for dev

1. Follow the "Installation just to get it running" task above
1. Make sure you have `npm`, `grunt`, `bower`, `karma`, `protractor` and `composer` installed. Grunt, Karma, Protractor and Bower can be installed globally with `npm install -g karma-cli grunt-cli bower protractor`. Follow the guide on https://getcomposer.org/download/ for Composer.
1. Clone this repo
1. Run `composer install`, `bower install` and `npm install`
1. Run `grunt` and then `grunt watch` and start editing files

# Running the tests

1. Follow the "Installation for dev" task above
1. To run the PHPUnit tests, run `vendor/bin/phpunit`. The tests are stored in `app/tests/server`
1. To run the JS tests, run `karma start karma.conf.js`. The tests are stored in `app/tests/client/frontend`
1. To run the end-to-end tests, start Selenium webserver (`webdriver-manager start`), start your actual webserver and then run `protractor protractor.conf.js --baseUrl=http://url-of-app`. The tests are stored in `app/tests/client/e2e`

Note: The tests are not complete, I have implemented a few of each type to demonstrate knowledge but they are not as comprehensive as they could be.

# Things to do as a "customer" user

- Click the "Add pizza" button and notice the text telling you to click the button disappear (it assumes by the fact that you clicked the button, you know in future to click the button and dont need to be told)
- A new Pizza will be added to the list. Notice how you cant choose a base unless you choose a size, and a topping unless you choose a base.
- Notice how you cant choose the same topping twice, selecting it again in the list has no effect
- Notice how the Pizza Total and Grand Total (top right) change dynamically as you assemble your pizza
- You can remove a pizza from the Order by clicking the red "x" on the left
- Notice how the "I am happy with my order!" button doesnt show unless you have a fully complete pizza in your order.
- When youre happy with your order, click the corresponsing button. Notice how the "Send me my pizza!" button doesnt show unless you enter something in the name and address fields
- Clicking the "Send me my pizza!" button

# Things to do as an "admin" user

- Enter the "admin" section by clicking "Admin" on the bottom right. Immediately, you need to authenticate. The password is "thebestpasswordintheworld". Note that this password is checked server side and must be included in every query for sensitive data, like the order list and deleting a order. You can prevent people sniffing it by serving the site over SSL.
- Once you have authenticated successfully, a list of orders is shown, sorted by newest first. You can see the full details of the orders here. Click "Delete" to delete one, and notice that your prompted to confirm it. Once its deleted, the list will refresh.
- Also notice that when you refresh the page, you have to enter your password again. This would get very annoying for an actual user very quickly, so theres a "Refresh" button on the top right that refreshes the list without refreshing the page. You can verify it works by submitting an order in another tab, and then clicking it.