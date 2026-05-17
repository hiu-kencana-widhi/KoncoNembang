<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'KoncoNembang') }}</title>
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
    <script>
        if (localStorage.getItem('theme') === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark-mode');
        } else {
            document.documentElement.classList.remove('dark-mode');
        }
    </script>
</head>
<body>
    <script>
        // Synchronize body class on the absolute earliest moment to prevent flash
        if (localStorage.getItem('theme') === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.body.classList.add('dark-mode');
        }
    </script>
    <div style="display: flex; align-items: center; justify-content: center; min-height: 100vh; width: 100%; padding: 20px; background-color: var(--bg-main); transition: background-color 0.2s ease;">
        <div class="guest-container">
            <a href="/" class="guest-logo" style="display: flex; flex-direction: column; align-items: center; gap: 10px; text-decoration: none; margin-bottom: 24px; transition: transform 0.2s ease;">
                <img src="{{ asset('image/Logo-KoncoNembang.png') }}" alt="KoncoNembang Logo" style="height: 64px; width: auto; object-fit: contain;">
                <span style="font-weight: 800; font-size: 1.6rem; color: var(--text-main); letter-spacing: -0.75px;">KoncoNembang</span>
            </a>

            <div class="guest-card">
                {{ $slot }}
            </div>
        </div>
    </div>
</body>
</html>
