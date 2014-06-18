## Outrageously Good Pizza

# Technology Choices
- Built in PHP/MySQL as that is what I am immediately familar with without spending extra time looking up documentation
- API-based backend driven by static frontend using AngularJS
- Stylus is the CSS preprocessor in use for no reason other than I like it, and have been using it for the past 6 months
- PHP Dependencies managed using Composer, JS dependencies managed using Bower and tasks managed using Grunt
- Developed and tested on Linux, a Vagrantfile is provided so you can easily get a working environment up and running

# Installation
- If youre using vagrant, just run 'vagrant up' and away you go
- Otherwise, clone the repo, run `composer install`, modify 'app/config/database.php' with your MySQL database details, run `php artisan migrate` and then `php artisan serve` (or create a vhost in Apache (other webservers will need custom config for rewrite rules) and point the webroot to /public))
- Run PHP tests by executing `vendor/bin/phpunit` from the project root

# Things to note
- PHP side fully unit tested with PHPUnit
- Client side tested with Karma/Jasmine
- Due to API driven design, it would be easy to hook up a mobile app in future

