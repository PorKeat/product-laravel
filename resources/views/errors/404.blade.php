<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 - Page Not Found</title>
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
            overflow: hidden;
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
                linear-gradient(rgba(255, 0, 85, 0.05) 1px, transparent 1px),
                linear-gradient(90deg, rgba(255, 0, 85, 0.05) 1px, transparent 1px);
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
            filter: blur(100px);
            opacity: 0.15;
            animation: float-orb 30s ease-in-out infinite;
            pointer-events: none;
            z-index: -1;
        }

        .orb-1 {
            width: 400px;
            height: 400px;
            background: var(--danger-red);
            top: 10%;
            left: 10%;
        }

        .orb-2 {
            width: 350px;
            height: 350px;
            background: var(--neon-magenta);
            bottom: 15%;
            right: 15%;
            animation-delay: 10s;
        }

        .orb-3 {
            width: 300px;
            height: 300px;
            background: var(--neon-orange);
            top: 50%;
            left: 50%;
            animation-delay: 20s;
        }

        @keyframes float-orb {
            0%, 100% { transform: translate(0, 0) scale(1); }
            33% { transform: translate(60px, -80px) scale(1.1); }
            66% { transform: translate(-50px, 70px) scale(0.9); }
        }

        /* Container */
        .error-container {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem;
            position: relative;
            z-index: 1;
        }

        .error-content {
            text-align: center;
            max-width: 800px;
        }

        /* Glitch 404 */
        .error-code {
            font-family: 'Orbitron', sans-serif;
            font-size: clamp(8rem, 20vw, 15rem);
            font-weight: 900;
            line-height: 1;
            margin-bottom: 1rem;
            background: linear-gradient(135deg, 
                var(--danger-red) 0%, 
                var(--neon-magenta) 50%, 
                var(--neon-orange) 100%);
            background-size: 200% 200%;
            -webkit-background-clip: text;
            background-clip: text;
            -webkit-text-fill-color: transparent;
            animation: gradient-shift 3s ease infinite, glitch 2s infinite;
            position: relative;
            opacity: 0;
            animation: fadeIn 0.8s ease 0.2s forwards, gradient-shift 3s ease infinite, glitch 4s infinite;
        }

        @keyframes gradient-shift {
            0%, 100% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-30px) scale(0.9);
            }
            to {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }

        @keyframes glitch {
            0%, 90%, 100% {
                text-shadow: 
                    0 0 20px rgba(255, 0, 85, 0.5),
                    0 0 40px rgba(255, 0, 85, 0.3);
            }
            92% {
                text-shadow: 
                    -2px 0 rgba(0, 243, 255, 0.8),
                    2px 0 rgba(255, 0, 85, 0.8),
                    0 0 40px rgba(255, 0, 85, 0.5);
                transform: skew(-0.5deg);
            }
            94% {
                text-shadow: 
                    2px 0 rgba(0, 243, 255, 0.8),
                    -2px 0 rgba(255, 0, 85, 0.8),
                    0 0 40px rgba(255, 0, 85, 0.5);
                transform: skew(0.5deg);
            }
            96% {
                text-shadow: 
                    0 0 20px rgba(255, 0, 85, 0.5),
                    0 0 40px rgba(255, 0, 85, 0.3);
                transform: skew(0deg);
            }
        }

        /* Error title */
        .error-title {
            font-family: 'Orbitron', sans-serif;
            font-size: clamp(2rem, 5vw, 3.5rem);
            font-weight: 700;
            color: var(--danger-red);
            text-transform: uppercase;
            letter-spacing: 0.1em;
            margin-bottom: 1.5rem;
            opacity: 0;
            animation: fadeInUp 0.8s ease 0.5s forwards;
            text-shadow: 0 0 20px rgba(255, 0, 85, 0.5);
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

        /* Error message */
        .error-message {
            font-size: clamp(1rem, 2vw, 1.25rem);
            color: rgba(255, 255, 255, 0.6);
            margin-bottom: 3rem;
            line-height: 1.8;
            opacity: 0;
            animation: fadeInUp 0.8s ease 0.7s forwards;
        }

        /* Buttons container */
        .button-group {
            display: flex;
            gap: 1.5rem;
            justify-content: center;
            flex-wrap: wrap;
            opacity: 0;
            animation: fadeInUp 0.8s ease 0.9s forwards;
        }

        /* Primary button */
        .btn-primary {
            position: relative;
            padding: 1.25rem 3rem;
            font-family: 'Orbitron', sans-serif;
            font-size: 1rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.15em;
            color: var(--midnight);
            background: linear-gradient(135deg, var(--danger-red), var(--neon-magenta));
            border: none;
            cursor: pointer;
            text-decoration: none;
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
            box-shadow: 
                0 0 20px rgba(255, 0, 85, 0.4),
                0 4px 15px rgba(0, 0, 0, 0.3);
            display: inline-block;
        }

        .btn-primary::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.4), transparent);
            transition: left 0.5s ease;
        }

        .btn-primary:hover::before {
            left: 100%;
        }

        .btn-primary:hover {
            transform: translateY(-3px) scale(1.05);
            box-shadow: 
                0 0 40px rgba(255, 0, 85, 0.6),
                0 6px 25px rgba(0, 0, 0, 0.4);
        }

        /* Secondary button */
        .btn-secondary {
            padding: 1.25rem 3rem;
            font-family: 'Outfit', sans-serif;
            font-size: 1rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            color: rgba(255, 255, 255, 0.9);
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 0, 85, 0.3);
            border-radius: 10px;
            cursor: pointer;
            text-decoration: none;
            transition: all 0.3s ease;
            backdrop-filter: blur(10px);
            display: inline-block;
        }

        .btn-secondary:hover {
            background: rgba(255, 0, 85, 0.1);
            border-color: var(--danger-red);
            transform: translateY(-2px);
            box-shadow: 0 0 25px rgba(255, 0, 85, 0.3);
        }

        /* Scanning effect */
        .scan-effect {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
            overflow: hidden;
        }

        .scan-line {
            position: absolute;
            width: 100%;
            height: 3px;
            background: linear-gradient(90deg, 
                transparent,
                var(--danger-red),
                transparent
            );
            opacity: 0.4;
            animation: scan 6s ease-in-out infinite;
        }

        @keyframes scan {
            0%, 100% {
                top: -10%;
                opacity: 0;
            }
            10%, 90% {
                opacity: 0.4;
            }
            50% {
                top: 110%;
            }
        }

        /* Glitch blocks */
        .glitch-block {
            position: fixed;
            background: rgba(255, 0, 85, 0.1);
            pointer-events: none;
            opacity: 0;
            animation: glitchBlock 8s infinite;
        }

        .glitch-block:nth-child(1) {
            width: 200px;
            height: 3px;
            top: 20%;
            left: 10%;
            animation-delay: 0s;
        }

        .glitch-block:nth-child(2) {
            width: 150px;
            height: 2px;
            top: 60%;
            right: 15%;
            animation-delay: 2s;
        }

        .glitch-block:nth-child(3) {
            width: 100px;
            height: 4px;
            bottom: 30%;
            left: 30%;
            animation-delay: 4s;
        }

        @keyframes glitchBlock {
            0%, 95%, 100% {
                opacity: 0;
            }
            96%, 98% {
                opacity: 1;
            }
        }

        /* Responsive */
        @media (max-width: 768px) {
            .error-container {
                padding: 2rem 1rem;
            }

            .button-group {
                flex-direction: column;
                gap: 1rem;
            }

            .btn-primary,
            .btn-secondary {
                width: 100%;
                text-align: center;
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

    <!-- Glitch effects -->
    <div class="glitch-block"></div>
    <div class="glitch-block"></div>
    <div class="glitch-block"></div>

    <!-- Scan effect -->
    <div class="scan-effect">
        <div class="scan-line"></div>
    </div>

    <!-- Error content -->
    <div class="error-container">
        <div class="error-content">
            <div class="error-code">404</div>
            <h1 class="error-title">Page Not Found</h1>
            <p class="error-message">
                The page you're looking for has drifted into the digital void.<br>
                It might have been deleted, moved, or never existed in this reality.
            </p>
            <div class="button-group">
                <a href="/" class="btn-primary">
                    Return Home
                </a>
                <a href="/products" class="btn-secondary">
                    View Products
                </a>
            </div>
        </div>
    </div>

    <script>
        // Random glitch effect on hover
        const errorCode = document.querySelector('.error-code');
        
        setInterval(() => {
            if (Math.random() > 0.95) {
                errorCode.style.transform = `translate(${Math.random() * 4 - 2}px, ${Math.random() * 4 - 2}px)`;
                setTimeout(() => {
                    errorCode.style.transform = 'translate(0, 0)';
                }, 50);
            }
        }, 100);
    </script>
</body>
</html>