# Laravel REST API

A RESTful API implementation using Laravel, demonstrating best practices for API development.

## Features

- RESTful resource endpoints
- API authentication with Sanctum
- Request validation and form requests
- API resource transformations
- Rate limiting
- API versioning
- Error handling and consistent response format
- Comprehensive documentation

## Requirements

- PHP 8.1+
- Composer
- MySQL or other compatible database
- Postman or similar API testing tool

## Installation

1. Clone this repository
2. Navigate to the project directory: `cd Laravel\ -\ Rest-Api`
3. Install dependencies: `composer install`
4. Copy .env.example to .env: `cp .env.example .env`
5. Generate application key: `php artisan key:generate`
6. Configure your database in the .env file
7. Run migrations: `php artisan migrate`
8. Start the development server: `php artisan serve`

## API Documentation

The API endpoints are structured as follows:

```
GET    /api/resource            # List all resources
POST   /api/resource            # Create a new resource
GET    /api/resource/{id}       # Get a specific resource
PUT    /api/resource/{id}       # Update a specific resource
DELETE /api/resource/{id}       # Delete a specific resource
```

## Testing the API

You can test the API using tools like Postman, cURL, or any API testing tool.

### Example Request
```
curl -X GET http://localhost:8000/api/resource \
  -H "Content-Type: application/json" \
  -H "Accept: application/json" \
  -H "Authorization: Bearer {your_api_token}"
```

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
