<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Project
This is a task administrated for [Ingotbrokers Co](https://www.ingotbrokers.com.jo/en), with pdf that explains the task [Task PDF](https://github.com/Majd-Yahia/refer-and-earn/blob/main/task.pdf)

## Prerequisite
- PHP ^8.~
- MySql
- Make sure you have the database created and match the name in .env file

## To run the project
- Git clone
- cd into directory ``` cd refer-and-earn ``` 
- run the following commands
    - ``` composer install && npm run install && npm run dev ```
    - ``` mv .env.example .env ```
    - ``` php artisan optimize: && php artisan optimize && php artisan migrate:fresh --seed ```
    - ``` php artisan server```
- Now you can see your application in [localhost](http://localhost:8000)

