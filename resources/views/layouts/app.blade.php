<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @include('partials._head')
</head>
<body class="font-sans text-gray-900">
    <div id="app">

        @include('partials._navbar')

        <main class="py-4 container">
            @yield('content')
        </main>

        @include('partials._scripts')

    </div>
</body>
</html>
