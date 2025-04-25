# Laravel 11 REST API - Complete Build Guide

This guide provides step-by-step instructions for building a Laravel 11 REST API from scratch. Follow these instructions to create a fully functional API for managing projects.

## Step 1: Create a New Laravel Project

```bash
# Create a new Laravel project
composer create-project laravel/laravel laravel-12-rest-api

# Navigate to the project directory
cd laravel-11-rest-api
```

## Step 2: Configure the Database

1. Open the `.env` file and configure your database connection:

For MySQL:
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laravel_rest_api
DB_USERNAME=root
DB_PASSWORD=
```


## Step 3: Create the Project Model and Migration

```bash
php artisan make:model Project -m
```

This creates:
- `app/Models/Project.php` (model)
- A migration file in `database/migrations/`

## Step 4: Edit the Project Migration File

Open the created migration file (format: `yyyy_mm_dd_hhmmss_create_projects_table.php`) and add the columns:

```php
public function up(): void
{
    Schema::create('projects', function (Blueprint $table) {
        $table->id();
        $table->string('name');
        $table->string('description');
        $table->timestamps();
    });
}
```

## Step 5: Update the Project Model

Edit `app/Models/Project.php`:

```php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = [
        'name',
        'description'
    ];
}
```

## Step 6: Create the Project Controller

```bash
php artisan make:controller ProjectController --resource
```

## Step 7: Implement the ProjectController Methods

Edit `app/Http/Controllers/ProjectController.php`:

```php
<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $project = Project::all(); 
        return response()->json($project);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $project = new Project();
        $project->name = $request->name;
        $project->description = $request->description;
        $project->save();
        return response()->json($project);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $project = Project::find($id);
        return response()->json($project);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $project = Project::find($id);
        $project->name = $request->name;
        $project->description = $request->description;
        $project->save();
        return response()->json($project);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Project::destroy($id);
        return response()->json(['message' => 'Project deleted']);
    }
}
```

## Step 8: Set up API Routes

Edit `routes/api.php`:

```php
<?php

use App\Http\Controllers\ProjectController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::apiResource("projects", ProjectController::class);
```

## Step 9: Run the Migrations

```bash
php artisan migrate
```

## Step 10: Start the Development Server

```bash
php artisan serve
```

The API will be accessible at: http://localhost:8000

## Step 11: Testing Your API

You can use tools like Postman, Insomnia, or curl to test your API endpoints:

### Available API Endpoints

- **GET /api/projects** - List all projects
- **POST /api/projects** - Create a new project
- **GET /api/projects/{id}** - Get a specific project
- **PUT /api/projects/{id}** - Update a project
- **DELETE /api/projects/{id}** - Delete a project



## Conclusion

Congratulations! You've built a fully functional Laravel 12 REST API for managing projects. This API follows RESTful principles and provides all basic CRUD operations.

