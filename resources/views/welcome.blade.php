<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KoncoNembang - Platform Streaming Musik Campursari & Pop Indonesia Modern</title>
    <meta name="description" content="Dengarkan ribuan lagu Campursari, Pop Jawa, dan Pop Indonesia terbaik secara instan dengan KoncoNembang. Antarmuka modern, tanpa gangguan, dan bebas ribet.">
    <link rel="icon" type="image/png" href="{{ asset('image/Logo-KoncoNembang.png') }}">
    <script>
        if (localStorage.getItem('theme') === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark-mode');
        } else {
            document.documentElement.classList.remove('dark-mode');
        }
    </script>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    
    <style>
        :root {
            --bg-main: #f8fafc;
            --bg-surface: #ffffff;
            --border-color: #e2e8f0;
            --primary: #4f46e5;
            --primary-hover: #3730a3;
            --primary-light: #f5f3ff;
            --primary-border: #e0e7ff;
            --text-main: #0f172a;
            --text-muted: #475569;
            --text-light: #94a3b8;
            --radius-sm: 8px;
            --radius-md: 12px;
            --radius-lg: 20px;
            --shadow-sm: 0 1px 2px 0 rgba(15, 23, 42, 0.05);
            --shadow-md: 0 4px 6px -1px rgba(15, 23, 42, 0.05), 0 2px 4px -2px rgba(15, 23, 42, 0.05);
            --shadow-lg: 0 10px 25px -5px rgba(79, 70, 229, 0.1), 0 8px 10px -6px rgba(79, 70, 229, 0.05);
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Plus Jakarta Sans', system-ui, -apple-system, sans-serif;
            background-color: var(--bg-main);
            color: var(--text-main);
            line-height: 1.6;
            overflow-x: hidden;
            -webkit-font-smoothing: antialiased;
        }

        /* Ambient Glow Backgrounds */
        .ambient-container {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            z-index: -2;
            overflow: hidden;
            pointer-events: none;
        }

        .ambient-glow-top {
            position: absolute;
            top: -200px;
            right: -100px;
            width: 800px;
            height: 800px;
            background: radial-gradient(circle, rgba(79, 70, 229, 0.06) 0%, rgba(79, 70, 229, 0) 70%);
            border-radius: 50%;
        }

        .ambient-glow-bottom {
            position: absolute;
            bottom: -300px;
            left: -200px;
            width: 900px;
            height: 900px;
            background: radial-gradient(circle, rgba(79, 70, 229, 0.04) 0%, rgba(79, 70, 229, 0) 70%);
            border-radius: 50%;
        }

        /* Container helper */
        .container {
            width: 100%;
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 24px;
        }

        /* Navbar Layout */
        header {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            background: rgba(248, 250, 252, 0.8);
            backdrop-filter: blur(12px);
            border-bottom: 1px solid var(--border-color);
            z-index: 1000;
            transition: all 0.3s ease;
        }

        .nav-wrapper {
            height: 72px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 12px;
            text-decoration: none;
            transition: transform 0.2s ease;
        }
        
        .brand:hover {
            transform: scale(1.02);
        }

        .brand-logo {
            height: 38px;
            width: auto;
            object-fit: contain;
        }

        .brand-name {
            font-weight: 800;
            font-size: 1.35rem;
            color: var(--text-main);
            letter-spacing: -0.5px;
        }

        .nav-actions {
            display: flex;
            align-items: center;
            gap: 16px;
        }

        .btn-text {
            color: var(--text-muted);
            text-decoration: none;
            font-weight: 600;
            font-size: 0.95rem;
            transition: all 0.2s ease;
            padding: 10px 18px;
            border-radius: var(--radius-sm);
        }

        .btn-text:hover {
            color: var(--text-main);
            background: rgba(15, 23, 42, 0.04);
        }

        .btn-primary {
            background: var(--primary);
            color: #ffffff;
            text-decoration: none;
            font-weight: 700;
            font-size: 0.95rem;
            padding: 10px 24px;
            border-radius: var(--radius-sm);
            box-shadow: 0 4px 12px rgba(79, 70, 229, 0.2);
            transition: all 0.25s cubic-bezier(0.34, 1.56, 0.64, 1);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border: none;
            cursor: pointer;
        }

        .btn-primary:hover {
            background: var(--primary-hover);
            transform: scale(1.04);
            box-shadow: 0 6px 18px rgba(79, 70, 229, 0.35);
        }

        .btn-primary:active {
            transform: scale(0.96);
        }

        .btn-secondary {
            background: #ffffff;
            color: var(--text-main);
            border: 1px solid var(--border-color);
            text-decoration: none;
            font-weight: 700;
            font-size: 0.95rem;
            padding: 10px 24px;
            border-radius: var(--radius-sm);
            box-shadow: var(--shadow-sm);
            transition: all 0.25s ease;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
        }

        .btn-secondary:hover {
            border-color: var(--text-main);
            background: var(--bg-main);
            transform: translateY(-1px);
        }

        /* Hero Section */
        .hero {
            padding-top: 140px;
            padding-bottom: 80px;
            position: relative;
        }

        .hero-grid {
            display: grid;
            grid-template-columns: 1.1fr 0.9fr;
            gap: 48px;
            align-items: center;
        }

        .hero-content {
            display: flex;
            flex-direction: column;
            align-items: flex-start;
        }

        .badge {
            background: var(--primary-light);
            color: var(--primary);
            font-weight: 700;
            font-size: 0.8rem;
            text-transform: uppercase;
            letter-spacing: 1px;
            padding: 6px 14px;
            border-radius: 50px;
            border: 1px solid var(--primary-border);
            margin-bottom: 20px;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }

        .badge-dot {
            width: 6px;
            height: 6px;
            background: var(--primary);
            border-radius: 50%;
            display: block;
            animation: pulse-dot 1.5s infinite;
        }

        @keyframes pulse-dot {
            0% { transform: scale(0.85); opacity: 0.5; }
            50% { transform: scale(1.15); opacity: 1; }
            100% { transform: scale(0.85); opacity: 0.5; }
        }

        h1 {
            font-size: 3.5rem;
            font-weight: 800;
            line-height: 1.15;
            color: var(--text-main);
            letter-spacing: -1.5px;
            margin-bottom: 20px;
        }

        h1 span {
            color: var(--primary);
            background: linear-gradient(135deg, var(--primary), #6366f1);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .hero-description {
            font-size: 1.15rem;
            color: var(--text-muted);
            margin-bottom: 32px;
            max-width: 540px;
            font-weight: 500;
        }

        .hero-actions {
            display: flex;
            align-items: center;
            gap: 16px;
            width: 100%;
        }

        /* Premium Floating Mock Player Card */
        .hero-visual {
            position: relative;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .mock-player {
            width: 100%;
            max-width: 380px;
            background: var(--bg-surface);
            border-radius: var(--radius-lg);
            border: 1px solid var(--border-color);
            box-shadow: 0 20px 40px rgba(15, 23, 42, 0.06), 0 1px 3px rgba(0, 0, 0, 0.05);
            padding: 24px;
            position: relative;
            z-index: 10;
            transition: transform 0.4s cubic-bezier(0.16, 1, 0.3, 1);
            animation: float-mock 6s ease-in-out infinite;
        }

        .mock-player:hover {
            transform: scale(1.03) translateY(-5px);
        }

        @keyframes float-mock {
            0% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-10px) rotate(1deg); }
            100% { transform: translateY(0px) rotate(0deg); }
        }

        /* CD/Vinyl Art */
        .mock-art-wrapper {
            width: 100%;
            aspect-ratio: 1;
            background: radial-gradient(circle, #2d2d30 40%, #0c0c0e 100%);
            border-radius: var(--radius-md);
            overflow: hidden;
            margin-bottom: 20px;
            position: relative;
            box-shadow: var(--shadow-md);
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .mock-art-vinyl {
            width: 80%;
            height: 80%;
            border-radius: 50%;
            background: repeating-radial-gradient(
                circle,
                #18181b,
                #18181b 4px,
                #27272a 5px,
                #27272a 6px
            );
            border: 2px solid #3f3f46;
            display: flex;
            align-items: center;
            justify-content: center;
            animation: spin-vinyl 15s linear infinite;
        }

        @keyframes spin-vinyl {
            from { transform: rotate(0deg); }
            to { transform: rotate(360deg); }
        }

        .mock-art-center {
            width: 32%;
            height: 32%;
            border-radius: 50%;
            background: var(--primary);
            border: 4px solid #ffffff;
            box-shadow: var(--shadow-sm);
        }

        .mock-title {
            font-weight: 800;
            font-size: 1.15rem;
            color: var(--text-main);
            margin-bottom: 4px;
            text-align: center;
        }

        .mock-artist {
            font-weight: 600;
            font-size: 0.85rem;
            color: var(--text-muted);
            text-align: center;
            margin-bottom: 18px;
        }

        .mock-controls {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 16px;
            margin-bottom: 18px;
        }

        .mock-btn {
            background: transparent;
            border: none;
            color: var(--text-muted);
            width: 32px;
            height: 32px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
        }

        .mock-btn-play {
            background: var(--primary);
            color: #ffffff;
            width: 44px;
            height: 44px;
            border-radius: var(--radius-sm);
            box-shadow: 0 4px 12px rgba(79, 70, 229, 0.2);
        }

        .mock-timeline {
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 0.75rem;
            color: var(--text-light);
            font-weight: 600;
        }

        .mock-bar {
            flex: 1;
            height: 4px;
            background: var(--border-color);
            border-radius: 2px;
            position: relative;
        }

        .mock-bar-fill {
            position: absolute;
            left: 0;
            top: 0;
            bottom: 0;
            width: 65%;
            background: var(--primary);
            border-radius: 2px;
        }

        .mock-bar-handle {
            position: absolute;
            left: 65%;
            top: 50%;
            transform: translate(-50%, -50%);
            width: 10px;
            height: 10px;
            background: #ffffff;
            border: 2px solid var(--primary);
            border-radius: 50%;
            box-shadow: var(--shadow-sm);
        }

        /* Features Section - Bento style */
        .features {
            padding: 80px 0;
            border-top: 1px solid var(--border-color);
            position: relative;
        }

        .section-header {
            text-align: center;
            max-width: 600px;
            margin: 0 auto 56px auto;
        }

        .section-header h2 {
            font-size: 2.2rem;
            font-weight: 800;
            color: var(--text-main);
            letter-spacing: -0.75px;
            margin-bottom: 12px;
        }

        .section-header p {
            color: var(--text-muted);
            font-size: 1.05rem;
            font-weight: 500;
        }

        .features-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 24px;
        }

        .feature-card {
            background: var(--bg-surface);
            border: 1px solid var(--border-color);
            border-radius: var(--radius-md);
            padding: 32px;
            transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            box-shadow: var(--shadow-sm);
        }

        .feature-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 24px rgba(15, 23, 42, 0.04);
            border-color: rgba(79, 70, 229, 0.2);
        }

        .icon-box {
            width: 48px;
            height: 48px;
            border-radius: var(--radius-sm);
            background: var(--primary-light);
            color: var(--primary);
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 20px;
            border: 1px solid var(--primary-border);
        }

        .icon-box svg {
            width: 24px;
            height: 24px;
        }

        .feature-card h3 {
            font-size: 1.25rem;
            font-weight: 700;
            color: var(--text-main);
            margin-bottom: 8px;
        }

        .feature-card p {
            color: var(--text-muted);
            font-size: 0.95rem;
            font-weight: 500;
        }

        /* CTA Banner */
        .cta-banner {
            padding: 80px 0;
            position: relative;
        }

        .cta-box {
            background: linear-gradient(135deg, var(--primary) 0%, #6366f1 100%);
            border-radius: var(--radius-lg);
            padding: 60px 40px;
            text-align: center;
            position: relative;
            overflow: hidden;
            box-shadow: var(--shadow-lg);
        }

        .cta-box-glow {
            position: absolute;
            top: -150px;
            left: 50%;
            transform: translateX(-50%);
            width: 500px;
            height: 500px;
            background: radial-gradient(circle, rgba(255, 255, 255, 0.15) 0%, rgba(255, 255, 255, 0) 70%);
            border-radius: 50%;
            pointer-events: none;
        }

        .cta-box h2 {
            font-size: 2.5rem;
            font-weight: 800;
            color: #ffffff;
            margin-bottom: 16px;
            letter-spacing: -1px;
            position: relative;
            z-index: 2;
        }

        .cta-box p {
            color: rgba(255, 255, 255, 0.85);
            font-size: 1.1rem;
            margin-bottom: 32px;
            max-width: 580px;
            margin-left: auto;
            margin-right: auto;
            font-weight: 500;
            position: relative;
            z-index: 2;
        }

        .cta-box .btn-white {
            background: #ffffff;
            color: var(--primary);
            text-decoration: none;
            font-weight: 800;
            font-size: 1rem;
            padding: 14px 36px;
            border-radius: var(--radius-sm);
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.15);
            transition: all 0.25s cubic-bezier(0.34, 1.56, 0.64, 1);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border: none;
            cursor: pointer;
            position: relative;
            z-index: 2;
        }

        .cta-box .btn-white:hover {
            transform: scale(1.05);
            box-shadow: 0 12px 30px rgba(0, 0, 0, 0.2);
        }

        /* Footer */
        footer {
            background: #ffffff;
            border-top: 1px solid var(--border-color);
            padding: 40px 0;
            text-align: center;
        }

        .footer-wrapper {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 16px;
        }

        .footer-logo {
            display: flex;
            align-items: center;
            gap: 10px;
            text-decoration: none;
        }

        .footer-logo-img {
            height: 30px;
            width: auto;
        }

        .footer-brand-name {
            font-weight: 800;
            font-size: 1.1rem;
            color: var(--text-main);
            letter-spacing: -0.25px;
        }

        .copyright {
            font-size: 0.85rem;
            color: var(--text-muted);
            font-weight: 500;
        }

        /* Responsive Breakpoints */
        @media (max-width: 991px) {
            h1 {
                font-size: 2.8rem;
            }

            .hero-grid {
                grid-template-columns: 1fr;
                gap: 40px;
                text-align: center;
            }

            .hero-content {
                align-items: center;
            }

            .hero-description {
                margin-left: auto;
                margin-right: auto;
            }

            .hero-actions {
                justify-content: center;
            }
        }

        @media (max-width: 767px) {
            .nav-actions .btn-text {
                display: none;
            }

            .features-grid {
                grid-template-columns: 1fr;
                gap: 16px;
            }

            .cta-box {
                padding: 40px 20px;
            }

            .cta-box h2 {
                font-size: 1.8rem;
            }
        }
        body.dark-mode {
            --bg-main: #0b0f19;
            --bg-surface: #131b2e;
            --border-color: #1e293b;
            --text-main: #f8fafc;
            --text-muted: #94a3b8;
            --text-light: #475569;
            --primary-light: rgba(99, 102, 241, 0.12);
            --primary-border: rgba(99, 102, 241, 0.25);
            --primary: #6366f1;
            --primary-hover: #818cf8;
        }

        body.dark-mode header {
            background: rgba(11, 15, 25, 0.8);
        }

        body.dark-mode footer {
            background: #131b2e;
        }

        body.dark-mode .btn-secondary {
            background: #131b2e;
            color: #f8fafc;
            border-color: #1e293b;
        }
        body.dark-mode .btn-secondary:hover {
            background: #1e293b;
            border-color: #94a3b8;
        }

        body.dark-mode .mock-player {
            background: #131b2e;
            border-color: #1e293b;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.3), 0 1px 3px rgba(0, 0, 0, 0.2);
        }

        body.dark-mode .feature-card {
            background: #131b2e;
            border-color: #1e293b;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
        }
        body.dark-mode .feature-card:hover {
            border-color: rgba(99, 102, 241, 0.4);
            box-shadow: 0 12px 24px rgba(0, 0, 0, 0.2);
        }

        /* Theme Toggle Button styling */
        .theme-btn {
            background: transparent;
            border: 1px solid var(--border-color);
            color: var(--text-muted);
            width: 38px;
            height: 38px;
            border-radius: var(--radius-sm);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .theme-btn:hover {
            color: var(--text-main);
            background: var(--bg-hover);
            border-color: var(--text-muted);
            transform: scale(1.05);
        }
        .theme-btn:active {
            transform: scale(0.95);
        }
        .theme-btn .sun-icon {
            display: none;
        }
        .theme-btn .moon-icon {
            display: block;
        }
        body.dark-mode .theme-btn .sun-icon {
            display: block;
            color: #fbbf24;
        }
        body.dark-mode .theme-btn .moon-icon {
            display: none;
        }
    </style>
</head>
<body>

    <div class="ambient-container">
        <div class="ambient-glow-top"></div>
        <div class="ambient-glow-bottom"></div>
    </div>

    <!-- Navigation Header -->
    <header>
        <div class="container">
            <div class="nav-wrapper">
                <a href="{{ route('landing') }}" class="brand">
                    <img src="{{ asset('image/Logo-KoncoNembang.png') }}" alt="KoncoNembang Logo" class="brand-logo">
                    <span class="brand-name">KoncoNembang</span>
                </a>
                
                <div class="nav-actions">
                    <!-- Theme Toggle -->
                    <button class="theme-btn" onclick="toggleTheme()" aria-label="Ubah Tema" style="margin-right: 8px;">
                        <!-- Sun Icon -->
                        <svg class="sun-icon" fill="currentColor" viewBox="0 0 24 24" width="20" height="20">
                            <path d="M12 7c-2.76 0-5 2.24-5 5s2.24 5 5 5 5-2.24 5-5-2.24-5-5-5zM2 13h2c.55 0 1-.45 1-1s-.45-1-1-1H2c-.55 0-1 .45-1 1s.45 1 1 1zm18 0h2c.55 0 1-.45 1-1s-.45-1-1-1h-2c-.55 0-1 .45-1 1s.45 1 1 1zM11 2v2c0 .55.45 1 1 1s1-.45 1-1V2c0-.55-.45-1-1-1s-1 .45-1 1zm0 18v2c0 .55.45 1 1 1s1-.45 1-1v-2c0-.55-.45-1-1-1s-1 .45-1 1zM5.99 4.58c-.39-.39-1.03-.39-1.41 0s-.39 1.03 0 1.41l1.06 1.06c.39.39 1.03.39 1.41 0s.39-1.03 0-1.41L5.99 4.58zm12.37 12.37c-.39-.39-1.03-.39-1.41 0s-.39 1.03 0 1.41l1.06 1.06c.39.39 1.03.39 1.41 0s.39-1.03 0-1.41l-1.06-1.06zm1.06-10.96c.39-.39.39-1.03 0-1.41s-1.03-.39-1.41 0l-1.06 1.06c-.39.39-.39 1.03 0 1.41s1.03.39 1.41 0l1.06-1.06zM7.05 18.01c.39-.39.39-1.03 0-1.41s-1.03-.39-1.41 0l-1.06 1.06c-.39.39-.39 1.03 0 1.41s1.03.39 1.41 0l1.06-1.06z"/>
                        </svg>
                        <!-- Moon Icon -->
                        <svg class="moon-icon" fill="currentColor" viewBox="0 0 24 24" width="20" height="20">
                            <path d="M12.3 22h-.1c-5.5 0-10-4.5-10-10C2.2 6.8 6.4 2.5 11.8 2c.5-.1 1 .3.9.8-.1.4-.4.8-.8.9-3.7.8-6.2 4-6.2 7.8 0 4.4 3.6 8 8 8 3.8 0 7-2.5 7.8-6.2.1-.4.5-.7.9-.8.5-.1.9.4.8.9-.5 5.4-4.8 9.6-10.9 9.6z"/>
                        </svg>
                    </button>
                    @auth
                        <a href="{{ route('player') }}" class="btn-primary" id="btn-navbar-player">Buka Pemutar Musik</a>
                    @else
                        <a href="{{ route('login') }}" class="btn-text" id="btn-navbar-login">Masuk</a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="btn-primary" id="btn-navbar-register">Daftar Gratis</a>
                        @endif
                    @endauth
                </div>
            </div>
        </div>
    </header>

    <!-- Hero Section -->
    <section class="hero">
        <div class="container">
            <div class="hero-grid">
                
                <div class="hero-content">
                    <div class="badge">
                        <span class="badge-dot"></span>
                        Streaming Musik Campursari No. 1
                    </div>
                    <h1>Nembang Lebih Asyik Bersama <span>KoncoNembang</span></h1>
                    <p class="hero-description">
                        Platform musik modern yang dirancang khusus untuk menemani keseharian Anda. Dengarkan lagu Campursari, Pop Jawa, dan lagu hits Indonesia terpopuler secara instan tanpa iklan dan bebas gangguan.
                    </p>
                    <div class="hero-actions">
                        @auth
                            <a href="{{ route('player') }}" class="btn-primary" id="btn-hero-enter">Mulai Dengar Sekarang</a>
                        @else
                            <a href="{{ route('register') }}" class="btn-primary" id="btn-hero-register">Mulai Dengar Gratis</a>
                            <a href="#fitur" class="btn-secondary" id="btn-hero-features">Pelajari Fitur</a>
                        @endif
                    </div>
                </div>

                <div class="hero-visual">
                    <!-- Beautiful Mock Player Graphic inside browser -->
                    <div class="mock-player">
                        <div class="mock-art-wrapper">
                            <div class="mock-art-vinyl">
                                <div class="mock-art-center"></div>
                            </div>
                        </div>
                        <div class="mock-title">Dumes</div>
                        <div class="mock-artist">Wawes ft. Guyon Waton</div>
                        
                        <div class="mock-controls">
                            <!-- Prev Mock -->
                            <button class="mock-btn" aria-label="Mock Previous">
                                <svg fill="currentColor" viewBox="0 0 24 24" width="20" height="20">
                                    <path d="M6 6h2v12H6zm3.5 6L18 6v12z"/>
                                </svg>
                            </button>
                            <!-- Play Mock -->
                            <button class="mock-btn mock-btn-play" aria-label="Mock Play/Pause">
                                <svg fill="currentColor" viewBox="0 0 24 24" width="20" height="20" style="margin-left: 2px;">
                                    <path d="M8 5v14l11-7z"/>
                                </svg>
                            </button>
                            <!-- Next Mock -->
                            <button class="mock-btn" aria-label="Mock Next">
                                <svg fill="currentColor" viewBox="0 0 24 24" width="20" height="20">
                                    <path d="M6 18V6l8.5 6zm9-12h2v12h-2z"/>
                                </svg>
                            </button>
                        </div>

                        <div class="mock-timeline">
                            <span>02:30</span>
                            <div class="mock-bar">
                                <div class="mock-bar-fill"></div>
                                <div class="mock-bar-handle"></div>
                            </div>
                            <span>03:45</span>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="features" id="fitur">
        <div class="container">
            <div class="section-header">
                <h2>Alasan Memilih KoncoNembang</h2>
                <p>Rasakan kenyamanan mendengarkan musik daerah dan nasional favorit Anda dengan standar teknologi modern.</p>
            </div>

            <div class="features-grid">
                
                <div class="feature-card">
                    <div class="icon-box">
                        <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 19V6l12-3v13M9 19c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zm12-3c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zM9 10l12-3"/>
                        </svg>
                    </div>
                    <h3>Putar Musik Instan</h3>
                    <p>Aliran audio berkualitas tinggi super cepat tanpa adanya *buffering* yang mengganggu kenikmatan lagu Anda.</p>
                </div>

                <div class="feature-card">
                    <div class="icon-box">
                        <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                        </svg>
                    </div>
                    <h3>Kelola Playlist Sendiri</h3>
                    <p>Buat dan susun koleksi album serta playlist lagu favorit sesuka hati secara instan dan tanpa batasan.</p>
                </div>

                <div class="feature-card">
                    <div class="icon-box">
                        <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9.75 9.75l4.5 4.5m0-4.5l-4.5 4.5M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <h3>Bebas Iklan & Tanpa Syarat</h3>
                    <p>Fokus dengarkan musik tanpa jeda iklan komersial visual maupun audio yang merusak suasana hati Anda.</p>
                </div>

                <div class="feature-card">
                    <div class="icon-box">
                        <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                        </svg>
                    </div>
                    <h3>Responsif Penuh & Selaras</h3>
                    <p>Tampilan premium yang menyesuaikan diri dengan sangat sempurna di perangkat seluler, tablet, maupun layar desktop.</p>
                </div>

            </div>
        </div>
    </section>

    <!-- Call to Action Banner -->
    <section class="cta-banner">
        <div class="container">
            <div class="cta-box">
                <div class="cta-box-glow"></div>
                <h2>Siap Berdendang Bersama Kami?</h2>
                <p>Daftarkan akun gratis Anda sekarang juga dan rasakan cara terbaik mendengarkan musik nusantara kesayangan Anda.</p>
                @auth
                    <a href="{{ route('player') }}" class="btn-white" id="btn-cta-enter">Masuk ke Pemutar Musik</a>
                @else
                    <a href="{{ route('register') }}" class="btn-white" id="btn-cta-register">Mulai Dengar Gratis Sekarang</a>
                @endif
            </div>
        </div>
    </section>

    <!-- Footer Section -->
    <footer>
        <div class="container">
            <div class="footer-wrapper">
                <a href="{{ route('landing') }}" class="footer-logo">
                    <img src="{{ asset('image/Logo-KoncoNembang.png') }}" alt="KoncoNembang Logo" class="footer-logo-img">
                    <span class="footer-brand-name">KoncoNembang</span>
                </a>
                <p class="copyright">&copy; {{ date('Y') }} KoncoNembang. Hak Cipta Dilindungi Undang-Undang.</p>
            </div>
        </div>
    </footer>

    <script>
        // Synchronize body class on the absolute earliest moment to prevent flash
        if (localStorage.getItem('theme') === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.body.classList.add('dark-mode');
        }

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
