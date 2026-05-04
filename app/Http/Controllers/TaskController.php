<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    // Home page
    public function index(Request $request)
    {
        $status = $request->query('status');

        if ($status) {
            $tasks = Task::where('status', $status)->get();
        } else {
            $tasks = Task::all();
        }

        return view('tasks.index', compact('tasks'));
    }

    // Show add task form
    public function create()
    {
        return view('tasks.create');
    }

    // Save new task to database
    public function store(Request $request)
    {
        $request->validate([
            'task_name' => 'required',
            'priority' => 'required',
            'deadline' => 'required|date',
            'status' => 'required',
        ]);

        Task::create($request->all());
        return redirect()->route('tasks.index')->with('success', 'Task added successfully!');
    }

    // Show edit form
    public function edit(Task $task)
    {
        return view('tasks.edit', compact('task'));
    }

    // Update task in database
    public function update(Request $request, Task $task)
    {
        $request->validate([
            'task_name' => 'required',
            'priority' => 'required',
            'deadline' => 'required|date',
            'status' => 'required',
        ]);

        $task->update($request->all());
        return redirect()->route('tasks.index')->with('success', 'Task updated successfully!');
    }

    // Delete task from database
    public function destroy(Task $task)
    {
        $task->delete();
        return redirect()->route('tasks.index')->with('success', 'Task removed successfully!');
    }
}