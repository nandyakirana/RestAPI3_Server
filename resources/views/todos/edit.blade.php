<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Todo</title>
</head>
<body>
    <h1>Edit Todo</h1>

    <form action="{{ route('todos.update', $todo) }}" method="POST">
        @csrf
        @method('PATCH')
        <label for="task">Task:</label>
        <input type="text" id="task" name="task" value="{{ $todo->task }}" required>
        <label for="completed">
            <input type="checkbox" id="completed" name="completed" {{ $todo->completed ? 'checked' : '' }}>
            Completed
        </label>
        <button type="submit">Update Task</button>
    </form>

    <a href="{{ route('todos.index') }}">Back to Todo List</a>
</body>
</html>
