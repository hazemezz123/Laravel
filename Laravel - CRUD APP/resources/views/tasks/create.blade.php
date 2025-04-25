@extends("layout.app")

@section("content")
<h1>Create Task</h1>
<form action="{{route("tasks.store")}}" method="post">
    @csrf
    <input type="text" name="title" placeholder="Title">
    <input type="text" name="description" placeholder="Description">
    <button type="submit">Create</button>
</form>

@endsection

