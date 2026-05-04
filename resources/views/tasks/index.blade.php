@extends('layout')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-3">
    <span style="font-size:13px; color:#639922;">
        {{ $tasks->count() }} task(s) found
    </span>
    <a href="{{ route('tasks.create') }}" class="btn-add">+ Add Task</a>
</div>

<table>
    <thead>
        <tr>
            <th>#</th>
            <th>Task Name</th>
            <th>Priority</th>
            <th>Deadline</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @forelse($tasks as $index => $task)
        <tr>
            <td>{{ $index + 1 }}.</td>
            <td>{{ $task->task_name }}</td>
            <td>
                @if($task->priority == 'High')
                    <span class="badge-high">High</span>
                @elseif($task->priority == 'Medium')
                    <span class="badge-medium">Medium</span>
                @else
                    <span class="badge-low">Low</span>
                @endif
            </td>
            <td>{{ $task->deadline }}</td>
            <td>
                <div style="display:flex; gap:6px;">
                    <a href="{{ route('tasks.edit', $task->id) }}" class="btn-update">Update</a>
                    <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn-remove"
                            onclick="return confirm('Are you sure you want to remove this task?')">
                            Remove
                        </button>
                    </form>
                </div>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="5" style="text-align:center; padding:2rem; color:#639922;">
                No tasks found.
            </td>
        </tr>
        @endforelse
    </tbody>
</table>

@endsection