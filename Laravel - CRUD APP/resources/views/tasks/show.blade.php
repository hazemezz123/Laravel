@extends("layout.app")

@section("content")
<h1>Task</h1>
<h2>{{$task->title}}</h2>
<p>{{$task->description}}</p>
<a href="{{route("tasks.index")}}">back</a>
@endsection


