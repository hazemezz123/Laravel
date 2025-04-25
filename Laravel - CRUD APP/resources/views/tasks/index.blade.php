@extends("layout.app")


@section("content")
<h1>Tasks</h1>
<ul>
    @forelse($tasks as $task)
    <li>
        <h2>{{$task->title}}</h2>
        <p>{{$task->description}}</p>
        <a href="{{route("tasks.edit", $task->id)}}">Edit</a>
      <a href="{{route("tasks.show" , $task->id)}}">Show</a>
    </li>
    <form action="{{route("tasks.destroy", $task->id)}}" method="POST">
        @csrf
        @method("DELETE")
        <button type="submit">delete</button>
    </form>
    @empty
    <li>No tasks found</li>
    @endforelse
</ul>
@endsection
