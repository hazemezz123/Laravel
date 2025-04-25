# Simple Laravel CRUD App Guide

  

A minimal CRUD application with basic functionality and minimal styling.

  

## 1. Set Up Laravel Project

  

```bash

composer create-project laravel/laravel simple-crud

cd simple-crud

```

  

## 2. Configure Database

  

Edit `.env` file:

  

```

DB_CONNECTION=mysql

DB_HOST=127.0.0.1

DB_PORT=3306

DB_DATABASE=simple_crud

DB_USERNAME=root

DB_PASSWORD=

```

  

## 3. Create Task Migration

  

```bash

php artisan make:migration create_tasks_table

```

  

Edit `database/migrations/*_create_tasks_table.php`:

  

```php

<?php

  

use Illuminate\Database\Migrations\Migration;

use Illuminate\Database\Schema\Blueprint;

use Illuminate\Support\Facades\Schema;

  

return new class extends Migration

{

    public function up(): void

    {

        Schema::create('tasks', function (Blueprint $table) {

            $table->id();

            $table->string('title');

            $table->text('description')->nullable();

            $table->timestamps();

        });

    }

  

    public function down(): void

    {

        Schema::dropIfExists('tasks');

    }

};

```

  

## 4. Create Task Model

  

```bash

php artisan make:model Task

```

  

Edit `app/Models/Task.php`:

  

```php

<?php

  

namespace App\Models;

  

use Illuminate\Database\Eloquent\Model;

  

class Task extends Model

{

    protected $fillable = ['title', 'description'];

}

```

  

## 5. Create Task Controller

  

```bash

php artisan make:controller TaskController --resource

```

  

Edit `app/Http/Controllers/TaskController.php`:

  

```php

<?php

  

namespace App\Http\Controllers;

  

use App\Models\Task;

use Illuminate\Http\Request;

  

class TaskController extends Controller

{

    public function index()

    {

        $tasks = Task::all();

        return view('tasks.index', compact('tasks'));

    }

  

    public function create()

    {

        return view('tasks.create');

    }

  

    public function store(Request $request)

    {

        Task::create($request->all());

        return redirect()->route('tasks.index');

    }

  

    public function show(Task $task)

    {

        return view('tasks.show', compact('task'));

    }

  

    public function edit(Task $task)

    {

        return view('tasks.edit', compact('task'));

    }

  

    public function update(Request $request, Task $task)

    {

        $task->update($request->all());

        return redirect()->route('tasks.index');

    }

  

    public function destroy(Task $task)

    {

        $task->delete();

        return redirect()->route('tasks.index');

    }

}

```

  

## 6. Set Up Routes

  

Edit `routes/web.php`:

  

```php

<?php

  

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\TaskController;

  

Route::resource('tasks', TaskController::class);

```

  

## 7. Create Views

  

### Layout (resources/views/layouts/app.blade.php)

  

```php

<!DOCTYPE html>

<html>

<head>

    <title>Simple Task Manager</title>

    <style>

        body { font-family: Arial; max-width: 800px; margin: 0 auto; padding: 20px; }

        .nav { margin-bottom: 20px; }

        .nav a { margin-right: 10px; }

        table { width: 100%; border-collapse: collapse; }

        th, td { padding: 8px; border: 1px solid #ddd; }

        form { margin: 20px 0; }

        input, textarea { width: 100%; padding: 8px; margin: 5px 0; }

        button { padding: 8px 15px; }

    </style>

</head>

<body>

    <div class="nav">

        <a href="{{ route('tasks.index') }}">Tasks</a>

        <a href="{{ route('tasks.create') }}">New Task</a>

    </div>

    @yield('content')

</body>

</html>

```

  

### Index View (resources/views/tasks/index.blade.php)

  

```php

@extends('layouts.app')

  

@section('content')

    <h1>Tasks</h1>

    <table>

        <tr>

            <th>Title</th>

            <th>Actions</th>

        </tr>

        @forelse($tasks as $task)

            <tr>

                <td>{{ $task->title }}</td>

                <td>

                    <a href="{{ route('tasks.show', $task->id) }}">View</a>

                    <a href="{{ route('tasks.edit', $task->id) }}">Edit</a>

                    <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" style="display:inline">

                        @csrf

                        @method('DELETE')

                        <button type="submit">Delete</button>

                    </form>

                </td>

            </tr>

        @empty

            <tr><td colspan="2">No tasks found</td></tr>

        @endforelse

    </table>

@endsection

```

  

### Create View (resources/views/tasks/create.blade.php)

  

```php

@extends('layouts.app')

  

@section('content')

    <h1>Create Task</h1>

    <form action="{{ route('tasks.store') }}" method="POST">

        @csrf

        <input type="text" name="title" placeholder="Task Title" required>

        <textarea name="description" placeholder="Description"></textarea>

        <button type="submit">Create</button>

    </form>

@endsection

```

  

### Edit View (resources/views/tasks/edit.blade.php)

  

```php

@extends('layouts.app')

  

@section('content')

    <h1>Edit Task</h1>

    <form action="{{ route('tasks.update', $task->id) }}" method="POST">

        @csrf

        @method('PUT')

        <input type="text" name="title" value="{{ $task->title }}" required>

        <textarea name="description">{{ $task->description }}</textarea>

        <button type="submit">Update</button>

    </form>

@endsection

```

  

### Show View (resources/views/tasks/show.blade.php)

  

```php

@extends('layouts.app')

  

@section('content')

    <h1>{{ $task->title }}</h1>

    <p>{{ $task->description ?? 'No description' }}</p>

    <a href="{{ route('tasks.edit', $task->id) }}">Edit</a>

    <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" style="display:inline">

        @csrf

        @method('DELETE')

        <button type="submit">Delete</button>

    </form>

@endsection

```

  

## 8. Run Migrations

  

```bash

php artisan migrate

```

  

## 9. Start Server

  

```bash

php artisan serve

```

  

## 10. Test the App

  

1. Visit http://localhost:8000/tasks

2. Create, view, edit, and delete tasks

  

## Features

  

-   Simple CRUD operations

-   Minimal styling

-   Basic form validation

-   Clean and straightforward interface