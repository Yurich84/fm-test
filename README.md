<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

## Install

- `git clone git@github.com:Yurich84/fm-test.git`
- `cd core-commerce-test`


- `composer install-app` - this will deploy project

or deploy it manually

- `cp .env.example .env`
- `touch database/database.sqlite`
- `composer install`
- `php artisan key:generate`
- `php artisan migrate`

## Testing

- `php artisan test`

## Run

- `php artisan serv`
- `php artisan queue:work`
- `npm run dev`

go to http://localhost:8000
