<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
</head>
<body class="font-sans antialiased">
<div class="min-h-screen bg-gray-900">
@include('layouts.navigation')

<!-- Page Heading -->
    <header class="bg-white shadow">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8 ">
            {{ $header }}
        </div>
    </header>
    @if(session('message'))
        <div class="flex  bg-white shadow-lg rounded-lg overflow-hidden border-4 border-blue-500 border-dashed">
            <div class="flex items-center px-2 py-3">
                <div class="mx-3 ">
                    <p class="text-gray-600">{{session('message')}} </p>
                </div>
            </div>
        </div>
@endif

<!-- Page Content -->
    <main>
        {{ $slot }}
    </main>
</div>

<meta name="csrf-token" content="{{ csrf_token() }}">
@include('components.notification-card')
<script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
<script src="{{ asset('js/app.js') }}"></script>
<script>
    function closeMessage() {
        message.__x.$data.showMessage = false;
    }

    Echo.private('App.Models.User.{{Auth::user()->id}}')
        .notification((notification) => {
            console.log(notification.message);
        });

    Echo.private('App.Models.User.{{Auth::user()->id}}').notification((notification) => {
        let message = document.getElementById('message');
        message.__x.$data.showMessage = true;
        message.__x.$data.message = notification.message;

        setTimeout(function () {
            closeMessage()
        }, 10000);
    });

</script>
</body>
</html>
