<x-guest-layout>
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

        body {
            background: var(--midnight);
            min-height: 100vh;
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
                linear-gradient(rgba(255, 0, 110, 0.03) 1px, transparent 1px),
                linear-gradient(90deg, rgba(255, 0, 110, 0.03) 1px, transparent 1px);
            background-size: 50px 50px;
            animation: gridScroll 20s linear infinite;
        }

        @keyframes gridScroll {
            0% { transform: translateY(0) translateX(0); }
            100% { transform: translateY(50px) translateX(50px); }
        }

        /* Floating orb */
        .orb {
            position: fixed;
            width: 400px;
            height: 400px;
            border-radius: 50%;
            filter: blur(100px);
            opacity: 0.15;
            background: var(--neon-magenta);
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            animation: pulse-orb 8s ease-in-out infinite;
            z-index: -1;
        }

        @keyframes pulse-orb {
            0%, 100% { transform: translate(-50%, -50%) scale(1); }
            50% { transform: translate(-50%, -50%) scale(1.2); }
        }

        .auth-container {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem;
        }

        .auth-card {
            background: rgba(10, 14, 39, 0.6);
            backdrop-filter: blur(20px) saturate(180%);
            border: 1px solid rgba(255, 0, 110, 0.2);
            border-radius: 20px;
            padding: 3rem;
            max-width: 450px;
            width: 100%;
            box-shadow: 
                0 8px 32px rgba(0, 0, 0, 0.4),
                0 0 60px rgba(255, 0, 110, 0.1);
        }

        .auth-title {
            font-family: 'Orbitron', sans-serif;
            font-size: 2.5rem;
            font-weight: 900;
            text-align: center;
            margin-bottom: 0.5rem;
            background: linear-gradient(135deg, var(--neon-magenta), var(--neon-orange));
            -webkit-background-clip: text;
            background-clip: text;
            -webkit-text-fill-color: transparent;
            text-transform: uppercase;
            letter-spacing: 0.1em;
        }

        .auth-subtitle {
            text-align: center;
            color: rgba(255, 255, 255, 0.5);
            margin-bottom: 2rem;
            font-size: 0.95rem;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        label {
            display: block;
            font-family: 'Outfit', sans-serif;
            font-size: 0.9rem;
            font-weight: 600;
            color: var(--neon-magenta);
            margin-bottom: 0.5rem;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        input[type="email"],
        input[type="password"],
        input[type="text"] {
            width: 100%;
            padding: 1rem;
            background: rgba(0, 0, 0, 0.3);
            border: 1px solid rgba(255, 0, 110, 0.2);
            border-radius: 10px;
            color: #ffffff;
            font-family: 'Outfit', sans-serif;
            font-size: 1rem;
            outline: none;
            transition: all 0.3s ease;
        }

        input:focus {
            border-color: var(--neon-magenta);
            background: rgba(255, 0, 110, 0.05);
            box-shadow: 0 0 20px rgba(255, 0, 110, 0.2);
        }

        .error-message {
            color: var(--danger-red);
            font-size: 0.85rem;
            margin-top: 0.5rem;
        }

        .btn-primary {
            width: 100%;
            padding: 1rem;
            font-family: 'Orbitron', sans-serif;
            font-size: 1rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.1em;
            color: var(--midnight);
            background: linear-gradient(135deg, var(--neon-magenta), var(--neon-orange));
            border: none;
            border-radius: 10px;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 0 20px rgba(255, 0, 110, 0.4);
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 0 30px rgba(255, 0, 110, 0.6);
        }

        .auth-links {
            margin-top: 1.5rem;
            text-align: center;
        }

        .auth-links a {
            color: var(--neon-magenta);
            text-decoration: none;
            font-size: 0.9rem;
            transition: all 0.3s ease;
        }

        .auth-links a:hover {
            color: #ffffff;
            text-shadow: 0 0 10px rgba(255, 0, 110, 0.8);
        }

        .divider {
            margin: 1.5rem 0;
            text-align: center;
            color: rgba(255, 255, 255, 0.3);
            font-size: 0.85rem;
        }
    </style>

    <!-- Cyber background -->
    <div class="cyber-bg"></div>
    <div class="orb"></div>

    <div class="auth-container">
        <div class="auth-card">
            <h1 class="auth-title">Register</h1>
            <p class="auth-subtitle">Create your account</p>

            <form method="POST" action="{{ route('register') }}">
                @csrf

                <!-- Name -->
                <div class="form-group">
                    <label for="name">Name</label>
                    <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus autocomplete="name">
                    <x-input-error :messages="$errors->get('name')" class="error-message" />
                </div>

                <!-- Email Address -->
                <div class="form-group">
                    <label for="email">Email</label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="username">
                    <x-input-error :messages="$errors->get('email')" class="error-message" />
                </div>

                <!-- Password -->
                <div class="form-group">
                    <label for="password">Password</label>
                    <input id="password" type="password" name="password" required autocomplete="new-password">
                    <x-input-error :messages="$errors->get('password')" class="error-message" />
                </div>

                <!-- Confirm Password -->
                <div class="form-group">
                    <label for="password_confirmation">Confirm Password</label>
                    <input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password">
                    <x-input-error :messages="$errors->get('password_confirmation')" class="error-message" />
                </div>

                <button type="submit" class="btn-primary">
                    Create Account
                </button>

                <div class="auth-links">
                    <div class="divider">Already have an account?</div>
                    <a href="{{ route('login') }}">
                        Log In
                    </a>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>