@extends("layout.app")

@section("content")
<h1>Edit Task</h1>

<form action="{{route("tasks.update", $task->id)}}" method="POST">
    @csrf
    @method("PUT")
    <input type="text" name="title" value="{{$task->title}}">
    <input type="text" name="description" value="{{$task->description}}">
    <button type="submit">Update</button>
</form>
@endsection

