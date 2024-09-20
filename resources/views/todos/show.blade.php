<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Show Todo</title>
</head>
<body>
    <h1>Todo Details</h1>

    <p><strong>Task:</strong> {{ $todo->task }}</p>
    <p><strong>Status:</strong> {{ $todo->completed ? 'Completed' : 'Pending' }}</p>

    <a href="{{ route('todos.edit', $todo) }}">Edit</a>
    <form action="{{ route('todos.destroy', $todo) }}" method="POST" style="display:inline;">
        @csrf
        @method('DELETE')
        <button type="submit">Delete</button>
    </form>

    <a href="{{ route('todos.index') }}">Back to Todo List</a>
</body>
</html>
