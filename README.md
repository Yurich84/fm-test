<p align="center">
<img height="80" src="https://laravel.com/img/logomark.min.svg">
<img height="80" src="https://vuejs.org/images/logo.png" alt="Vue logo">
<img height="80" src="https://cdn.worldvectorlogo.com/logos/element-ui-1.svg">
</p>

## Extensions

- [Laravel 10](https://laravel.com/)
- [Vue3 Composition Api](https://vuejs.org)
- [ElementPlus](https://element-plus.org/)

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
