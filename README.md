# Laravel CookBook

Simple recipe website project developed using Laravel 5.7

## Prerequisites

- Git
- Node.js
  - Yarn
- PHP 7.2 or above
  - Composer
- PostgreSQL 10 or above
  - DBeaver, DataGrip, or anything similar

## Project preparation

```sh
git clone https://github.com/rizalwildan/laravel-cookbook.git laravel-cookbook
cd laravel-cookbook
composer install && yarn install
cp .env.example .env
php artisan key:generate
```

## Database migration

> Make sure your `.env` database credentials are set

```sh
./scripts/migrate.sh

# or

php artisan migrate
php artisan db:seed
```

## Development server

```sh
php artisan serve
```

## Notes

- NPM scripts are duplicated for `yarn` usage
- Compile assets using `dev` on `develop` branch, `prod` on `master` branch
- Demo login `Email : superadministrator@app.com` `Password: password`
