<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Product Management</title>
    @vite('resources/css/app.css')
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;700;900&family=Outfit:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        :root {
            --neon-cyan: #00f3ff;
            --neon-magenta: #ff006e;
            --neon-orange: #ff5c00;
            --deep-navy: #0a0e27;
            --midnight: #020614;
            --electric-blue: #0066ff;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Outfit', sans-serif;
            overflow-x: hidden;
            background: var(--midnight);
            color: #ffffff;
        }

        /* Animated cyber grid background */
        .cyber-bg {
            position: fixed;
            inset: 0;
            background: 
                linear-gradient(to bottom, var(--midnight) 0%, var(--deep-navy) 100%);
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

        /* Neon orbs floating in background */
        .orb {
            position: absolute;
            border-radius: 50%;
            filter: blur(80px);
            opacity: 0.15;
            animation: float-orb 20s ease-in-out infinite;
            pointer-events: none;
        }

        .orb-1 {
            width: 400px;
            height: 400px;
            background: var(--neon-cyan);
            top: 10%;
            left: 10%;
            animation-delay: 0s;
        }

        .orb-2 {
            width: 350px;
            height: 350px;
            background: var(--neon-magenta);
            bottom: 15%;
            right: 15%;
            animation-delay: 7s;
        }

        .orb-3 {
            width: 300px;
            height: 300px;
            background: var(--neon-orange);
            top: 60%;
            left: 60%;
            animation-delay: 14s;
        }

        @keyframes float-orb {
            0%, 100% { 
                transform: translate(0, 0) scale(1); 
                opacity: 0.15;
            }
            33% { 
                transform: translate(60px, -80px) scale(1.1); 
                opacity: 0.25;
            }
            66% { 
                transform: translate(-50px, 70px) scale(0.9); 
                opacity: 0.2;
            }
        }

        /* Container */
        .container {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem;
            position: relative;
            z-index: 1;
        }

        /* Holographic card */
        .holo-card {
            position: relative;
            padding: 4rem 3rem;
            border-radius: 24px;
            background: rgba(10, 14, 39, 0.4);
            backdrop-filter: blur(20px) saturate(180%);
            border: 1px solid rgba(0, 243, 255, 0.2);
            box-shadow: 
                0 8px 32px rgba(0, 0, 0, 0.4),
                inset 0 1px 0 rgba(255, 255, 255, 0.1),
                0 0 60px rgba(0, 243, 255, 0.1);
            max-width: 700px;
            width: 100%;
            transform-style: preserve-3d;
            transition: transform 0.2s ease;
        }

        .holo-card::before {
            content: '';
            position: absolute;
            inset: -2px;
            border-radius: 24px;
            padding: 2px;
            background: linear-gradient(135deg, 
                var(--neon-cyan) 0%, 
                var(--neon-magenta) 50%, 
                var(--neon-orange) 100%);
            -webkit-mask: linear-gradient(#fff 0 0) content-box, linear-gradient(#fff 0 0);
            mask: linear-gradient(#fff 0 0) content-box, linear-gradient(#fff 0 0);
            -webkit-mask-composite: xor;
            mask-composite: exclude;
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .holo-card:hover::before {
            opacity: 0.6;
        }

        /* Title with glitch effect */
        .title {
            font-family: 'Orbitron', sans-serif;
            font-size: clamp(2.5rem, 8vw, 5rem);
            font-weight: 900;
            margin-bottom: 1rem;
            background: linear-gradient(135deg, 
                #ffffff 0%, 
                var(--neon-cyan) 40%, 
                var(--neon-magenta) 70%,
                var(--neon-orange) 100%);
            background-size: 200% 200%;
            -webkit-background-clip: text;
            background-clip: text;
            -webkit-text-fill-color: transparent;
            animation: gradient-shift 4s ease infinite;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            line-height: 1.1;
            position: relative;
            opacity: 0;
            animation: fadeInTitle 1s ease 0.3s forwards, gradient-shift 4s ease infinite;
        }

        @keyframes gradient-shift {
            0%, 100% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
        }

        @keyframes fadeInTitle {
            from {
                opacity: 0;
                transform: translateY(30px);
                filter: blur(10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
                filter: blur(0);
            }
        }

        /* Greeting text */
        .greeting {
            font-family: 'Orbitron', sans-serif;
            font-size: clamp(1.5rem, 4vw, 2.5rem);
            font-weight: 400;
            color: rgba(255, 255, 255, 0.7);
            margin-bottom: 2rem;
            opacity: 0;
            animation: fadeInUp 0.8s ease 0.6s forwards;
            letter-spacing: 0.1em;
        }

        .greeting .wave {
            display: inline-block;
            animation: wave 2.5s ease-in-out infinite;
            transform-origin: 70% 70%;
        }

        @keyframes wave {
            0%, 100% { transform: rotate(0deg); }
            10%, 30% { transform: rotate(14deg); }
            20% { transform: rotate(-8deg); }
            40%, 100% { transform: rotate(0deg); }
        }

        /* Subtitle */
        .subtitle {
            font-size: clamp(1rem, 2vw, 1.25rem);
            color: rgba(255, 255, 255, 0.5);
            margin-bottom: 3rem;
            font-weight: 300;
            line-height: 1.6;
            opacity: 0;
            animation: fadeInUp 0.8s ease 0.9s forwards;
        }

        .subtitle .highlight {
            color: var(--neon-orange);
            font-weight: 600;
            text-shadow: 0 0 20px rgba(255, 92, 0, 0.5);
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Cyber button */
        .cyber-button {
            position: relative;
            display: inline-block;
            padding: 1.25rem 3.5rem;
            font-family: 'Orbitron', sans-serif;
            font-size: 1.125rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.15em;
            color: var(--midnight);
            background: linear-gradient(135deg, var(--neon-cyan), var(--electric-blue));
            border: none;
            cursor: pointer;
            overflow: hidden;
            clip-path: polygon(
                0 0,
                calc(100% - 20px) 0,
                100% 20px,
                100% 100%,
                20px 100%,
                0 calc(100% - 20px)
            );
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            opacity: 0;
            animation: fadeInButton 0.8s ease 1.2s forwards;
            box-shadow: 
                0 0 20px rgba(0, 243, 255, 0.4),
                0 0 40px rgba(0, 243, 255, 0.2);
        }

        @keyframes fadeInButton {
            from {
                opacity: 0;
                transform: translateY(20px) scale(0.95);
            }
            to {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }

        .cyber-button::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(
                90deg,
                transparent,
                rgba(255, 255, 255, 0.4),
                transparent
            );
            transition: left 0.5s ease;
        }

        .cyber-button:hover::before {
            left: 100%;
        }

        .cyber-button:hover {
            transform: translateY(-4px) scale(1.05);
            box-shadow: 
                0 0 40px rgba(0, 243, 255, 0.6),
                0 0 80px rgba(0, 243, 255, 0.3),
                0 8px 24px rgba(0, 0, 0, 0.4);
        }

        .cyber-button:active {
            transform: translateY(-2px) scale(1.02);
        }

        .cyber-button .rocket {
            display: inline-block;
            margin-left: 0.5rem;
            transition: transform 0.3s ease;
        }

        .cyber-button:hover .rocket {
            transform: translateX(4px) translateY(-4px) rotate(-15deg);
        }

        /* Decorative scan lines */
        .scan-line {
            position: absolute;
            width: 100%;
            height: 2px;
            background: linear-gradient(90deg, 
                transparent,
                var(--neon-cyan),
                transparent
            );
            opacity: 0.3;
            animation: scan 4s ease-in-out infinite;
        }

        @keyframes scan {
            0%, 100% {
                top: 0;
                opacity: 0;
            }
            50% {
                top: 100%;
                opacity: 0.3;
            }
        }

        /* Status indicators */
        .status-bar {
            display: flex;
            gap: 1rem;
            justify-content: center;
            margin-top: 3rem;
            opacity: 0;
            animation: fadeInUp 0.8s ease 1.5s forwards;
        }

        .status-dot {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            position: relative;
        }

        .status-dot::before {
            content: '';
            position: absolute;
            inset: -4px;
            border-radius: 50%;
            border: 1px solid currentColor;
            opacity: 0;
            animation: ping 2s cubic-bezier(0, 0, 0.2, 1) infinite;
        }

        .status-dot:nth-child(1) {
            background: var(--neon-cyan);
            color: var(--neon-cyan);
            animation-delay: 0s;
        }

        .status-dot:nth-child(2) {
            background: var(--neon-magenta);
            color: var(--neon-magenta);
            animation-delay: 0.4s;
        }

        .status-dot:nth-child(3) {
            background: var(--neon-orange);
            color: var(--neon-orange);
            animation-delay: 0.8s;
        }

        @keyframes ping {
            0% {
                transform: scale(1);
                opacity: 1;
            }
            75%, 100% {
                transform: scale(2);
                opacity: 0;
            }
        }

        /* Floating particles */
        .particle {
            position: absolute;
            width: 2px;
            height: 2px;
            background: var(--neon-cyan);
            border-radius: 50%;
            opacity: 0;
            animation: particle-float 15s linear infinite;
            box-shadow: 0 0 4px var(--neon-cyan);
        }

        @keyframes particle-float {
            0% {
                transform: translateY(100vh) translateX(0) rotate(0deg);
                opacity: 0;
            }
            10% {
                opacity: 0.8;
            }
            90% {
                opacity: 0.8;
            }
            100% {
                transform: translateY(-100px) translateX(100px) rotate(360deg);
                opacity: 0;
            }
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .holo-card {
                padding: 3rem 2rem;
            }

            .cyber-button {
                padding: 1rem 2.5rem;
                font-size: 1rem;
            }
        }
    </style>
</head>
<body>
    <!-- Cyber background -->
    <div class="cyber-bg"></div>

    <!-- Floating orbs -->
    <div class="orb orb-1"></div>
    <div class="orb orb-2"></div>
    <div class="orb orb-3"></div>

    <!-- Main container -->
    <div class="container">
        <div class="holo-card" id="card">
            <div class="scan-line"></div>
            
            <div class="greeting">
                Hello I'm Keat <span class="wave">👋</span>
            </div>

            <h1 class="title">
                Product<br>CRUD
            </h1>

            <p class="subtitle">
                Welcome to your <span class="highlight">Product Management System</span><br>
                Ready to elevate your workflow
            </p>

            <a href="/products" style="text-decoration: none;">
                <button class="cyber-button">
                    Launch Dashboard<span class="rocket">🚀</span>
                </button>
            </a>

            <div class="status-bar">
                <div class="status-dot"></div>
                <div class="status-dot"></div>
                <div class="status-dot"></div>
            </div>
        </div>
    </div>

    <!-- Floating particles -->
    <div id="particles-container"></div>

    <script>
        // Card tilt effect on mouse move
        const card = document.getElementById('card');
        
        card.addEventListener('mousemove', (e) => {
            const rect = card.getBoundingClientRect();
            const x = e.clientX - rect.left;
            const y = e.clientY - rect.top;
            
            const centerX = rect.width / 2;
            const centerY = rect.height / 2;
            
            const rotateX = (y - centerY) / 20;
            const rotateY = (centerX - x) / 20;
            
            card.style.transform = `perspective(1000px) rotateX(${rotateX}deg) rotateY(${rotateY}deg)`;
        });
        
        card.addEventListener('mouseleave', () => {
            card.style.transform = 'perspective(1000px) rotateX(0) rotateY(0)';
        });

        // Generate floating particles
        const particlesContainer = document.getElementById('particles-container');
        const particleCount = 40;

        for (let i = 0; i < particleCount; i++) {
            const particle = document.createElement('div');
            particle.classList.add('particle');
            
            particle.style.left = `${Math.random() * 100}%`;
            particle.style.animationDelay = `${Math.random() * 15}s`;
            particle.style.animationDuration = `${15 + Math.random() * 10}s`;
            
            const colors = ['var(--neon-cyan)', 'var(--neon-magenta)', 'var(--neon-orange)'];
            const color = colors[Math.floor(Math.random() * colors.length)];
            particle.style.background = color;
            particle.style.boxShadow = `0 0 4px ${color}`;
            
            particlesContainer.appendChild(particle);
        }
    </script>
</body>
</html>