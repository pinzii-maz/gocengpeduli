<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Donasi')</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-gray-100 text-gray-800 min-h-screen flex flex-col">

    <header class="bg-white shadow">
        <div class="container mx-auto px-4 py-4">
            <h1 class="text-xl font-bold">Sistem Donasi</h1>
        </div>
    </header>

    <main class="flex-grow container mx-auto px-4">
        @yield('content')
    </main>

    <footer class="bg-white shadow mt-10">
        <div class="container mx-auto px-4 py-4 text-center text-sm text-gray-500">
            &copy; {{ date('Y') }} Sistem Donasi. All rights reserved.
        </div>
    </footer>

</body>

</html>
