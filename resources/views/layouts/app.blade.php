<!doctype html>
<html lang="hu">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Autók') – {{ config('app.name', 'Laravel') }}</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=archivo:400,500,600,700,800" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen">
    @include('layouts.navigation')

    <main class="mx-auto max-w-6xl px-4 py-8 sm:px-6 sm:py-10">
        @if ($msg = session('success') ?? session('status'))
            <div role="status" class="mb-6 rounded-lg border border-eu/20 bg-eu/10 px-4 py-3 text-sm font-semibold text-eu">{{ $msg }}</div>
        @endif

        @yield('content')
    </main>

    <footer class="mx-auto max-w-6xl px-4 pb-8 text-sm text-asphalt/50 sm:px-6">
        {{ config('app.name', 'Laravel') }} · Autógyártók és modellek nyilvántartása
    </footer>
</body>
</html>
