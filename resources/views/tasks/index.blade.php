@extends('layout')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-3">
    <span style="font-size:13px; color:#639922;">
        {{ $tasks->count() }} task(s) found
    </span>
    <a href="{{ route('tasks.create') }}" class="btn-add">+ Add Task</a>
</div>

<table class="table table-borderless">
    <thead>
        <tr>
            <th style="width:40px; color:#639922; font-size:12px; text-transform:uppercase;">#</th>
            <th style="color:#639922; font-size:12px; text-transform:uppercase;">Task Name</th>
            <th style="width:100px; color:#639922; font-size:12px; text-transform:uppercase;">Priority</th>
            <th style="width:120px; color:#639922; font-size:12px; text-transform:uppercase;">Deadline</th>
            <th style="width:140px; color:#639922; font-size:12px; text-transform:uppercase;">Actions</th>
        </tr>
    </thead>
    <tbody>
        @forelse($tasks as $index => $task)
        <tr style="border-top: 1px solid rgba(99,153,34,0.1);">
            <td style="color:#2C3A1E; vertical-align:middle;">{{ $index + 1 }}.</td>
            <td style="color:#2C3A1E; vertical-align:middle; max-width:300px; overflow:hidden; text-overflow:ellipsis; white-space:nowrap;">
                {{ $task->task_name }}
            </td>
            <td style="vertical-align:middle;">
                @if($task->priority == 'High')
                    <span class="badge-high">High</span>
                @elseif($task->priority == 'Medium')
                    <span class="badge-medium">Medium</span>
                @else
                    <span class="badge-low">Low</span>
                @endif
            </td>
            <td style="color:#2C3A1E; vertical-align:middle; white-space:nowrap;">
                {{ $task->deadline }}
            </td>
            <td style="vertical-align:middle;">
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