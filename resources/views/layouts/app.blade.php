<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>KoncoNembang</title>
    <link rel="stylesheet" href="{{ asset('css/player.css') }}">
    <script>
        if (localStorage.getItem('theme') === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark-mode');
        } else {
            document.documentElement.classList.remove('dark-mode');
        }
    </script>
</head>
<body class="{{ (isset($_COOKIE['theme']) && $_COOKIE['theme'] === 'dark') || (!isset($_COOKIE['theme']) && false) ? 'dark-mode' : '' }}">
    <script>
        // Synchronize body class on the absolute earliest moment to prevent flash
        if (localStorage.getItem('theme') === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.body.classList.add('dark-mode');
        }
    </script>
    @yield('content')
    @isset($slot)
        {{ $slot }}
    @endisset
    
    <script>
        function toggleTheme() {
            if (document.body.classList.contains('dark-mode')) {
                document.documentElement.classList.remove('dark-mode');
                document.body.classList.remove('dark-mode');
                localStorage.setItem('theme', 'light');
            } else {
                document.documentElement.classList.add('dark-mode');
                document.body.classList.add('dark-mode');
                localStorage.setItem('theme', 'dark');
            }
        }
    </script>
</body>
</html>
