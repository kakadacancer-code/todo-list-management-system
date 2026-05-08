<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EditTask;

class EditTaskController extends Controller
{
    // Show form
    public function index()
    {
        return view('edit-task.edit-task');
    }


    // Save task
    public function store(Request $request)
    {
            $request->validate([
            'title' => 'required',
            'due_date' => 'required|date',
        ]);

        EditTask::create([
            'title' => $request->title,
            'description' => $request->description,
            'due_date' => $request->due_date,
            'priority' => $request->priority,
            'category' => $request->category,
            'reminder' => $request->has('reminder'),
        ]);

        return redirect('/edit-task')->with('success', 'Task added successfully!');
    }
}