<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- Add your stylesheets, scripts, and other head elements here -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    <div id="app">
        @include('layouts.partials.navigation')

        <main class="py-4">
            @yield('content')
        </main>
    </div>

    <!-- Add your scripts and other body elements here -->
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
