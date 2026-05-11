@extends('layout')

@section('content')

    <div style="margin-bottom:1.25rem;">
        <p style="font-size:13px; color:#639922;">Edit the details below to update your task.</p>
    </div>

    <form action="{{ route('tasks.update', $task->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">Task Name</label>
            <input type="text" name="task_name" class="form-control" value="{{ old('task_name', $task->task_name) }}">
            @error('task_name')
                <span style="font-size:11px; color:#A32D2D;">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Priority</label>
            <select name="priority" class="form-select">
                <option value="">-- Select Priority --</option>
                <option value="Low" {{ old('priority', $task->priority) == 'Low' ? 'selected' : '' }}>Low</option>
                <option value="Medium" {{ old('priority', $task->priority) == 'Medium' ? 'selected' : '' }}>Medium</option>
                <option value="High" {{ old('priority', $task->priority) == 'High' ? 'selected' : '' }}>High</option>
            </select>
            @error('priority')
                <span style="font-size:11px; color:#A32D2D;">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Deadline</label>
            <input type="date" name="deadline" class="form-control" value="{{ old('deadline', $task->deadline) }}">
            @error('deadline')
                <span style="font-size:11px; color:#A32D2D;">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-4">
            <label class="form-label">Status</label>
            <select name="status" class="form-select">
                <option value="">-- Select Status --</option>
                <option value="todo" {{ old('status', $task->status) == 'todo' ? 'selected' : '' }}>To Do</option>
                <option value="in_progress" {{ old('status', $task->status) == 'in_progress' ? 'selected' : '' }}>In Progress
                </option>
                <option value="completed" {{ old('status', $task->status) == 'completed' ? 'selected' : '' }}>Completed
                </option>
            </select>
            @error('status')
                <span style="font-size:11px; color:#A32D2D;">{{ $message }}</span>
            @enderror
        </div>

        <div style="display:flex; gap:10px;">
            <button type="submit" class="btn-save">Update Task</button>
            <a href="{{ route('tasks.index') }}" class="btn-cancel">Cancel</a>
        </div>

    </form>

@endsection