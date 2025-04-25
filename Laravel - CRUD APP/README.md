# Laravel CRUD Application

A complete Laravel application demonstrating Create, Read, Update, and Delete operations against a database.

## Features

- User-friendly interface for managing data
- Form validation and error handling
- Database migrations and models
- Blade templating with layouts
- Resource controllers
- Authentication and authorization

## Requirements

- PHP 8.1+
- Composer
- MySQL or other compatible database
- Node.js and NPM (for frontend assets)

## Installation

1. Clone this repository
2. Navigate to the project directory: `cd Laravel\ -\ CRUD\ APP`
3. Install dependencies: `composer install`
4. Copy .env.example to .env: `cp .env.example .env`
5. Generate application key: `php artisan key:generate`
6. Configure your database in the .env file
7. Run migrations: `php artisan migrate`
8. Compile assets: `npm install && npm run dev`
9. Start the development server: `php artisan serve`

## Usage

Visit the application in your browser at `http://localhost:8000` to start using the CRUD functionality.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
