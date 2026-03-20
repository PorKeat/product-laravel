<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Products') — AXIS</title>
    @vite('resources/css/app.css')
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;700;900&family=Outfit:wght@300;400;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --neon-cyan: #00f3ff;
            --neon-magenta: #ff006e;
            --neon-orange: #ff5c00;
            --deep-navy: #0a0e27;
            --midnight: #020614;
            --electric-blue: #0066ff;
            --success-green: #00ff9f;
            --danger-red: #ff0055;
            --warning-yellow: #ffd600;
        }

        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: 'Outfit', sans-serif;
            background: var(--midnight);
            color: #ffffff;
            min-height: 100vh;
            position: relative;
        }

        /* ── Cyber grid background ── */
        .cyber-bg {
            position: fixed;
            inset: 0;
            background: linear-gradient(160deg, #020614 0%, #0a0e27 60%, #04091a 100%);
            z-index: -2;
        }

        .cyber-bg::before {
            content: '';
            position: absolute;
            inset: 0;
            background-image:
                linear-gradient(rgba(0, 243, 255, 0.04) 1px, transparent 1px),
                linear-gradient(90deg, rgba(0, 243, 255, 0.04) 1px, transparent 1px);
            background-size: 60px 60px;
            animation: gridScroll 25s linear infinite;
            mask-image: radial-gradient(ellipse at 50% 30%, black 0%, transparent 75%);
        }

        /* Scanline overlay */
        .cyber-bg::after {
            content: '';
            position: absolute;
            inset: 0;
            background: repeating-linear-gradient(
                0deg,
                transparent,
                transparent 2px,
                rgba(0, 0, 0, 0.08) 2px,
                rgba(0, 0, 0, 0.08) 4px
            );
            pointer-events: none;
        }

        @keyframes gridScroll {
            0%   { transform: translateY(0) translateX(0); }
            100% { transform: translateY(60px) translateX(60px); }
        }

        /* ── Floating orbs ── */
        .orb {
            position: fixed;
            border-radius: 50%;
            filter: blur(90px);
            opacity: 0.1;
            animation: float-orb 30s ease-in-out infinite;
            pointer-events: none;
            z-index: -1;
        }

        .orb-1 {
            width: 500px; height: 500px;
            background: radial-gradient(circle, var(--neon-cyan), transparent 70%);
            top: -10%; right: 5%;
        }

        .orb-2 {
            width: 400px; height: 400px;
            background: radial-gradient(circle, var(--neon-magenta), transparent 70%);
            bottom: 10%; left: -5%;
            animation-delay: 10s;
        }

        .orb-3 {
            width: 300px; height: 300px;
            background: radial-gradient(circle, var(--electric-blue), transparent 70%);
            top: 50%; right: 30%;
            animation-delay: 18s;
            opacity: 0.06;
        }

        @keyframes float-orb {
            0%, 100% { transform: translate(0, 0) scale(1); }
            33%       { transform: translate(50px, -70px) scale(1.08); }
            66%       { transform: translate(-40px, 50px) scale(0.94); }
        }

        /* ── Top Navigation ── */
        .top-nav {
            position: sticky;
            top: 0;
            z-index: 100;
            background: rgba(2, 6, 20, 0.75);
            backdrop-filter: blur(24px) saturate(200%);
            border-bottom: 1px solid rgba(0, 243, 255, 0.12);
            padding: 0 2rem;
            height: 68px;
            display: flex;
            align-items: center;
        }

        /* Thin accent line at very top */
        .top-nav::before {
            content: '';
            position: absolute;
            top: 0; left: 0; right: 0;
            height: 2px;
            background: linear-gradient(90deg,
                transparent 0%,
                var(--neon-cyan) 20%,
                var(--electric-blue) 50%,
                var(--neon-magenta) 80%,
                transparent 100%
            );
            opacity: 0.7;
        }

        .nav-container {
            max-width: 1400px;
            width: 100%;
            margin: 0 auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 1.5rem;
        }

        /* ── Brand / Logo ── */
        .nav-brand {
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 0.75rem;
            flex-shrink: 0;
        }

        .logo-mark {
            width: 38px;
            height: 38px;
            flex-shrink: 0;
            filter: drop-shadow(0 0 8px rgba(0, 243, 255, 0.5));
        }

        .brand-text {
            display: flex;
            flex-direction: column;
            gap: 1px;
        }

        .brand-name {
            font-family: 'Orbitron', sans-serif;
            font-size: 1.35rem;
            font-weight: 900;
            letter-spacing: 0.2em;
            line-height: 1;
            background: linear-gradient(135deg, #ffffff 0%, var(--neon-cyan) 60%, var(--electric-blue) 100%);
            -webkit-background-clip: text;
            background-clip: text;
            -webkit-text-fill-color: transparent;
            text-transform: uppercase;
        }

        .brand-tagline {
            font-family: 'Outfit', sans-serif;
            font-size: 0.6rem;
            font-weight: 400;
            letter-spacing: 0.35em;
            text-transform: uppercase;
            color: rgba(0, 243, 255, 0.45);
            line-height: 1;
        }

/* ── Nav actions ── */
        .nav-actions {
            display: flex;
            gap: 0.75rem;
            align-items: center;
            flex-shrink: 0;
        }

        /* Home button */
        .btn-home {
            width: 36px;
            height: 36px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background: rgba(255, 255, 255, 0.04);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.25s ease;
            text-decoration: none;
            color: rgba(255, 255, 255, 0.5);
            flex-shrink: 0;
        }

        .btn-home svg { width: 16px; height: 16px; }

        .btn-home:hover {
            background: rgba(0, 243, 255, 0.1);
            border-color: rgba(0, 243, 255, 0.4);
            color: var(--neon-cyan);
            box-shadow: 0 0 16px rgba(0, 243, 255, 0.2);
        }

        /* User chip */
        .user-chip {
            display: flex;
            align-items: center;
            gap: 0.6rem;
            padding: 0.3rem 0.75rem 0.3rem 0.3rem;
            background: rgba(255, 255, 255, 0.04);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 100px;
            transition: all 0.25s ease;
        }

        .user-chip:hover {
            border-color: rgba(0, 243, 255, 0.3);
            background: rgba(0, 243, 255, 0.05);
        }

        .user-avatar {
            width: 28px;
            height: 28px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--neon-cyan), var(--electric-blue));
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Orbitron', sans-serif;
            font-weight: 900;
            font-size: 0.7rem;
            color: var(--midnight);
            flex-shrink: 0;
            box-shadow: 0 0 12px rgba(0, 243, 255, 0.35);
        }

        .user-name {
            font-family: 'Outfit', sans-serif;
            font-size: 0.82rem;
            font-weight: 600;
            color: rgba(255, 255, 255, 0.75);
            white-space: nowrap;
        }

        /* Sign-out button */
        .btn-signout {
            height: 36px;
            padding: 0 1.1rem;
            font-family: 'Outfit', sans-serif;
            font-size: 0.8rem;
            font-weight: 600;
            color: rgba(255, 80, 100, 0.75);
            background: rgba(255, 0, 55, 0.07);
            border: 1px solid rgba(255, 0, 55, 0.2);
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.25s ease;
            text-transform: uppercase;
            letter-spacing: 0.08em;
            display: flex;
            align-items: center;
            gap: 0.4rem;
            white-space: nowrap;
        }

        .btn-signout svg { width: 13px; height: 13px; opacity: 0.8; }

        .btn-signout:hover {
            background: rgba(255, 0, 55, 0.15);
            border-color: var(--danger-red);
            color: var(--danger-red);
            box-shadow: 0 0 18px rgba(255, 0, 55, 0.2);
            transform: translateY(-1px);
        }

        /* ── Flash messages ── */
        .flash-wrapper {
            max-width: 1400px;
            margin: 0 auto;
            padding: 1.5rem 2rem 0;
        }

        .flash {
            display: flex;
            align-items: center;
            gap: 0.85rem;
            padding: 0.9rem 1.25rem;
            border-radius: 12px;
            font-family: 'Outfit', sans-serif;
            font-size: 0.9rem;
            font-weight: 600;
            animation: flashIn 0.4s cubic-bezier(0.34, 1.56, 0.64, 1);
        }

        @keyframes flashIn {
            from { opacity: 0; transform: translateY(-12px) scale(0.97); }
            to   { opacity: 1; transform: translateY(0) scale(1); }
        }

        .flash-icon {
            width: 28px;
            height: 28px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            font-size: 0.85rem;
        }

        .flash.success {
            background: rgba(0, 255, 159, 0.07);
            border: 1px solid rgba(0, 255, 159, 0.3);
            color: var(--success-green);
        }

        .flash.success .flash-icon {
            background: rgba(0, 255, 159, 0.15);
            color: var(--success-green);
        }

        .flash.error {
            background: rgba(255, 0, 55, 0.07);
            border: 1px solid rgba(255, 0, 55, 0.3);
            color: var(--danger-red);
        }

        .flash.error .flash-icon {
            background: rgba(255, 0, 55, 0.15);
            color: var(--danger-red);
        }

        .flash.warning {
            background: rgba(255, 214, 0, 0.07);
            border: 1px solid rgba(255, 214, 0, 0.3);
            color: var(--warning-yellow);
        }

        /* ── Main ── */
        main { min-height: calc(100vh - 68px); }

        /* ── Responsive ── */
