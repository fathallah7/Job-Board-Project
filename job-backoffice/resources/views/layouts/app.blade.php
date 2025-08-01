<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased">
    <div class="flex">

        {{-- Side bar || navigation  --}}
        <x-navigation />

        <div class="flex-1 min-h-screen bg-gray-100">

            <!-- Page Heading -->
            @isset($header)
                <header class="bg-white border-b border-gray-300 hidden md:hidden lg:block lg:ml-64">
                    <div class="py-6 px-4 w-full">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <!-- Page Content -->
            <main class="mt-20 md:mt-20 lg:mt-0 lg:ml-64">
                {{ $slot }}
            </main>

        </div>

    </div>
</body>

</html>