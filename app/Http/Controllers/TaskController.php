<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; 
use App\Models\Task;

class TaskController extends Controller
{
    
    private function checkAuth()
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }
        return null;
    }

    public function index(Request $request)
    {
        if ($redirect = $this->checkAuth()) return $redirect; 

        $tasks = Task::with('priority')
                     ->when($request->search, fn($q) =>
                         $q->where('title', 'like', '%' . $request->search . '%')
                     )
                     ->latest()
                     ->get();

        return view('tasks.index', compact('tasks'))->with('pageTitle', 'All Tasks');
    }

    public function today(Request $request)
    {
        if ($redirect = $this->checkAuth()) return $redirect; // ← ADD

        $tasks = Task::with('priority')
                     ->whereDate('due_date', today())
                     ->when($request->search, fn($q) =>
                         $q->where('title', 'like', '%' . $request->search . '%')
                     )
                     ->latest()
                     ->get();

        return view('tasks.index', compact('tasks'))->with('pageTitle', "Today's Tasks");
    }

    public function upcoming(Request $request)
    {
        if ($redirect = $this->checkAuth()) return $redirect; // ← ADD

        $tasks = Task::with('priority')
                     ->whereDate('due_date', '>', today())
                     ->where('status', '!=', 'completed')
                     ->when($request->search, fn($q) =>
                         $q->where('title', 'like', '%' . $request->search . '%')
                     )
                     ->latest()
                     ->get();

        return view('tasks.index', compact('tasks'))->with('pageTitle', 'Upcoming Tasks');
    }

    public function completed(Request $request)
    {
        if ($redirect = $this->checkAuth()) return $redirect; // ← ADD

        $tasks = Task::with('priority')
                     ->where('status', 'completed')
                     ->when($request->search, fn($q) =>
                         $q->where('title', 'like', '%' . $request->search . '%')
                     )
                     ->latest()
                     ->get();

        return view('tasks.index', compact('tasks'))->with('pageTitle', 'Completed Tasks');
    }

    public function overdue(Request $request)
    {
        if ($redirect = $this->checkAuth()) return $redirect; // ← ADD

        $tasks = Task::with('priority')
                     ->whereDate('due_date', '<', today())
                     ->where('status', '!=', 'completed')
                     ->when($request->search, fn($q) =>
                         $q->where('title', 'like', '%' . $request->search . '%')
                     )
                     ->latest()
                     ->get();

        return view('tasks.index', compact('tasks'))->with('pageTitle', 'Overdue Tasks');
    }

    public function create()
    {
        if ($redirect = $this->checkAuth()) return $redirect; // ← ADD

        return redirect()->route('tasks.index');
    }

    public function store(Request $request)
    {
        if ($redirect = $this->checkAuth()) return $redirect; // ← ADD

        $validated = $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string',
            'due_date'    => 'nullable|date',
            'priority_id' => 'required|in:1,2,3',
        ]);

        Task::create([
            'user_id'     => Auth::id(), // ← UPDATED (was null)
            'title'       => $validated['title'],
            'description' => $validated['description'] ?? null,
            'due_date'    => $validated['due_date'] ?? null,
            'status'      => 'pending',
            'priority_id' => $validated['priority_id'],
        ]);

        return redirect()->route('tasks.index');
    }

    public function edit(Task $task)
    {
        if ($redirect = $this->checkAuth()) return $redirect; // ← ADD

        return view('tasks.edit', compact('task'));
    }

    public function update(Request $request, Task $task)
    {
        if ($redirect = $this->checkAuth()) return $redirect; // ← ADD

        $validated = $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string',
            'due_date'    => 'nullable|date',
            'priority_id' => 'required|in:1,2,3',
        ]);

        $task->update($validated);

        return redirect()->route('tasks.index');
    }

    public function destroy(Task $task)
    {
        if ($redirect = $this->checkAuth()) return $redirect; // ← ADD

        $task->delete();
        return redirect()->route('tasks.index');
    }

    public function toggle(Task $task)
    {
        if ($redirect = $this->checkAuth()) return $redirect; // ← ADD

        $task->update([
            'status' => $task->status === 'completed' ? 'pending' : 'completed'
        ]);

        return back();
    }
}