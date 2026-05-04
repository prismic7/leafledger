<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Leafledger</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            min-height: 100vh;
            background-color: #f0f7ea;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem;
            overflow-x: hidden;
        }

        canvas#grid {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
            z-index: 0;
        }

        .glass-wrapper {
            position: relative;
            z-index: 2;
            width: 100%;
            max-width: 780px;
        }

        .glass-box {
            background: rgba(255, 255, 255, 0.55);
            border: 1px solid rgba(99, 153, 34, 0.2);
            border-radius: 20px;
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            overflow: hidden;
            box-shadow: 0 4px 32px rgba(59, 109, 17, 0.07);
        }

        .glass-header {
            padding: 1.25rem 1.5rem;
            border-bottom: 1px solid rgba(99, 153, 34, 0.1);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .glass-title {
            font-size: 16px;
            font-weight: 500;
            color: #27500A;
        }

        .glass-sub {
            font-size: 12px;
            color: #639922;
            margin-top: 2px;
        }

        .tab-bar {
            display: flex;
            gap: 6px;
            padding: 1rem 1.5rem;
            flex-wrap: wrap;
            border-bottom: 1px solid rgba(99, 153, 34, 0.08);
        }

        .tab-bar a {
            padding: 5px 14px;
            border-radius: 20px;
            font-size: 12px;
            text-decoration: none;
            border: 1px solid #C0DD97;
            color: #3B6D11;
            background: rgba(255, 255, 255, 0.5);
            transition: all 0.15s;
        }

        .tab-bar a:hover {
            background: #EAF3DE;
        }

        .tab-bar a.active {
            background: #3B6D11;
            color: white;
            border-color: #3B6D11;
        }

        .glass-body {
            padding: 1.5rem;
        }

        .btn-add {
            background: #3B6D11;
            color: #EAF3DE;
            border: none;
            border-radius: 8px;
            padding: 6px 16px;
            font-size: 13px;
            text-decoration: none;
            display: inline-block;
        }

        .btn-add:hover {
            background: #27500A;
            color: #EAF3DE;
        }

        .btn-save {
            background: #3B6D11;
            color: #EAF3DE;
            border: none;
            border-radius: 8px;
            padding: 7px 20px;
            font-size: 13px;
        }

        .btn-save:hover {
            background: #27500A;
            color: #EAF3DE;
        }

        .btn-cancel {
            background: rgba(255, 255, 255, 0.5);
            color: #3B6D11;
            border: 1px solid #C0DD97;
            border-radius: 8px;
            padding: 7px 20px;
            font-size: 13px;
            text-decoration: none;
            display: inline-block;
        }

        .btn-cancel:hover {
            background: #EAF3DE;
            color: #27500A;
        }

        .btn-update {
            background: #EAF3DE;
            color: #3B6D11;
            border: 1px solid #C0DD97;
            border-radius: 6px;
            padding: 4px 12px;
            font-size: 11px;
            text-decoration: none;
            display: inline-block;
        }

        .btn-update:hover {
            background: #C0DD97;
            color: #27500A;
        }

        .btn-remove {
            background: #FCEBEB;
            color: #A32D2D;
            border: 1px solid #F7C1C1;
            border-radius: 6px;
            padding: 4px 12px;
            font-size: 11px;
        }

        .btn-remove:hover {
            background: #F7C1C1;
            color: #791F1F;
        }

        .badge-high {
            background: #FAECE7;
            color: #993C1D;
            padding: 3px 10px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: 500;
        }

        .badge-medium {
            background: #FAEEDA;
            color: #854F0B;
            padding: 3px 10px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: 500;
        }

        .badge-low {
            background: #EAF3DE;
            color: #3B6D11;
            padding: 3px 10px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: 500;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 13px;
        }

        th {
            padding: 10px 1.5rem;
            text-align: left;
            color: #639922;
            font-size: 11px;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            font-weight: 500;
            background: rgba(234, 243, 222, 0.3);
        }

        td {
            padding: 11px 1.5rem;
            color: #2C3A1E;
            border-top: 1px solid rgba(99, 153, 34, 0.07);
            vertical-align: middle;
        }

        tr:hover td {
            background: rgba(234, 243, 222, 0.3);
        }

        .form-control,
        .form-select {
            background: rgba(255, 255, 255, 0.6);
            border: 1px solid #C0DD97;
            font-size: 13px;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: #639922;
            box-shadow: 0 0 0 3px rgba(99, 153, 34, 0.15);
            background: white;
        }

        .form-label {
            font-size: 12px;
            color: #639922;
            text-transform: uppercase;
            letter-spacing: 0.04em;
            font-weight: 500;
            margin-bottom: 4px;
        }

        .alert-success-custom {
            background: #EAF3DE;
            color: #27500A;
            border: 1px solid #C0DD97;
            border-radius: 10px;
            padding: 10px 16px;
            font-size: 13px;
            margin-bottom: 1rem;
        }
    </style>
</head>

<body>

    <canvas id="grid"></canvas>

    <div class="glass-wrapper">

        @if(session('success'))
            <div class="alert-success-custom">{{ session('success') }}</div>
        @endif

        <div class="glass-box">
            <div class="glass-header">
                <div>
                    <div class="glass-title" style="display:flex; align-items:center; gap:8px;">
                        <svg width="16" height="16" viewBox="0 0 8 8" style="image-rendering:pixelated;">
                            <rect x="4" y="0" width="1" height="1" fill="#3B6D11" />
                            <rect x="3" y="1" width="3" height="1" fill="#639922" />
                            <rect x="2" y="2" width="4" height="1" fill="#97C459" />
                            <rect x="1" y="3" width="5" height="1" fill="#97C459" />
                            <rect x="2" y="4" width="4" height="1" fill="#639922" />
                            <rect x="3" y="5" width="2" height="1" fill="#3B6D11" />
                            <rect x="3" y="6" width="1" height="1" fill="#27500A" />
                            <rect x="3" y="7" width="1" height="1" fill="#27500A" />
                        </svg>
                        Leafledger
                    </div>
                    <div class="glass-sub">Manage and track your tasks</div>
                </div>
            </div>

            <div class="tab-bar">
                <a href="{{ route('tasks.index') }}"
                    class="{{ request()->is('tasks') && !request()->has('status') ? 'active' : '' }}">Home</a>
                <a href="{{ route('tasks.index') }}?status=todo"
                    class="{{ request()->query('status') == 'todo' ? 'active' : '' }}">To Do</a>
                <a href="{{ route('tasks.index') }}?status=in_progress"
                    class="{{ request()->query('status') == 'in_progress' ? 'active' : '' }}">In Progress</a>
                <a href="{{ route('tasks.index') }}?status=completed"
                    class="{{ request()->query('status') == 'completed' ? 'active' : '' }}">Completed</a>
                <a href="{{ route('tasks.index') }}?status=submitted"
                    class="{{ request()->query('status') == 'submitted' ? 'active' : '' }}">Submitted</a>
                <a href="{{ route('tasks.create') }}"
                    class="{{ request()->is('tasks/create') || request()->is('tasks/*/edit') ? 'active' : '' }}">Manage
                    Lists</a>
            </div>

            <div class="glass-body">
                @yield('content')
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        const canvas = document.getElementById('grid');
        const ctx = canvas.getContext('2d');
        let offset = 0;
        function resize() { canvas.width = window.innerWidth; canvas.height = window.innerHeight; }
        function draw() {
            ctx.clearRect(0, 0, canvas.width, canvas.height);
            const size = 40;
            const ox = offset % size;
            const oy = offset % size;
            ctx.strokeStyle = 'rgba(99,153,34,0.09)';
            ctx.lineWidth = 0.5;
            for (let x = -size + ox; x < canvas.width + size; x += size) {
                ctx.beginPath(); ctx.moveTo(x, 0); ctx.lineTo(x, canvas.height); ctx.stroke();
            }
            for (let y = -size + oy; y < canvas.height + size; y += size) {
                ctx.beginPath(); ctx.moveTo(0, y); ctx.lineTo(canvas.width, y); ctx.stroke();
            }
            for (let x = -size + ox; x < canvas.width + size; x += size) {
                for (let y = -size + oy; y < canvas.height + size; y += size) {
                    ctx.beginPath(); ctx.arc(x, y, 1.2, 0, Math.PI * 2);
                    ctx.fillStyle = 'rgba(99,153,34,0.13)'; ctx.fill();
                }
            }
            offset += 0.08;
            requestAnimationFrame(draw);
        }
        resize();
        window.addEventListener('resize', resize);
        draw();
    </script>
</body>

</html>