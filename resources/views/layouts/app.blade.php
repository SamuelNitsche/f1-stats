<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title') - f1-stats.com</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/simple.min.css') }}">
</head>
<body class="max-w-full p-0">
<nav class="bg-red-600 p-3">
    <div class="mx-auto max-w-max">
        <a class="text-white visited:text-white" href="{{ route('home') }}">Home</a>
        <a class="text-white visited:text-white" href="{{ route('seasons.index') }}">Seasons</a>
        <a class="text-white visited:text-white" href="{{ route('drivers.index') }}">Drivers</a>
        <a class="text-white visited:text-white" href="{{ route('tracks.index') }}">Tracks</a>
    </div>
</nav>
<main class="max-w-4xl w-full mx-auto">
    @yield('content')
</main>
</body>
</html>
