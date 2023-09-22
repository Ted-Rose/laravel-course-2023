# About
Branch created to code along Udemy course: https://www.udemy.com/course/laravel-beginner-fundamentals

Provider classes setup the project telling Laravel how to behave.

# Setup
* Rename `.env.example` to `.env`
* Setup database
* `php artisan key:generate`
* `Install composer`
* `php artisan make:model Event -m`
  * Add m flag for migration
* `php artisan make:model Attendee -m`
* Update models
* `php artisan make:controller Api/AttendeeController --api`
  * --api flag creates resource controller - skips edit and create forms actions
* `php artisan make:controller Api/EventController --api`
* `php artisan migrate`
* `php artisan db:seed`

# Instructions
* Create new task by visiting http://127.0.0.1:8000/tasks/create