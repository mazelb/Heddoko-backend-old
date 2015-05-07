This guide quickly outlines the official Laravel5 [Installation Guide](http://laravel.com/docs/master).

# Laravel Setup

Running the projects involves

  - Installing Composer
  - Installing Laravel

### Installing Composer

For OSX: http://www.abeautifulsite.net/installing-composer-on-os-x/

At the end, you should be able to run

```sh
composer
```

from the command line.
### Installing Laravel
```sh
composer global require "laravel/installer=~1.1"
```

You should be able to run
### Running a Laravel project

cd into the project directory, ie team-management-dashboard and run the project using php's built-in webserver

```sh
php artisan serve
```