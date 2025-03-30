<?php
namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class TaskController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $status = $request->query('status'); // Get the status from the query string
    
        // Paginate tasks, filter by status if provided, 4 records per page
        $tasks = Task::when($status, function ($query, $status) {
            return $query->where('status', $status);
        })
        ->orderBy('created_at', 'desc') // Optionally, order tasks by created date
        ->paginate(4); // 4 tasks per page
    
        // Check if it's an AJAX request (for infinite scroll)
        if ($request->ajax()) {
            return response()->json([
                'tasks' => $tasks->items(),
                'next_page' => $tasks->currentPage() + 1, // next page number
                'last_page' => $tasks->lastPage(), // total number of pages
            ]);
        }
    
        return view('tasks.index', compact('tasks', 'status'));
    }
    


    public function create()
    {
        return view('tasks.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'due_date' => ['required', 'date', 'after_or_equal:today'],
            'status' => ['required', Rule::in(['pending', 'in_progress', 'completed'])],
        ]);

        Task::create($validatedData);
        return redirect()->route('tasks.index')->with('success', 'Task created successfully.');
    }

    public function edit(Task $task)
    {
        return view('tasks.edit', compact('task'));
    }

    public function update(Request $request, Task $task)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'due_date' => ['required', 'date', 'after_or_equal:today'],
            'status' => ['required', Rule::in(['pending', 'in_progress', 'completed'])],
        ]);

        $task->update($validatedData);
        return redirect()->route('tasks.index')->with('success', 'Task updated successfully.');
    }

    public function destroy(Task $task)
    {
        try {
            // Delete the task
            $task->delete();
    
            return response()->json(['message' => 'Task deleted successfully']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to delete task'], 500);
        }
    }

    public function updateStatus(Request $request, Task $task)
{
    $request->validate([
        'status' => 'required|in:pending,in_progress,completed',
    ]);

    $task->status = $request->status;
    $task->save();

    return response()->json(['success' => true, 'message' => 'Task status updated successfully']);
}
}
