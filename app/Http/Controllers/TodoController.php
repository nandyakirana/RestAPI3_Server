<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;

class TodoController extends Controller
{
    /**
     * Display a listing of todos.
     *
     * @return View
     */
    public function index(Request $request)
    {
        $todos = Todo::all();
        return response()->json([
            'status' => 'success',
            'data' => $todos
        ], 200);
        return view('todos.index', compact('todos'));
    }

    /**
     * Show the form for creating a new todo.
     *
     * @return View
     */
    public function create(): View
    {
        return view('todos.create');
    }

    /**
     * Store a newly created todo in storage.
     *
     * @param  Request  $request
     * @return RedirectResponse
     */
    public function store(Request $request)
    {
        // $request->validate([
        //     'task' => 'required|string|max:255',
        // ]);

        $validate = Validator::make($request->all(), [
            'task' => 'required|string|max:255',
        ]);

        if ($validate->fails()) {
            return response()->json([
                'status' => 'failed',
                'message' => 'Validation Error!',
                'data' => $validate->errors(),
            ], 403);
        }

        $data = Todo::create([
            'task' => $request->task,
            'completed' => false,
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Task added',
            'data' => $data
        ], 201);

        //return redirect()->route('todos.index')->with('success', 'Task added!');
    }

    /**
     * Display the specified todo.
     *
     * @param  Todo  $todo
     * @return View
     */
    public function show(Todo $todo)
    {
        return response()->json([
            'status' => 'success',
            'data' => $todo
        ], 200);
        return view('todos.show', compact('todo'));
    }

    /**
     * Show the form for editing the specified todo.
     *
     * @param  Todo  $todo
     * @return View
     */
    public function edit(Todo $todo): View
    {
        return view('todos.edit', compact('todo'));
    }

    /**
     * Update the specified todo in storage.
     *
     * @param  Request  $request
     * @param  Todo  $todo
     * @return RedirectResponse
     */
    public function update(Request $request, Todo $todo)
    {
        // Mengubah status completed berdasarkan nilai dari tombol yang diklik
        $todo->completed = $request->completed; // Menggunakan nilai yang di-passing dari form
        $todo->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Task status updated!',
            'data' => $todo
        ], 200);
        //return redirect()->route('todos.index')->with('success', 'Task status updated!');
    }

    /**
     * Remove the specified todo from storage.
     *
     * @param  Todo  $todo
     * @return RedirectResponse
     */
    public function destroy(Todo $todo)
    {
        $todo->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Task deleted!'
        ], 200);
        //return redirect()->route('todos.index')->with('success', 'Task deleted!');
    }
}