@media (max-width: 640px) {
            .top-nav { padding: 0 1rem; }
            .brand-tagline { display: none; }
            .user-name { display: none; }
            .btn-signout span { display: none; }
            .btn-signout { padding: 0 0.75rem; }
        }
    </style>
    @stack('styles')
</head>
<body>
    <div class="cyber-bg"></div>
    <div class="orb orb-1"></div>
    <div class="orb orb-2"></div>
    <div class="orb orb-3"></div>

    <nav class="top-nav">
        <div class="nav-container">

            {{-- Logo --}}
            <a href="/products" class="nav-brand">
                <svg class="logo-mark" viewBox="0 0 38 38" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <!-- Outer ring -->
                    <circle cx="19" cy="19" r="17.5" stroke="url(#ring-grad)" stroke-width="1.2" fill="none" opacity="0.6"/>
                    <!-- Cross axes -->
                    <line x1="19" y1="4"  x2="19" y2="34" stroke="url(#line-grad)" stroke-width="1" opacity="0.4"/>
                    <line x1="4"  y1="19" x2="34" y2="19" stroke="url(#line-grad)" stroke-width="1" opacity="0.4"/>
                    <!-- Inner diamond -->
                    <polygon points="19,8 30,19 19,30 8,19" fill="none" stroke="url(#ring-grad)" stroke-width="1.4"/>
                    <!-- Center hex -->
                    <polygon points="19,13.5 23.5,16.25 23.5,21.75 19,24.5 14.5,21.75 14.5,16.25"
                             fill="url(#hex-fill)" stroke="url(#ring-grad)" stroke-width="1"/>
                    <!-- Center dot -->
                    <circle cx="19" cy="19" r="2.5" fill="#00f3ff" opacity="0.9"/>
                    <!-- Corner ticks -->
                    <circle cx="19" cy="4"  r="1.5" fill="#00f3ff" opacity="0.7"/>
                    <circle cx="19" cy="34" r="1.5" fill="#00f3ff" opacity="0.7"/>
                    <circle cx="4"  cy="19" r="1.5" fill="#0066ff" opacity="0.7"/>
                    <circle cx="34" cy="19" r="1.5" fill="#0066ff" opacity="0.7"/>
                    <defs>
                        <linearGradient id="ring-grad" x1="0" y1="0" x2="38" y2="38" gradientUnits="userSpaceOnUse">
                            <stop offset="0%"   stop-color="#00f3ff"/>
                            <stop offset="100%" stop-color="#0066ff"/>
                        </linearGradient>
                        <linearGradient id="line-grad" x1="0" y1="0" x2="38" y2="38" gradientUnits="userSpaceOnUse">
                            <stop offset="0%"   stop-color="#00f3ff" stop-opacity="0.8"/>
                            <stop offset="100%" stop-color="#0066ff" stop-opacity="0.8"/>
                        </linearGradient>
                        <linearGradient id="hex-fill" x1="14.5" y1="13.5" x2="23.5" y2="24.5" gradientUnits="userSpaceOnUse">
                            <stop offset="0%"   stop-color="#00f3ff" stop-opacity="0.2"/>
                            <stop offset="100%" stop-color="#0066ff" stop-opacity="0.1"/>
                        </linearGradient>
                    </defs>
                </svg>
                <div class="brand-text">
                    <span class="brand-name">AXIS</span>
                    <span class="brand-tagline">Product Control</span>
                </div>
            </a>



            {{-- Right actions --}}
            <div class="nav-actions">

                <a href="/" class="btn-home" title="Home">
                    <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M2 6.5L8 2l6 4.5V14a.5.5 0 01-.5.5h-4V10H6.5v4.5H2.5A.5.5 0 012 14V6.5z"/>
                    </svg>
                </a>

                <div class="user-chip">
                    <div class="user-avatar">
                        {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                    </div>
                    <span class="user-name">{{ Auth::user()->name }}</span>
                </div>

                <form method="POST" action="{{ route('logout') }}" style="display:inline;">
                    @csrf
                    <button type="submit" class="btn-signout">
                        <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M6 14H3a1 1 0 01-1-1V3a1 1 0 011-1h3M11 11l3-3-3-3M14 8H6"/>
                        </svg>
                        <span>Sign Out</span>
                    </button>
                </form>

            </div>
        </div>
    </nav>

    {{-- Flash messages --}}
    @if(session('success'))
        <div class="flash-wrapper">
            <div class="flash success">
                <div class="flash-icon">✓</div>
                {{ session('success') }}
            </div>
        </div>
    @endif

    @if(session('error'))
        <div class="flash-wrapper">
            <div class="flash error">
                <div class="flash-icon">✕</div>
                {{ session('error') }}
            </div>
        </div>
    @endif

    @if(session('warning'))
        <div class="flash-wrapper">
            <div class="flash warning">
                <div class="flash-icon">!</div>
                {{ session('warning') }}
            </div>
        </div>
    @endif

    <main>
        @yield('content')
    </main>

    @stack('scripts')
</body>
</html>