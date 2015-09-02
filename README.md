Running the dashboards involves a few major steps:
- Installing Laravel
- Installing Theme Template requirements
- Configuring PHP for Laravel

# Installing Composer
This section outlines the official Laravel installation guide found [here](http://laravel.com/docs/5.1#installation).

Install Composer for your platform from [the official composer page](https://getcomposer.org/download/)

Make sure you are able to run
```sh
composer about
```

Next, install Laravel using composer:

```sh
composer global require "laravel/installer=~1.1"
```
Ensure you can run 

```sh
laravel
```

and see appropriate output. If you get a "command not found" type error, you might need to add composer to your PATH variable:

```
%USERPROFILE%\AppData\Roaming\Composer\vendor\bin;
```

# Installing Theme Template requirements

The theme template we are using requires a few dependencies to run properly

## Installing Node.js

Install Node.js for your platform from the [official downloads page](https://nodejs.org/download/). We only use node because it has npm, a package manager, used by the template.

## Installing bower

```sh
npm install -g bower
```

## Installing grunt-cli

Grunt is a tool to speed up your web app workflow

```sh
npm install -g grunt-cli
```

## Installing Ruby + SASS
Ruby is required to compile sass to css.
Install Ruby for your platform from the [official downloads page](https://www.ruby-lang.org/en/downloads/).

Make sure you are able to run
```sh
ruby -v
```

If you get a "command not found" type error, you might need to add composer to your PATH variable:
```
C:\Ruby22-x64\bin;
```

Next, use gem to install sass

```sh
gem install sass
```

Finally, run these 3 commands which will pull dependency packages in from a repository.


```sh
npm install
```

```sh
bower install
```

```sh
composer install
```

# Configuring PHP for Laravel

A few steps must be taken to make sure the php web server runs properly before you can run the site.

## Download and install PHP

Download PHP for your architecture (get the non thread safe version) from the [official PHP downloads page](http://php.net/downloads.php)

Then, extract it to your machine (eg in C:\PHP)

You now need to add that path to your PATH environment variable so your OS can find the php.exe file.

For example, add this to your PATH:

```
C:\PHP\;
```
Now, open a new command window and type 

```sh
php -v
```

and ensure a correct output.
## Enable the correct extensions for Laravel
Finally, go to the directory where the PHP files were extracted and make a copy of php.ini-production and name this new copy 'php.ini',

Open this file, and uncomment the following line:

```
 extension_dir = "ext"
 ```
 
 Finally, uncomment the following 3 lines:
 
 ```
 extension=php_mbstring.dll
 extension=php_openssl.dll
 extension=php_pdo_mysql.dll
 ```
 
 # Developping and Running a Dashboard

With all of these steps completed, you can now run a dashboard by cd-ing into the correct dashboard folder (eg. /Dashboards/Coach Dashboard) and running

```sh
php artisan serve
```

When developing, you want to also run
```sh
grunt dev
```
in a separate command window. Grunt will monitor any changes to the JS and SASS if the dashboard and perform a few tasks for you (check syntax, compile sass to css, copy the files to the correct public folder). see gruntfile.js for more info

# Database configuration

## Environment Files

In the root of each dashboard project you will find 3 files: .env, .env.production, and .env.local

The settings in the .env file (not the other 2) are read by Laravel. The reason for this is that you might have a different database connection setting or debug level depending on if you are running it locally or in the cloud.

Copy the contents of .env.local or .env.production into .env accordingly.

the file config/database.php is in charge of connecting to the SQL database. Its contents show how it actually reads its settings from the .env file. Therefore, changes should primarily be made to the .env file for the use of connecting to an SQL database. Be sure to specify the IP, port, database name, username, and password of the database you are trying to connect to.

## Migrations and Seeding

Once you are connected to an SQL database, you can populate it with tables defined in database/migrations.
To do so, run

```sh
php artisan migrate
```

To clear the database tables and run the database seeder class, run
```sh
php artisan db:seed
```

This empties the database and re-populates it according to DatabaseSeeder.php
