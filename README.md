# Spectre
Company birthdays and anniversaries notification system

## About Spectre
Spectre helps you notify your employees about birthdays and other employees anniversaries!

## Getting Started

Getting started is simple as running a few commands from the command line.

```sh
# Clone the repository
git clone https://github.com/scajal/spectre

# Create the environment file from the example
cp .env.example .env

# Generate Laravel's secret key
php artisan key:generate

# Install packages and dependencies
npm i
composer install

# Run migrations and seeds
php artisan migrate:fresh --seed
```

You're done!
Remember to configure the application settings in the environment file (such as database name, and mail configuration)

## Usage

You can access using the credentials *admin@spectre.com / admin*

Spectre provides an API for sending the corresponding notifications. It currently supports a monthly resume of events, and
a daily mail congratulating any anniversary / birthday.

* Monthly resume
    ```sh
    # The authorization header corresponds to Basic admin@spectre.com:admin
    # You can use any of the registered users.
    curl --location --request POST 'http://<spectre url>/api/mail/monthly-events' \
    --header 'Accept: application/json' \
    --header 'Authorization: Basic YWRtaW5Ac3BlY3RyZS5jb206YWRtaW4='
    ```

* Daily events
    ```sh
    # The authorization header corresponds to Basic admin@spectre.com:admin
    # You can use any of the registered users.
    curl --location --request POST 'http://<spectre url>/api/mail/daily-events' \
    --header 'Accept: application/json' \
    --header 'Authorization: Basic YWRtaW5Ac3BlY3RyZS5jb206YWRtaW4='
    ```

To give a purpose to Spectre, you should configure two cron jobs; one for the monthly events, that should run the 1st of every month
at 00:01 (for example), and another one that should run every day at 00:01 (for example).

## License

Distributed under the MIT License. See `LICENSE` for more information.

## Built with

Built with ❤ using [Laravel 8](https://laravel.com), [Livewire](https://laravel-livewire.com) and [Tailwind](https://tailwindcss.com)  
Thanks to [Snackbar](https://www.polonel.com/snackbar), [FontAwesome](http://fontawesome.com/), [Turbo](https://turbo.hotwire.dev) and [Animate.css](https://animate.style/)