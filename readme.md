# Installation and setup guide

To setup the platform please carry out the following commands after pulling from git

1) run command 'composer update' to make sure you have all the packages needed

2) make sure you have a .env file in the application root, if not copy the .env.example and name it to .env

3) create a database on your local machine and edit the .env with your db credentials 

4) run command 'php artisan migrate:refresh' to create all the tables for the project

5) to run a php server run command 'php artisan serve'


## Contributing

Thank you for considering contributing to the Laravel CMS!

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell at taylor@laravel.com. All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT).
