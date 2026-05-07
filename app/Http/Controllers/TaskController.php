<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;

class TaskController extends Controller
{
    public function index(Request $request)
    {
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
        return redirect()->route('tasks.index');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string',
            'due_date'    => 'nullable|date',
            'priority_id' => 'required|integer|exists:priorities,id',
        ]);

        Task::create([
            'user_id'     => null,
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
        return view('tasks.edit', compact('task'));
    }

    public function update(Request $request, Task $task)
    {
        $validated = $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string',
            'due_date'    => 'nullable|date',
            'priority_id' => 'required|integer|exists:priorities,id',
            'status'      => 'required|in:pending,in progress,completed',
        ]);

        $task->update($validated);

        return redirect()->route('tasks.index');
    }

    public function destroy(Task $task)
    {
        $task->delete();
        return redirect()->route('tasks.index');
    }

    // ── Toggle Status ──────────────────────────────────────
    public function toggle(Task $task)
    {
        $task->update([
            'status' => $task->status === 'completed' ? 'pending' : 'completed'
        ]);

        return back();
    }
}