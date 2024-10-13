<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-white dark:bg-gray-800 shadow" style="margin-top: 55px">
                    <div class="max-w-8xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            @if (session('status'))
                @php
                    $alertType = session('alert-type', 'info'); // Tipo di alert, default è 'info'
                    $alertClasses = [
                        'success' => 'bg-green-100 border-green-400 text-green-700',
                        'error' => 'bg-red-100 border-red-400 text-red-700',
                        'warning' => 'bg-yellow-100 border-yellow-400 text-yellow-700',
                        'info' => 'bg-blue-100 border-blue-400 text-blue-700',
                    ];
                    $classes = $alertClasses[$alertType] ?? $alertClasses['info'];
                @endphp

                <div class="{{ $classes }} px-12 py-3 rounded relative custom_alert" role="alert">
                    <strong class="font-bold">{{ ucfirst($alertType) }}!</strong>
                    <span class="block sm:inline">{{ session('status') }}</span>
                    <span class="absolute top-0 bottom-0 right-0 px-4 py-3"></span>
                </div>
            @endif

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>

        <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>

        <script>
            // chiusura automatica degli alert dopo 5 secondi
            document.addEventListener('DOMContentLoaded', function() {
                $('.custom_alert').delay(3000).fadeOut(500);
            });
        </script>
    </body>
</html>
