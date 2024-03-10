<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title') - f1-stats.com</title>
    @vite('resources/css/app.css')
    @bukStyles
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,500;0,600;0,700;0,900;1,500;1,600;1,700;1,900&display=swap" rel="stylesheet">
    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css"
    />
    @yield('styles')
</head>

<body class="max-w-full p-0 font-body">
    <nav class="bg-red-600 p-3">
        <div class="flex justify-between items-center mx-auto max-w-4xl">
            <h1 class="font-bold text-2xl text-white italic">
                <a href="{{ route('home') }}">F1 STATS</a>
            </h1>

            <div>
                <a class="font-bold text-white visited:text-white" href="{{ route('home') }}">Home</a>
                <a class="font-bold text-white visited:text-white" href="{{ route('seasons.index') }}">Seasons</a>
                <a class="font-bold text-white visited:text-white" href="{{ route('drivers.index') }}">Drivers</a>
                <a class="font-bold text-white visited:text-white" href="{{ route('circuits.index') }}">Tracks</a>
            </div>
        </div>
    </nav>
    <main class="max-w-4xl w-full mx-auto">
        @yield('content')
    </main>
    @vite('resources/js/app.js')
    @bukScripts
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>

    <script>
        // Get all elements with a data-date attribute
        const elements = document.querySelectorAll('[data-date]')
        // Loop through each element
        elements.forEach((element) => {
            // Get the date from the data-date attribute and create a new Date object using Date.UTC
            const rawDate = element.getAttribute('data-date');
            const year = rawDate.substring(0, 4);
            const month = rawDate.substring(5, 7) - 1;
            const day = rawDate.substring(8, 10);
            const hour = rawDate.substring(11, 13);
            const minute = rawDate.substring(14, 16);

            // Create a new Date object and format the date using toLocaleString. Also display the timezone
            const date = new Date(Date.UTC(year, month, day, hour, minute));
            const formattedDate = date.toLocaleString('en-US', {
                day: 'numeric',
                month: 'short',
                year: 'numeric',
                hour: 'numeric',
                minute: 'numeric',
            });
            // Set the innerText of the element to the formatted date
            element.innerText = formattedDate;
        })
    </script>

    @stack('scripts')
</body>

</html>
