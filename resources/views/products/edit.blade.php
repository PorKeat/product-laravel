<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Product - Product Management</title>
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
            background: var(--neon-magenta);
            top: 15%;
            left: 10%;
        }

        .orb-2 {
            width: 300px;
            height: 300px;
            background: var(--electric-blue);
            bottom: 20%;
            right: 15%;
            animation-delay: 10s;
        }

        @keyframes float-orb {
            0%, 100% { transform: translate(0, 0) scale(1); }
            33% { transform: translate(50px, -70px) scale(1.1); }
            66% { transform: translate(-40px, 60px) scale(0.9); }
        }

        /* Container */
        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 3rem 2rem;
        }

        /* Header section */
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 3rem;
            flex-wrap: wrap;
            gap: 1.5rem;
            animation: fadeInDown 0.8s ease;
        }

        @keyframes fadeInDown {
            from {
                opacity: 0;
                transform: translateY(-30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .page-title {
            font-family: 'Orbitron', sans-serif;
            font-size: clamp(2rem, 5vw, 3rem);
            font-weight: 900;
            background: linear-gradient(135deg, 
                #ffffff 0%, 
                var(--neon-orange) 50%, 
                var(--neon-magenta) 100%);
            background-size: 200% 200%;
            -webkit-background-clip: text;
            background-clip: text;
            -webkit-text-fill-color: transparent;
            animation: gradient-shift 4s ease infinite;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        @keyframes gradient-shift {
            0%, 100% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
        }

        /* Product ID badge */
        .product-id-badge {
            display: inline-block;
            padding: 0.5rem 1.25rem;
            background: rgba(255, 92, 0, 0.15);
            border: 1px solid var(--neon-orange);
            border-radius: 10px;
            color: var(--neon-orange);
            font-family: 'Orbitron', sans-serif;
            font-weight: 700;
            font-size: 0.85rem;
            letter-spacing: 0.1em;
            box-shadow: 0 0 15px rgba(255, 92, 0, 0.2);
        }

        /* Back button */
        .btn-back {
            padding: 0.85rem 2rem;
            font-family: 'Outfit', sans-serif;
            font-size: 0.95rem;
            font-weight: 600;
            color: rgba(255, 255, 255, 0.9);
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(0, 243, 255, 0.3);
            border-radius: 10px;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            backdrop-filter: blur(10px);
        }

        .btn-back:hover {
            background: rgba(0, 243, 255, 0.1);
            border-color: var(--neon-cyan);
            transform: translateX(-5px);
            box-shadow: 0 0 20px rgba(0, 243, 255, 0.3);
        }

        /* Form container */
        .form-container {
            background: rgba(10, 14, 39, 0.4);
            backdrop-filter: blur(20px) saturate(180%);
            border: 1px solid rgba(255, 92, 0, 0.3);
            border-radius: 20px;
            padding: 3rem;
            box-shadow: 
                0 8px 32px rgba(0, 0, 0, 0.4),
                inset 0 1px 0 rgba(255, 255, 255, 0.1),
                0 0 60px rgba(255, 92, 0, 0.05);
            animation: fadeInUp 0.8s ease 0.2s both;
            position: relative;
            overflow: hidden;
        }

        .form-container::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 2px;
            background: linear-gradient(90deg, transparent, var(--neon-orange), transparent);
            animation: scanTop 3s ease-in-out infinite;
        }

        @keyframes scanTop {
            0%, 100% { left: -100%; }
            50% { left: 100%; }
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Form elements */
        .form-group {
            margin-bottom: 2rem;
            animation: fadeInUp 0.6s ease both;
        }

        .form-group:nth-child(1) { animation-delay: 0.3s; }
        .form-group:nth-child(2) { animation-delay: 0.4s; }
        .form-group:nth-child(3) { animation-delay: 0.5s; }
        .form-group:nth-child(4) { animation-delay: 0.6s; }

        label {
            display: block;
            font-family: 'Orbitron', sans-serif;
            font-size: 0.85rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.1em;
            color: var(--neon-orange);
            margin-bottom: 0.75rem;
            text-shadow: 0 0 10px rgba(255, 92, 0, 0.3);
        }

        input[type="text"],
        input[type="number"],
        textarea {
            width: 100%;
            padding: 1rem 1.25rem;
            font-family: 'Outfit', sans-serif;
            font-size: 1rem;
            color: #ffffff;
            background: rgba(0, 0, 0, 0.3);
            border: 1px solid rgba(255, 92, 0, 0.2);
            border-radius: 10px;
            outline: none;
            transition: all 0.3s ease;
            backdrop-filter: blur(10px);
        }

        input[type="text"]::placeholder,
        input[type="number"]::placeholder,
        textarea::placeholder {
            color: rgba(255, 255, 255, 0.3);
        }

        input[type="text"]:focus,
        input[type="number"]:focus,
        textarea:focus {
            border-color: var(--neon-orange);
            background: rgba(255, 92, 0, 0.05);
            box-shadow: 
                0 0 20px rgba(255, 92, 0, 0.2),
                inset 0 0 20px rgba(255, 92, 0, 0.05);
            transform: translateY(-2px);
        }

        textarea {
            min-height: 120px;
            resize: vertical;
            font-family: 'Outfit', sans-serif;
        }

        /* Input icons/indicators */
        .input-wrapper {
            position: relative;
        }

        .input-icon {
            position: absolute;
            right: 1rem;
            top: 50%;
            transform: translateY(-50%);
            color: var(--neon-orange);
            opacity: 0.5;
            font-size: 1.2rem;
            pointer-events: none;
        }

        /* Edit indicator badge */
        .edit-indicator {
            position: absolute;
            top: -0.5rem;
            right: -0.5rem;
            background: var(--neon-orange);
            color: var(--midnight);
            padding: 0.35rem 0.85rem;
            border-radius: 20px;
            font-family: 'Orbitron', sans-serif;
            font-size: 0.7rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.1em;
            box-shadow: 0 0 20px rgba(255, 92, 0, 0.6);
            animation: pulse-badge 2s ease-in-out infinite;
        }

        @keyframes pulse-badge {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.05); }
        }

        /* Cyber update button */
        .btn-update {
            width: 100%;
            padding: 1.25rem 3rem;
            font-family: 'Orbitron', sans-serif;
            font-size: 1rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.15em;
            color: var(--midnight);
            background: linear-gradient(135deg, var(--neon-orange), #ff8c00);
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
            box-shadow: 
                0 0 20px rgba(255, 92, 0, 0.4),
                0 4px 15px rgba(0, 0, 0, 0.3);
            position: relative;
            margin-top: 1rem;
        }

        .btn-update::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.4), transparent);
            transition: left 0.5s ease;
        }

        .btn-update:hover::before {
            left: 100%;
        }

        .btn-update:hover {
            transform: translateY(-3px) scale(1.02);
            box-shadow: 
                0 0 40px rgba(255, 92, 0, 0.6),
                0 6px 25px rgba(0, 0, 0, 0.4);
        }

        .btn-update:active {
            transform: translateY(-1px) scale(1);
        }

        /* Form row for side-by-side inputs */
        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1.5rem;
            animation: fadeInUp 0.6s ease 0.7s both;
        }

        /* Modified label for edited fields */
        .modified-field label::after {
            content: '●';
            color: var(--neon-orange);
            margin-left: 0.5rem;
            animation: blink 2s ease-in-out infinite;
        }

        @keyframes blink {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.3; }
        }

        /* Responsive design */
        @media (max-width: 768px) {
            .container {
                padding: 2rem 1rem;
            }

            .form-container {
                padding: 2rem 1.5rem;
            }

            .header {
                flex-direction: column;
                align-items: flex-start;
            }

            .form-row {
                grid-template-columns: 1fr;
                gap: 2rem;
            }
        }

        /* Loading state */
        .btn-update.loading {
            pointer-events: none;
            opacity: 0.7;
        }

        .btn-update.loading::after {
            content: '';
            position: absolute;
            width: 20px;
            height: 20px;
            border: 3px solid transparent;
            border-top-color: var(--midnight);
            border-radius: 50%;
            animation: spin 0.8s linear infinite;
            top: 50%;
            right: 2rem;
            transform: translateY(-50%);
        }

        @keyframes spin {
            to { transform: translateY(-50%) rotate(360deg); }
        }

        /* Header info section */
        .header-info {
            display: flex;
            flex-direction: column;
            gap: 0.75rem;
        }
    </style>
