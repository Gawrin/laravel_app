<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&display=swap" rel="stylesheet">
    @if(request()->routeIs('tasks.index'))
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    @endif
</head>
<body class="bg-background text-surface min-h-screen font-montserrat">
    <div class="container mx-auto px-4 py-8">
        @yield('content')
    </div>

    @stack('scripts')
</body>
</html>