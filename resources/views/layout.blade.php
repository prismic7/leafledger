<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lab6 Todo List</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f4f8f1;
        }
        .nav-pills .nav-link {
            color: #3B6D11;
            border: 1px solid #C0DD97;
            border-radius: 20px;
            padding: 6px 18px;
            font-size: 14px;
        }
        .nav-pills .nav-link.active {
            background-color: #3B6D11;
            border-color: #3B6D11;
            color: white;
        }
        .nav-pills .nav-link:hover:not(.active) {
            background-color: #EAF3DE;
        }
        .card {
            border: 0.5px solid #C0DD97;
            border-radius: 12px;
        }
        .card-header {
            background-color: #f9fcf6;
            border-bottom: 0.5px solid #EAF3DE;
            border-radius: 12px 12px 0 0 !important;
        }
        .table th {
            color: #639922;
            font-size: 12px;
            text-transform: uppercase;
            letter-spacing: 0.04em;
            font-weight: 500;
            background-color: #f9fcf6;
        }
        .table td {
            vertical-align: middle;
        }
        .table tbody tr:hover {
            background-color: #f9fcf6;
        }
        .btn-add {
            background-color: #3B6D11;
            color: white;
            border: none;
            border-radius: 8px;
            padding: 7px 18px;
            font-size: 14px;
            text-decoration: none;
            display: inline-block;
        }
        .btn-add:hover {
            background-color: #27500A;
            color: white;
        }
        .btn-update {
            background-color: #EAF3DE;
            color: #3B6D11;
            border: none;
            border-radius: 6px;
            padding: 4px 12px;
            font-size: 12px;
            text-decoration: none;
            display: inline-block;
        }
        .btn-update:hover {
            background-color: #C0DD97;
            color: #27500A;
        }
        .btn-remove {
            background-color: #FCEBEB;
            color: #A32D2D;
            border: none;
            border-radius: 6px;
            padding: 4px 12px;
            font-size: 12px;
        }
        .btn-remove:hover {
            background-color: #F7C1C1;
            color: #791F1F;
        }
        .badge-high {
            background-color: #FAECE7;
            color: #993C1D;
            padding: 4px 10px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: 500;
        }
        .badge-medium {
            background-color: #FAEEDA;
            color: #854F0B;
            padding: 4px 10px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: 500;
        }
        .badge-low {
            background-color: #EAF3DE;
            color: #3B6D11;
            padding: 4px 10px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: 500;
        }
        .form-control:focus, .form-select:focus {
            border-color: #639922;
            box-shadow: 0 0 0 3px rgba(99, 153, 34, 0.15);
        }
        .btn-save {
            background-color: #3B6D11;
            color: white;
            border: none;
            border-radius: 8px;
            padding: 8px 20px;
            font-size: 13px;
        }
        .btn-save:hover {
            background-color: #27500A;
            color: white;
        }
        .btn-cancel {
            background-color: white;
            color: #3B6D11;
            border: 1px solid #C0DD97;
            border-radius: 8px;
            padding: 8px 20px;
            font-size: 13px;
            text-decoration: none;
            display: inline-block;
        }
        .btn-cancel:hover {
            background-color: #EAF3DE;
            color: #27500A;
        }
        .form-label {
            font-size: 12px;
            color: #639922;
            text-transform: uppercase;
            letter-spacing: 0.04em;
            font-weight: 500;
            margin-bottom: 4px;
        }
    </style>
</head>
<body>

<div class="container mt-4" style="max-width: 900px;">

    <div class="mb-3">
        <h5 style="color:#27500A; font-weight:500;">My Task List</h5>
        <small style="color:#639922;">Manage and track your tasks</small>
    </div>

    @if(session('success'))
        <div class="alert" style="background-color:#EAF3DE; color:#27500A; border:0.5px solid #C0DD97; border-radius:8px;">
            {{ session('success') }}
        </div>
    @endif

    <ul class="nav nav-pills gap-2 mb-3 flex-wrap">
        <li class="nav-item">
            <a class="nav-link {{ request()->is('tasks') && !request()->has('status') ? 'active' : '' }}"
               href="{{ route('tasks.index') }}">Home</a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ request()->query('status') == 'todo' ? 'active' : '' }}"
               href="{{ route('tasks.index') }}?status=todo">To Do</a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ request()->query('status') == 'in_progress' ? 'active' : '' }}"
               href="{{ route('tasks.index') }}?status=in_progress">In Progress</a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ request()->query('status') == 'completed' ? 'active' : '' }}"
               href="{{ route('tasks.index') }}?status=completed">Completed</a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ request()->is('tasks/create') || request()->is('tasks/*/edit') ? 'active' : '' }}"
               href="{{ route('tasks.create') }}">Manage Lists</a>
        </li>
    </ul>

    @yield('content')

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>