</head>
<body>
    <!-- Cyber background -->
    <div class="cyber-bg"></div>

    <!-- Floating orbs -->
    <div class="orb orb-1"></div>
    <div class="orb orb-2"></div>

    <div class="container">
        <!-- Header -->
        <div class="header">
            <div class="header-info">
                <h1 class="page-title">Edit Product</h1>
                <span class="product-id-badge">ID: #{{ $product->id }}</span>
            </div>
            <a href="/products" class="btn-back">
                <span>⬅</span>
                <span>Back to List</span>
            </a>
        </div>

        <!-- Form Container -->
        <div class="form-container">
            <div class="edit-indicator">Editing Mode</div>
            
            <form method="POST" action="/products/{{ $product->id }}" id="productForm">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="name">Product Name</label>
                    <div class="input-wrapper">
                        <input 
                            type="text" 
                            id="name"
                            name="name" 
                            value="{{ $product->name }}"
                            placeholder="Enter product name"
                            required
                        >
                    </div>
                </div>

                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea 
                        id="description"
                        name="description" 
                        placeholder="Enter product description"
                        required
                    >{{ $product->description }}</textarea>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="price">Price ($)</label>
                        <div class="input-wrapper">
                            <input 
                                type="number" 
                                id="price"
                                name="price" 
                                value="{{ $product->price }}"
                                placeholder="0.00"
                                step="0.01"
                                min="0"
                                required
                            >
                            <span class="input-icon">$</span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="stock">Stock Quantity</label>
                        <div class="input-wrapper">
                            <input 
                                type="number" 
                                id="stock"
                                name="stock" 
                                value="{{ $product->stock }}"
                                placeholder="0"
                                min="0"
                                required
                            >
                            <span class="input-icon">📦</span>
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn-update" id="submitBtn">
                    Update Product
                </button>
            </form>
        </div>
    </div>

    <script>
        // Store original values
        const originalValues = {
            name: "{{ $product->name }}",
            description: "{{ $product->description }}",
            price: "{{ $product->price }}",
            stock: "{{ $product->stock }}"
        };

        // Track modified fields
        const inputs = document.querySelectorAll('input, textarea');
        inputs.forEach(input => {
            input.addEventListener('input', function() {
                const fieldName = this.name;
                const currentValue = this.value;
                const originalValue = originalValues[fieldName];
                
                // Add modified indicator if value changed
                if (currentValue !== originalValue) {
                    this.closest('.form-group').classList.add('modified-field');
                } else {
                    this.closest('.form-group').classList.remove('modified-field');
                }
            });

            // Focus effects
            input.addEventListener('focus', function() {
                this.parentElement.style.transform = 'scale(1.01)';
            });
            
            input.addEventListener('blur', function() {
                this.parentElement.style.transform = 'scale(1)';
            });
        });

        // Form submission animation
        const form = document.getElementById('productForm');
        const submitBtn = document.getElementById('submitBtn');

        form.addEventListener('submit', function(e) {
            submitBtn.classList.add('loading');
            submitBtn.textContent = 'Updating Product...';
        });

        // Auto-resize textarea
        const textarea = document.querySelector('textarea');
        textarea.addEventListener('input', function() {
            this.style.height = 'auto';
            this.style.height = this.scrollHeight + 'px';
        });

        // Initial resize for pre-filled content
        textarea.style.height = textarea.scrollHeight + 'px';
    </script>
</body>
</html>