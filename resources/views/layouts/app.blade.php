<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title') - f1-stats.com</title>
    @vite('resources/css/app.css')
</head>
<body class="max-w-full p-0">
<nav class="bg-red-600 p-3">
    <div class="flex justify-between items-center mx-auto max-w-4xl">
        <h1 class="font-bold text-2xl text-white">F1 STATS</h1>

        <div>
            <a class="text-white visited:text-white" href="{{ route('home') }}">Home</a>
            <a class="text-white visited:text-white" href="{{ route('seasons.index') }}">Seasons</a>
            <a class="text-white visited:text-white" href="{{ route('drivers.index') }}">Drivers</a>
            <a class="text-white visited:text-white" href="{{ route('circuits.index') }}">Tracks</a>
        </div>
    </div>
</nav>
<main class="max-w-4xl w-full mx-auto">
    @yield('content')
</main>
@vite('resources/js/app.js')
<script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
@stack('scripts')
</body>
</html>
