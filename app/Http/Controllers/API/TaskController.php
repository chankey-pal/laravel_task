<?php
namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class TaskController extends Controller
{
    // Get all tasks
    public function index()
    {
        return response()->json(Task::all(), 200);
    }

    // Store a new task
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'due_date' => ['required', 'date', 'after:today'], // Must be a future date
            'status' => ['required', Rule::in(['pending', 'in_progress', 'completed'])], // Enum validation
        ]);

        $task = Task::create($validatedData);

        return response()->json(['message' => 'Task created successfully', 'task' => $task], 201);
    }

    // Show a single task
    public function show(Task $task)
    {
        return response()->json($task, 200);
    }

    // Update a task
    public function update(Request $request, Task $task)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'due_date' => ['required', 'date', 'after:today'],
            'status' => ['required', Rule::in(['pending', 'in_progress', 'completed'])],
        ]);

        $task->update($validatedData);

        return response()->json(['message' => 'Task updated successfully', 'task' => $task], 200);
    }

    // Delete a task
    public function destroy(Task $task)
    {
        $task->delete();
        return response()->json(['message' => 'Task deleted successfully'], 200);
    }
}
