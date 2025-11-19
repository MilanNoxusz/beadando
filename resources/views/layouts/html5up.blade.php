<!doctype html>
<html lang="{{ str_replace('', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>@yield('title', config('app.name'))</title>
    <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}" />
    <noscript><link rel="stylesheet" href="{{ asset('assets/css/noscript.css') }}" /></noscript>
    @stack('head')
</head>
<body class="@yield('body_class', 'is-preload')">

    @yield('content')

    <script src="{{ asset('assets/js/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.scrollex.min.js') }}"></script>
    <script src="{{ asset('assets/js/browser.min.js') }}"></script>
    <script src="{{ asset('assets/js/breakpoints.min.js') }}"></script>
    <script src="{{ asset('assets/js/util.js') }}"></script>
    <script src="{{ asset('assets/js/main.js') }}"></script>
    <script>
        // Auto-hide flash/status messages after 5 seconds
        document.addEventListener('DOMContentLoaded', function () {
            try {
                var el = document.getElementById('flash-status');
                if (el) {
                    setTimeout(function () {
                        el.style.transition = 'opacity 0.5s ease';
                        el.style.opacity = '0';
                        setTimeout(function () { if (el && el.parentNode) el.parentNode.removeChild(el); }, 500);
                    }, 5000);
                }
            } catch (e) {
                // silent
            }
        });
    </script>
    @stack('scripts')
</body>
</html>