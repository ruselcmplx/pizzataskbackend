## Pizza Task App

PHP, ReactJS, MySQL

Demo: https://thawing-brook-89521.herokuapp.com/

How to install:
```bash
git clone https://github.com/ruselcmplx/pizzataskbackend.git
cd pizzataskbackend
composer install
php artisan key:generate
```
Open the project with a text editor Identify .env.example on the root directory Copy .env.example and rename it to .env Change the following fields in the .env file: ``DB_DATABASE=YOUR_DB_NAME`` ``DB_USERNAME=YOUR_DB_USER`` ``DB_PASSWORD=YOUR_DB_PWD``

```bash
php artisan migrate
```
