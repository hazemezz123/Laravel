<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <nav>
        <a href="/">Home</a>
        <a href="{{route("tasks.index")}}">Tasks</a>
        <a href="{{route("tasks.create")}}">Create</a>
    </nav>
    @yield("content")
</body>
</html>