# Laravel Products Project with Bootstrap

This guide explains how to create a Laravel project that displays a list of products using Bootstrap.

## Setup Steps

### 1. Create a new Laravel project

```bash
composer create-project laravel/laravel Laravel-Products
cd Laravel-Products
```

### 2. Create the Product Model, Migration, Controller, and Factory

```bash
php artisan make:model Product -mcrf
```

This command creates:
- Product model
- Product migration
- ProductController
- ProductFactory
- ProductSeeder

### 3. Setup the Product Migration

Edit the migration file in `database/migrations/*_create_products_table.php`:

```php
public function up(): void
{
    Schema::create('products', function (Blueprint $table) {
        $table->id();
        $table->string('title');
        $table->string('brand');
        $table->double('price');
        $table->string('image');
        $table->text('description');
        $table->foreignId('user_id')->constrained(table: 'users');
        $table->timestamps();
    });
}
```

### 4. Setup the Product Model

Edit `app/Models/Product.php`:

```php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    
    protected $fillable = ['title', 'brand', 'price', 'image', 'description', 'user_id'];
}
```

### 5. Setup the ProductFactory

Edit `database/factories/ProductFactory.php`:

```php
<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    public function definition(): array
    {
        return [
            'title' => fake()->sentence(),
            'brand' => fake()->word(),
            'price' => fake()->numberBetween(100,1000),
            'description' => fake()->paragraph(5),
            'image' => 'product.png',
            'user_id' => function () {
                return User::all()->random();
            }
        ];
    }
}
```

### 6. Configure the DatabaseSeeder

Edit `database/seeders/DatabaseSeeder.php`:

```php
<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Product;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::factory(5)->create();
        Product::factory(50)->create();
    }
}
```

### 7. Run Migrations and Seed the Database

```bash
php artisan migrate
php artisan db:seed
```

### 8. Create the Layout Template with Bootstrap

Create `resources/views/layouts/app.blade.php`:

```php
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>We Store | @yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container">
            <a class="navbar-brand" href="/"><img src="{{ asset('images/logo.png') }}" alt="Logo" height="50"></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" href="/">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Products</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Add Product</a>
                    </li>
                </ul>
                <form class="d-flex" role="search">
                    <input class="form-control me-2" type="search" placeholder="Search">
                    <button class="btn btn-outline-primary" type="submit">Search</button>
                </form>
            </div>
        </div>
    </nav>

    <div class="container py-5">
        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
```

### 9. Create the Home View with Bootstrap Classes

Create `resources/views/home.blade.php`:

```php
@extends('layouts.app')

@section('title', 'Home')

@section('content')
    <h1 class="text-center mb-3">All Products</h1>
    
    @foreach ($products as $product)
        <div class="card p-3 mb-3">
            <h5 class="card-header">Product: {{ $product->id }} - {{ $product->created_at->format('Y-m-d') }}</h5>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-3">
                        <img src="{{ asset($product->image) }}" alt="{{ $product->title }}" class="img-fluid rounded">
                    </div>
                    <div class="col-md-9">
                        <h3 class="card-title">{{ $product->title }}</h3>
                        <h5 class="card-title text-muted">{{ $product->brand }}</h5>
                        <p class="card-text">{{ \Str::limit($product->description, 100) }}</p>
                        <a href="#" class="btn btn-primary">detail</a>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
    
    <div class="d-flex justify-content-center mt-4">
        {{ $products->links() }}
    </div>
@endsection
```

### 10. Create the ProductController Method

Edit `app/Http/Controllers/ProductController.php` to add the home method:

```php
public function home()
{
    $products = Product::paginate(5);
    return view("home", ["products" => $products]);
}
```

### 11. Configure the Routes

Edit `routes/web.php`:

```php
<?php

use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::get('/', [ProductController::class, 'home'])->name('home');
```

### 12. Configure Pagination in AppServiceProvider

Edit `app/Providers/AppServiceProvider.php`:

```php
<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        Paginator::useBootstrap();
    }
}
```

### 13. Create Images Directory and Add Images

```bash
mkdir -p public/images
```

Add product.png and logo.png to the public/images directory.

### 14. Start the Application

```bash
php artisan serve
```

Visit http://localhost:8000 to see your application in action!

## Key Features

1. Uses Bootstrap 5 for styling
2. Responsive design with Bootstrap grid system
3. Bootstrap navigation bar
4. Bootstrap cards for product display
5. Bootstrap pagination styling

All functionality is enhanced by Bootstrap's built-in features, providing a clean and modern user interface with minimal custom code. 