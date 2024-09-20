<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Todo</title>
</head>
<body>
    <h1>Create Todo</h1>

    <form action="{{ route('todos.store') }}" method="POST">
        @csrf
        <label for="task">Task:</label>
        <input type="text" id="task" name="task" placeholder="Enter task" required>
        <button type="submit">Add Task</button>
    </form>

    <a href="{{ route('todos.index') }}">Back to Todo List</a>
</body>
</html>
