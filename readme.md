# Installation and setup guide

To setup the platform please run the following commands

    1) Clone the repo using ssh 'git clone git@github.com:billy124/laravel-cms.git' or using https 'git clone https://github.com/billy124/laravel-cms.git'

    2) Install the composer packages 'composer install'

    3) Install bower and NPM packages 'bower install', 'npm install' 

    4) Setup the .env file: 'cp .env.example .env' 

    5) Create a database on your local machine and edit the .env with your db credentials 

    6) Create tables and seed database 'php artisan migrate:refresh --seed'

    7) Serve the site using PHP 'php artisan serve'


## Test user accounts 

Below are test user accounts that get created when seeding 

    Admin User (username / password):
        - billy124@msn.com
        - admin123

    Generic user (username / password):
        - omar@mytestingarea.com
        - admin123


## Custom artisan commands 

Below are custom artisan commands and their description

    - 'php artisan migrate:pages' after a 'git pull' this command sync's the new pulled cmsable pages with the existing pages in your database


## License

The Laravel framework is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT).
