<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## Append Composer Package

- [laravel/jetstream](https://jetstream.laravel.com/2.x/introduction.html).
- [laravel/fortify](https://readouble.com/laravel/8.x/ja/fortify.html).
- [barryvdh/laravel-debugbar](https://github.com/barryvdh/laravel-debugbar).
- [laravelcollective/html](https://laravelcollective.com/)

## Append NodeModule Package


## Develop Environment

[MAMP](https://www.mamp.info/en/downloads/) or Docker (php ver 8.0 | Mysql5.7)

## Directory Structure

```php
gift_ec/
        ┣app/
            └ Console/
            └ Consts/ #define const
            └ Exceptions/
            └ Http/
                  └ Actions/ #Single controller
                  └ Requests/ #validation check
            └ Jobs/
            └ Mail/
            └ Models/
            └ Providers/
            └ Services/ #main controller process
            └ View/
        ┣bootstrap
        ┣config #setting
        ┣database
        ┣public
        ┣resources
                  └ css/
                  └ js/ 
                  └ lang/ #lang
                  └ views/ #blade file      
        ┣routes #define controller route
        ┣storage
        ┣tests #process test
```

##  Infrastructure

only local environment

## Start Project

git clone this project your local environment

```php
git clone https://github.com/ugawataisei/event_crm.git
```

write .env file　your own environment
```php
#.env file

#database option
DB_CONNECTION=mysql
DB_HOST=
DB_PORT=
DB_DATABASE=
DB_USERNAME=
DB_PASSWORD=

```

run command first after clone this project

```php
composer install
npm install 
npm run development #css and js compile
```

run command your local environment
```php
php artisan:storage link
php artisan migrate:refresh --seed
php artisan serve #start php server
```

login

```php
#admin
url : 'app-url/admin/login'
user : admin@admin.admin
pass : password

```
