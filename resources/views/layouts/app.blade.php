<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'SimpleTrack')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <style>
        body { background-color: #f1f3f5; }
        .nav-link:hover { background-color: rgba(255,255,255,0.1); border-radius: 6px; }
    </style>
</head>
<body>

    <div class="d-flex">

        {{-- Sidebar --}}
        <x-sidebar :counts="$counts" :productivity="$productivity" />

        {{-- Main --}}
        <div class="flex-grow-1 d-flex flex-column" style="min-height: 100vh;">

            {{-- Header --}}
            <x-header :title="$pageTitle ?? 'Tasks'" />  {{-- ← only change this line --}}

            {{-- Page Content --}}
            <div class="p-4 flex-grow-1">
                @yield('content')
            </div>

        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>