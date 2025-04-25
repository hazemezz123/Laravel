# Laravel Seeding Project

A Laravel project demonstrating database seeding, factories, and data generation for development and testing.

## Features

- Model factories with Faker
- Database seeders
- Relationships in factories
- Custom seeder classes
- State manipulation in factories
- Testing with seeded data

## Requirements

- PHP 8.1+
- Composer
- MySQL or other compatible database

## Installation

1. Clone this repository
2. Navigate to the project directory: `cd Laravel\ -\ Seeding`
3. Install dependencies: `composer install`
4. Copy .env.example to .env: `cp .env.example .env`
5. Generate application key: `php artisan key:generate`
6. Configure your database in the .env file
7. Run migrations: `php artisan migrate`

## Using Database Seeds

### Running Seeders

```bash
# Run all seeders
php artisan db:seed

# Run a specific seeder
php artisan db:seed --class=UserSeeder
```

### Creating Seeders

```bash
# Create a new seeder
php artisan make:seeder ProductSeeder
```

### Creating Factories

```bash
# Create a new factory
php artisan make:factory ProductFactory
```

## Example

The project includes examples of:
- Creating realistic user data
- Generating related models
- Setting up testing data
- Using states and sequences in factories

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
