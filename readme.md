#Community University Portal (CUP)

The Community University Portal provides a resource for community-university project engagement and development between community groups and students, staff, and faculty of the University of Guelph.

[![Build Status](https://secure.travis-ci.org/bktz/CUP.png)](http://travis-ci.org/bktz/CUP)
[![ProjectStatus](http://stillmaintained.com/bktz/CUP.png)](http://stillmaintained.com/bktz/CUP)
[![Latest Stable Version](https://poser.pugx.org/bktz/cup/v/stable.png)](https://packagist.org/packages/bktz/cup)
[![Total Downloads](https://poser.pugx.org/bktz/cup/downloads.png)](https://packagist.org/packages/bktz/cup)

###Here is a list of all the packages that CUP uses:

* [Ardent](https://github.com/laravelbook/ardent)
    * Self-validating smart models for Laravel Framework 4's Eloquent O/RM.
* [Basset](http://jasonlewis.me/code/basset/4.0)
    * Basset is a better asset management package for the Laravel framework.
* [Carbon](https://github.com/briannesbitt/Carbon)
    * A simple API extension for DateTime with PHP 5.3+.
* [Laravel 4 Generators](https://github.com/JeffreyWay/Laravel-4-Generators/blob/master/readme.md)
    * This Laravel 4 package provides a variety of generators to speed up your development process.
* [Presenter](https://github.com/robclancy/presenter)
    * Presenter is a very simply class that overloads methods and variables so that you can add extra logic to your objects or arrays without adding view logic to areas like your models or controllers and also keeps any extra logic our of your views.
* [Entrust](https://github.com/zizaco/entrust)
    * Entrust provides a flexible way to add Role-based Permissions to Laravel4.
* [Confide](https://github.com/zizaco/confide)
    * Confide is a authentication solution for Laravel4 made to eliminate repetitive tasks involving the management of users: Account creation, login, logout, confirmation by e-mail, password reset, etc.
* [CanvasJS](http://canvasjs.com/docs/charts/intro/)
    * CanvasJS is an easy to use HTML5 and Javascript Charting library.

Forked from [andrew13/Laravel-4-Bootstrap-Starter-Site](https://github.com/andrew13/Laravel-4-Bootstrap-Starter-Site) which was based on [brunogaspar/laravel4-starter-kit](https://github.com/brunogaspar/laravel4-starter-kit).

###Packages to add in future releases:

* [Laravel MongoDB](https://github.com/jenssegers/Laravel-MongoDB)
    * An Eloquent model and Query builder with support for MongoDB, inspired by LMongo, but using the original Laravel methods. This library extends the original Laravel classes, so it uses exactly the same methods.
* [reCaptcha](https://github.com/greggilbert/recaptcha)
    * A reCAPTCHA Validator for Laravel 4.

##How to install
###Requirements

	PHP >= 5.4.0 (Entrust requires 5.4, this is an increase over Laravel's 5.3.7 requirement)
	MCrypt PHP Extension
### Step 1: Download Dependencies
#### Option 1: Composer is not installed globally

    cd cup
	curl -s http://getcomposer.org/installer | php
	php composer.phar install --dev
#### Option 2: Composer is installed globally

    cd cup
	composer install --dev

If you haven't already, you might want to make [composer be installed globally](http://andrewelkins.com/programming/php/setting-up-composer-globally-for-laravel-4/) for future ease of use.

Please note the use of the `--dev` flag.

Some packages used to preprocess and minify assests are required on the development environment.

When you deploy your project on a production environment you will want to upload the ***composer.lock*** file used on the development environment and only run `php composer.phar install` on the production server.

This will skip the development packages and ensure the version of the packages installed on the production server match those you developped on.

NEVER run `php composer.phar update` on your production server.

### Step 2: Configure Environments

Laravel 4 will load configuration files depending on your environment. Basset will also build collections depending on this environment setting.

Open ***bootstrap/start.php*** and edit the following lines to match your settings. You want to be using your machine name in Windows and your hostname in OS X and Linux (type `hostname` in terminal). Using the machine name will allow the `php artisan` command to use the right configuration files as well.

    $env = $app->detectEnvironment(array(

        'local' => array('your-local-machine-name'),
        'staging' => array('your-staging-machine-name'),
        'production' => array('your-production-machine-name'),

    ));

Now create the folder inside ***app/config*** that corresponds to the environment the code is deployed in. This will most likely be ***local*** when you first start a project.

You will now be copying the initial configuration file inside this folder before editing it. Let's start with ***app/config/app.php***. So ***app/config/local/app.php*** will probably look something like this, as the rest of the configuration can be left to their defaults from the initial config file:

    <?php

    return array(

        'url' => 'http://myproject.local',

        'timezone' => 'UTC',

        'key' => 'YourSecretKey!!!',

        'providers' => array(
        
        [... Removed ...]
        
        /* Uncomment for use in development */
    //     'Way\Generators\GeneratorsServiceProvider', // Generators
    //     'Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider', // IDE Helpers

        ),

    );

### Step 3: Configure Database

Now that you have the environment configured, you need to create a database configuration for it. Copy the file ***app/config/database.php*** in ***app/config/local*** and edit it to match your local database settings. You can remove all the parts that you have not changed as this configuration file will be loaded over the initial one.

### Step 4: Configure Mailer

In the same fashion, copy the ***app/config/mail.php*** configuration file in ***app/config/local/mail.php***. Now set the `address` and `name` from the `from` array in ***config/mail.php***. Those will be used to send account confirmation and password reset emails to the users.
If you don't set that registration will fail because it cannot send the confirmation email.

### Step 5: Populate Database
Run these commands to create and populate Users table:

	php artisan migrate
	php artisan db:seed

### Step 6: Make sure app/storage is writable by your web server.

If permissions are set correctly:

    chmod -R 775 app/storage

Should work, if not try

    chmod -R 777 app/storage

### Step 7: Build Assets

If you have setup your environments, basset will know you are in development and will build the assets automatically and will not apply certain filters such as minification or combination to keep the code readable. You will need to make the folder where the assets are built writable:

If permissions are set correctly:

    chmod -R 775 public/assets/compiled

Should work, if not try

    chmod -R 777 public/assets/compiled

To force a build of the dev collection use:

```
php artisan basset:build
```

The starter site uses two asset collections, ***public*** and ***admin***. While in development, assets will be built in two folders, ***public*** and ***admin***, inside of ***public/assets/compiled***. These are ignored by git as you do not want them on your production server. Once you are ready to push or upload the code to production run:

```
    php artisan basset:build -p public
    php artisan basset:build -p admin
```

This will build the production assets in ***public/assets/compiled*** which will be versioned in git and should be uploaded to your production server.

### Step 8: Complete!

Navigate to your Laravel 4 website and login at /user/login:

#### Admin Login
    username : admin
    password : admin

#### Broker Login
    username : broker
    password : broker

#### Campus Login
    username : campus
    password : campus

#### Community Login
    username : community
    password : community

Create a new user at /user/create

-----
## Application Structure

The structure of this starter site is the same as default Laravel 4 with one exception.
This starter site adds a `library` folder. Which, houses application specific library files.
The files within library could also be handled within a composer package, but is included here as an example.

### Development

All settings have been pre-configured for development.

### Production Launch

By default debugging is enabled. Before you go to production you should disable debugging in `app/config/app.php`


    /*
    |--------------------------------------------------------------------------
    | Application Debug Mode
    |--------------------------------------------------------------------------
    |
    | When your application is in debug mode, detailed error messages with
    | stack traces will be shown on every error that occurs within your
    | application. If disabled, a simple generic error page is shown.
    |
    */

    'debug' => false,


## Troubleshooting

### Styles are not displaying

You may need to recompile the assets for basset. This is easy to with one command.

```
php artisan basset:build
```

### Site loading very slow

Are you running Windows??

Please try adjusting the basset configuration as show in this [comment](https://github.com/andrew13/Laravel-4-Bootstrap-Starter-Site/issues/148#issuecomment-22995288)

In app/config/packages/jasonlewis/basset/config.php:

```
 $collection->directory('assets/js', function($collection)
            {
                $collection->javascript('//ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js');
                //$collection->add('bootstrap/bootstrap.js');
                $collection->requireDirectory('../../../vendor/twbs/bootstrap/js');
            })->apply('JsMin');
```
to:
```
 $collection->directory('assets/js', function($collection)
            {
                $collection->javascript('http://ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js');
                $collection->add('bootstrap/bootstrap.js');
                $collection->requireDirectory('../../../vendor/twbs/bootstrap/js');
            })->apply('JsMin');
```

## Included Package Information
<a name="confide"></a>
### Confide Authentication Solution

Used for the user auth and registration. In general for user controllers you'll want to use something like the following:

    <?php

    use Zizaco\Confide\ConfideUser;

    class User extends ConfideUser {

    }

For full usage see [Zizaco/Confide Documentation](https://github.com/zizaco/confide)

<a name="entrust"></a>
### Entrust Role Solution

Entrust provides a flexible way to add Role-based Permissions to Laravel4.

    <?php

    use Zizaco\Entrust\EntrustRole;

    class Role extends EntrustRole
    {

    }

For full usage see [Zizaco/Entrust Documentation](https://github.com/zizaco/entrust)

<a name="ardent"></a>
### Ardent - Used for handling repetitive validation tasks.

Self-validating, secure and smart models for Laravel 4's Eloquent ORM

For full usage see [Ardent Documentation](https://github.com/laravelbook/ardent)

<a name="carbon"></a>
### Carbon

A fluent extension to PHPs DateTime class.

```php
<?php
printf("Right now is %s", Carbon::now()->toDateTimeString());
printf("Right now in Vancouver is %s", Carbon::now('America/Vancouver'));  //implicit __toString()
$tomorrow = Carbon::now()->addDay();
$lastWeek = Carbon::now()->subWeek();
$nextSummerOlympics = Carbon::createFromDate(2012)->addYears(4);

$officialDate = Carbon::now()->toRFC2822String();

$howOldAmI = Carbon::createFromDate(1975, 5, 21)->age;

$noonTodayLondonTime = Carbon::createFromTime(12, 0, 0, 'Europe/London');

$worldWillEnd = Carbon::createFromDate(2012, 12, 21, 'GMT');
```

For full usage see [Carbon](https://github.com/briannesbitt/Carbon)

<a name="basset"></a>
### Basset

A Better Asset Management package for Laravel.

Adding assets in the configuration file `config/packages/jasonlewis/basset/config.php`
```php
'collections' => array(
        'public-css' => function($collection)
        {
            $collection->add('assets/css/bootstrap.min.css');
            $collection->add('assets/css/bootstrap-responsive.min.css');
        },
    ),
```

Compiling assets

    $ php artisan basset:build

I would recommend using development collections for development instead of compiling .

For full usage see [Using Basset by Jason Lewis](http://jasonlewis.me/code/basset/4.0)

<a name="presenter"></a>
### Presenter

Simple presenter to wrap and render objects. Think of it of a way to modify an asset for the view layer only.
Control the presentation in the presentation layer not in the model.

The core idea is the relationship between two classes: your model full of data and a presenter which works as a sort of wrapper to help with your views.
For instance, if you have a `User` object you might have a `UserPresenter` presenter to go with it. To use it all you do is `$userObject = new UserPresenter($userObject);`.
The `$userObject` will function the same unless a method is called that is a member of the `UserPresenter`. Another way to think of it is that any call that doesn't exist in the `UserPresenter` falls through to the original object.

For full usage see [Presenter Readme](https://github.com/robclancy/presenter)

<a name="generators"></a>
### Laravel 4 Generators

Laravel 4 Generators package provides a variety of generators to speed up your development process. These generators include:

- `generate:model`
- `generate:seed`
- `generate:test`
- `generate:view`
- `generate:migration`
- `generate:resource`
- `generate:scaffold`
- `generate:form`
- `generate:test`

For full usage see [Laravel 4 Generators Readme](https://github.com/JeffreyWay/Laravel-4-Generators/blob/master/readme.md)


##License

[Creative Commons Attribution-NonCommercial-ShareAlike 3.0 Unported License](http://creativecommons.org/licenses/by-nc-sa/3.0/deed.en_US)

[![License](http://i.creativecommons.org/l/by-nc-sa/3.0/88x31.png)](http://creativecommons.org/licenses/by-nc-sa/3.0/deed.en_US)

###Authors
* Benjamin Katznelson
    * Website: [http://ca.linkedin.com/in/benikatznelson](http://ca.linkedin.com/in/benikatznelson)
* Justin Tempelm
    * Website: [http://ca.linkedin.com/pub/justin-tempelman/63/a02/332](http://ca.linkedin.com/pub/justin-tempelman/63/a02/332)

###Attribution

1. All authors must be attributed in code and final products of derivative works.
2. Links to all authors' respective websites must be included in code and final products of derivative works.

##Thanks
Special thanks to [andrew13/Laravel-4-Bootstrap-Starter-Site](https://github.com/andrew13/Laravel-4-Bootstrap-Starter-Site) and all the contributors for the amazing project and detailed readme.
