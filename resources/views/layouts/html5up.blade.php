<!doctype html>
<html lang="{{ str_replace('', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>@yield('title', config('app.name'))</title>
    <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}" />
    <noscript><link rel="stylesheet" href="{{ asset('assets/css/noscript.css') }}" /></noscript>
    <style>
        input[type="text"], input[type="password"], input[type="email"], 
        input[type="tel"], input[type="number"], input[type="date"], 
        select, textarea {
            background-color: #ffffff !important;
            color: #222222 !important;
            font-weight: 600;
        }
        
        ::placeholder {
            color: #777777 !important;
            opacity: 1;
        }
        
        select {
            background-image: url("data:image/svg+xml;charset=utf8,%3Csvg xmlns='http://www.w3.org/2000/svg' width='40' height='40' preserveAspectRatio='none' viewBox='0 0 40 40'%3E%3Cpath d='M9.4,12.3l10.4,10.4l10.4-10.4c0.2-0.2,0.5-0.4,0.9-0.4c0.3,0,0.6,0.1,0.9,0.4l3.3,3.3c0.2,0.2,0.4,0.5,0.4,0.9 c0,0.4-0.1,0.6-0.4,0.9L20.7,31.9c-0.2,0.2-0.5,0.4-0.9,0.4c-0.3,0-0.6-0.1-0.9-0.4L4.3,17.3c-0.2-0.2-0.4-0.5-0.4-0.9 c0-0.4,0.1-0.6,0.4-0.9l3.3-3.3c0.2-0.2,0.5-0.4,0.9-0.4S9.1,12.1,9.4,12.3z' fill='%23222222' /%3E%3C/svg%3E") !important;
        }
    </style>
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