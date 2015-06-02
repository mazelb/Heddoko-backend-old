This guide quickly outlines the official Laravel5 [Installation Guide](http://laravel.com/docs/master).

# Laravel Setup

Running the projects first requires

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

### Developing

The template we are using was designed around a workflow tool called grunt. You must call grunt from the root of the dashboard folder:

```sh
grunt dev
```

Grunt will keep an eye on the css and js files, and perform actions on them after they have been edited (ie combine all JS to app.js, and compile the sass CSS).

## Coach Dashboard Structure

### Laravel

Laravel is responsible for most of the backend functionality of the web app. It connects to the database and allows for the manipulation of the tables, it performs authentication, and it controls all routing.

Laravel also provides RESTful API creation. Currently, '/api/fmsforms' is a resource that can return FMS forms or allow for their deletion. 

### Angular

Essentially, the root of the website ('/') routes to a single page where the angular application is running. Within that directory, Angular controls the routing of the pages within and makes calls to the backend. It makes calls to the Laravel backend REST api.

All the files with respect to the angular app are in '/angular-app'. Make sure grunt is running when they are edited (see above section 'Developing'). The modified files are compiled and pushed to /public where they can be accessed by public pages.
