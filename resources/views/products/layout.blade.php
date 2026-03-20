<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Products') - Product Management</title>
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
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Outfit', sans-serif;
            background: var(--midnight);
            color: #ffffff;
            min-height: 100vh;
            position: relative;
        }

        /* Animated cyber grid background */
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

        /* Top Navigation Bar */
        .top-nav {
            position: sticky;
            top: 0;
            z-index: 100;
            background: rgba(10, 14, 39, 0.8);
            backdrop-filter: blur(20px) saturate(180%);
            border-bottom: 1px solid rgba(0, 243, 255, 0.2);
            padding: 1rem 2rem;
        }

        .nav-container {
            max-width: 1400px;
            margin: 0 auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .nav-brand {
            font-family: 'Orbitron', sans-serif;
            font-size: 1.5rem;
            font-weight: 900;
            background: linear-gradient(135deg, var(--neon-cyan), var(--neon-magenta));
            -webkit-background-clip: text;
            background-clip: text;
            -webkit-text-fill-color: transparent;
            text-decoration: none;
            text-transform: uppercase;
            letter-spacing: 0.1em;
        }

        .nav-actions {
            display: flex;
            gap: 1rem;
            align-items: center;
        }

        .btn-home {
            width: 40px;
            height: 40px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(0, 243, 255, 0.3);
            border-radius: 10px;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            backdrop-filter: blur(10px);
            font-size: 1.2rem;
            color: var(--neon-cyan);
        }

        .btn-home:hover {
            background: rgba(0, 243, 255, 0.15);
            border-color: var(--neon-cyan);
            transform: translateX(-5px);
            box-shadow: 0 0 25px rgba(0, 243, 255, 0.4);
        }

        .user-info {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.5rem 1rem;
            background: rgba(0, 243, 255, 0.05);
            border: 1px solid rgba(0, 243, 255, 0.2);
            border-radius: 10px;
            backdrop-filter: blur(10px);
        }

        .user-avatar {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--neon-cyan), var(--electric-blue));
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Orbitron', sans-serif;
            font-weight: 900;
            font-size: 1rem;
            color: var(--midnight);
            box-shadow: 0 0 20px rgba(0, 243, 255, 0.4);
        }

        .user-name {
            font-family: 'Outfit', sans-serif;
            font-size: 0.9rem;
            font-weight: 600;
            color: var(--neon-cyan);
        }

        .btn-signout {
            padding: 0.6rem 1.5rem;
            font-family: 'Outfit', sans-serif;
            font-size: 0.9rem;
            font-weight: 600;
            color: rgba(255, 255, 255, 0.9);
            background: rgba(255, 0, 85, 0.1);
            border: 1px solid rgba(255, 0, 85, 0.3);
            border-radius: 10px;
            cursor: pointer;
            transition: all 0.3s ease;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        .btn-signout:hover {
            background: rgba(255, 0, 85, 0.2);
            border-color: var(--danger-red);
            transform: translateY(-2px);
            box-shadow: 0 0 25px rgba(255, 0, 85, 0.3);
            color: var(--danger-red);
        }

        /* Success message */
        .success-message {
            background: rgba(0, 255, 159, 0.1);
            border: 1px solid var(--success-green);
            color: var(--success-green);
            padding: 1rem 1.5rem;
            border-radius: 12px;
            margin-bottom: 2rem;
            font-family: 'Outfit', sans-serif;
            font-weight: 600;
            animation: slideInRight 0.5s ease;
            box-shadow: 0 0 20px rgba(0, 255, 159, 0.2);
        }

        @keyframes slideInRight {
            from {
                opacity: 0;
                transform: translateX(50px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        /* Responsive */
        @media (max-width: 768px) {
            .top-nav {
                padding: 1rem;
            }

            .nav-brand {
                font-size: 1.2rem;
            }

            .user-name {
                display: none;
            }

            .btn-signout {
                padding: 0.6rem 1rem;
                font-size: 0.85rem;
            }
        }
    </style>
    @stack('styles')
</head>
<body>
    <!-- Cyber background -->
    <div class="cyber-bg"></div>

    <!-- Floating orbs -->
    <div class="orb orb-1"></div>
    <div class="orb orb-2"></div>

    <!-- Top Navigation -->
    <nav class="top-nav">
        <div class="nav-container">
            <a href="/products" class="nav-brand">Product Mgmt</a>
            
            <div class="nav-actions">
                <a href="/" class="btn-home" title="Back to Home">←</a>
                
                <div class="user-info">
                    <div class="user-avatar">
                        {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                    </div>
                    <span class="user-name">{{ Auth::user()->name }}</span>
                </div>
                
                <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                    @csrf
                    <button type="submit" class="btn-signout">Sign Out</button>
                </form>
            </div>
        </div>
    </nav>

    <!-- Success Message -->
    @if(session('success'))
        <div style="max-width: 1400px; margin: 0 auto; padding: 2rem 2rem 0;">
            <div class="success-message">
                ✓ {{ session('success') }}
            </div>
        </div>
    @endif

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

    @stack('scripts')
</body>
</html>