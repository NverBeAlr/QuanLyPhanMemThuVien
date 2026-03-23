<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @include('admin_view.layouts.partials.head')
</head>
<body>
    <div id="app">
        @include('admin_view.layouts.partials.navbar')

        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
</html>
