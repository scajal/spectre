# Spectre
A company's events notification system

## About Spectre
Spectre helps your company notify its employees of an employee birthday or anniversary in the company, by sending
a formatted email to the provided email address, with the list of birthdays and anniversaries that match the
current execution date.

## Built with
* [Laravel](https://laravel.com)
* [Laravel Livewire](https://laravel-livewire.com)
* [TailwindCSS](https://tailwindcss.com)

## Getting Started

### Setup
* Clone the repo
```sh
git clone https://github.com/scajal/spectre
```

* Copy the .env file
```sh
# On Windows
copy .env.example .env

# On Linux / MacOS
cp .env.example .env
```

* Install packages and dependencies
```sh
# NPM dependencies
npm i

# Composer packages
composer install
```

* Generate secret key
```sh
php artisan key:generate
```

* Run migrations and seeds
```sh
php artisan migrate:fresh --seed
```

* Login to the app using the credentials *admin@spectre.com / admin*

* Configure your mail settings in the environment file