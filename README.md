<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## Append Composer Package

- [laravel/jetstream](https://jetstream.laravel.com/2.x/introduction.html)
- [laravel/fortify](https://readouble.com/laravel/8.x/ja/fortify.html)
- [livewire/livewire](https://laravel-livewire.com/)
- [barryvdh/laravel-debugbar](https://github.com/barryvdh/laravel-debugbar)
- [laravelcollective/html](https://laravelcollective.com/)
- [reliese/laravel](https://github.com/reliese/laravel)

## Append NodeModule Package

- [flowbite](https://flowbite.com/docs/getting-started/introduction/)
- [alpinejs](https://alpinejs.dev/)
- [jquery](https://jquery.com/)
- [flatpickr](https://flatpickr.js.org/)
- [select2](https://select2.org/)

## Develop Environment

[MAMP](https://www.mamp.info/en/downloads/) or Docker (php ver 8.0 | Mysql5.7)

## Directory Structure

```php
event_crm/
        ┣app/
            └ Console/
            └ Consts/ #define const
            └ Exceptions/
            └ Http/
                  └ Actions/ #Single controller
                  └ Livewire/ #Livewire controller
                  └ Requests/ #validation check
            └ Jobs/
            └ Mail/
            └ Models/
            └ Providers/
                        └ AppServiceProvider/ #define singleton to Services
            └ Services/
                       └ Impl/ #Interface with Service
                       └ #Services with Actions Controller 
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
        ┣tests #unit test
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

role ['admin', 'manager', 'user']

```php
#admin
url : 'app-url/login/'
user : admin@admin.admin
pass : password

#manager
url : 'app-url/login/'
user : manager@manager.manager
pass : password

#user
url : 'app-url/login/'
user : user@user.user
pass : password

```
