<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;700;900&family=Outfit:wght@300;400;600;700&display=swap" rel="stylesheet">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <style>
            :root {
                --neon-cyan: #00f3ff;
                --neon-magenta: #ff006e;
                --neon-orange: #ff5c00;
                --deep-navy: #0a0e27;
                --midnight: #020614;
                --electric-blue: #0066ff;
            }

            body {
                font-family: 'Outfit', sans-serif;
                background: var(--midnight);
                color: #ffffff;
            }

            /* Cyber background */
            .cyber-bg {
                position: fixed;
                inset: 0;
                background: linear-gradient(to bottom, var(--midnight) 0%, var(--deep-navy) 100%);
                z-index: -2;
            }

            .cyber-bg::before {
                content: '';
                position: absolute;
                inset: 0;
                background-image: 
                    linear-gradient(rgba(0, 243, 255, 0.03) 1px, transparent 1px),
                    linear-gradient(90deg, rgba(0, 243, 255, 0.03) 1px, transparent 1px);
                background-size: 50px 50px;
                animation: gridScroll 20s linear infinite;
                mask-image: radial-gradient(ellipse at center, black 0%, transparent 70%);
            }

            @keyframes gridScroll {
                0% { transform: translateY(0) translateX(0); }
                100% { transform: translateY(50px) translateX(50px); }
            }

            /* Floating orbs */
            .orb {
                position: fixed;
                border-radius: 50%;
                filter: blur(80px);
                opacity: 0.12;
                animation: float-orb 25s ease-in-out infinite;
                pointer-events: none;
                z-index: -1;
            }

            .orb-1 {
                width: 350px;
                height: 350px;
                background: var(--neon-cyan);
                top: 20%;
                right: 10%;
            }

            .orb-2 {
                width: 300px;
                height: 300px;
                background: var(--neon-magenta);
                bottom: 20%;
                left: 15%;
                animation-delay: 8s;
            }

            @keyframes float-orb {
                0%, 100% { transform: translate(0, 0) scale(1); }
                33% { transform: translate(40px, -60px) scale(1.1); }
                66% { transform: translate(-40px, 50px) scale(0.9); }
            }
        </style>
    </head>
    <body class="font-sans antialiased">
        <!-- Cyber background -->
        <div class="cyber-bg"></div>
        <div class="orb orb-1"></div>
        <div class="orb orb-2"></div>

        <div class="min-h-screen">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @isset($header)
                <header class="bg-transparent">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>
    </body>
</html>