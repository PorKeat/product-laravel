<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product List - Product Management</title>
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

        /* Container */
        .container {
            max-width: 1400px;
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
            font-size: clamp(2rem, 5vw, 3.5rem);
            font-weight: 900;
            background: linear-gradient(135deg, 
                #ffffff 0%, 
                var(--neon-cyan) 50%, 
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

        /* Header buttons container */
        .header-buttons {
            display: flex;
            gap: 1rem;
            align-items: center;
        }

        /* Cyber button */
        .cyber-button {
            position: relative;
            padding: 1rem 2.5rem;
            font-family: 'Orbitron', sans-serif;
            font-size: 0.95rem;
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
                calc(100% - 15px) 0,
                100% 15px,
                100% 100%,
                15px 100%,
                0 calc(100% - 15px)
            );
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            box-shadow: 
                0 0 20px rgba(0, 243, 255, 0.4),
                0 4px 15px rgba(0, 0, 0, 0.3);
            text-decoration: none;
            display: inline-block;
        }

        .cyber-button::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.4), transparent);
            transition: left 0.5s ease;
        }

        .cyber-button:hover::before {
            left: 100%;
        }

        .cyber-button:hover {
            transform: translateY(-2px) scale(1.05);
            box-shadow: 
                0 0 30px rgba(0, 243, 255, 0.6),
                0 6px 20px rgba(0, 0, 0, 0.4);
        }

        .cyber-button:active {
            transform: translateY(0) scale(1);
        }

        /* Home button - modern icon style */
        .btn-home {
            width: 48px;
            height: 48px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(0, 243, 255, 0.3);
            border-radius: 12px;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            backdrop-filter: blur(10px);
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--neon-cyan);
        }

        .btn-home:hover {
            background: rgba(0, 243, 255, 0.15);
            border-color: var(--neon-cyan);
            transform: translateX(-5px);
            box-shadow: 0 0 25px rgba(0, 243, 255, 0.4);
        }

        .btn-home:active {
            transform: translateX(-2px);
        }

        /* Table container */
        .table-container {
            background: rgba(10, 14, 39, 0.4);
            backdrop-filter: blur(20px) saturate(180%);
            border: 1px solid rgba(0, 243, 255, 0.2);
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 
                0 8px 32px rgba(0, 0, 0, 0.4),
                inset 0 1px 0 rgba(255, 255, 255, 0.1),
                0 0 60px rgba(0, 243, 255, 0.05);
            animation: fadeInUp 0.8s ease 0.2s both;
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

        /* Table */
        table {
            width: 100%;
            border-collapse: collapse;
        }

        thead {
            background: rgba(0, 243, 255, 0.05);
            border-bottom: 2px solid rgba(0, 243, 255, 0.3);
        }

        th {
            padding: 1.25rem 1.5rem;
            text-align: left;
            font-family: 'Orbitron', sans-serif;
            font-weight: 700;
            font-size: 0.85rem;
            text-transform: uppercase;
            letter-spacing: 0.1em;
            color: var(--neon-cyan);
            text-shadow: 0 0 10px rgba(0, 243, 255, 0.5);
        }

        tbody tr {
            border-bottom: 1px solid rgba(255, 255, 255, 0.05);
            transition: all 0.3s ease;
        }

        tbody tr:hover {
            background: rgba(0, 243, 255, 0.05);
            transform: scale(1.01);
            box-shadow: 0 4px 20px rgba(0, 243, 255, 0.1);
        }

        td {
            padding: 1.25rem 1.5rem;
            font-size: 0.95rem;
            color: rgba(255, 255, 255, 0.9);
            font-weight: 400;
        }

        td:first-child {
            font-family: 'Orbitron', sans-serif;
            color: var(--neon-cyan);
            font-weight: 600;
        }

        /* Action buttons */
        .action-buttons {
            display: flex;
            gap: 0.75rem;
            align-items: center;
        }

        .btn-edit {
            padding: 0.5rem 1.25rem;
            font-family: 'Outfit', sans-serif;
            font-size: 0.85rem;
            font-weight: 600;
            color: var(--midnight);
            background: linear-gradient(135deg, var(--neon-orange), #ff8c00);
            border: none;
            border-radius: 6px;
            cursor: pointer;
            text-decoration: none;
            transition: all 0.3s ease;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            box-shadow: 0 0 15px rgba(255, 92, 0, 0.3);
        }

        .btn-edit:hover {
            transform: translateY(-2px);
            box-shadow: 0 0 25px rgba(255, 92, 0, 0.5);
        }

        .btn-delete {
            padding: 0.5rem 1.25rem;
            font-family: 'Outfit', sans-serif;
            font-size: 0.85rem;
            font-weight: 600;
            color: #ffffff;
            background: linear-gradient(135deg, var(--danger-red), #cc0044);
            border: none;
            border-radius: 6px;
            cursor: pointer;
            transition: all 0.3s ease;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            box-shadow: 0 0 15px rgba(255, 0, 85, 0.3);
        }

        .btn-delete:hover {
            transform: translateY(-2px);
            box-shadow: 0 0 25px rgba(255, 0, 85, 0.5);
        }

        /* Price badge */
        .price-badge {
            display: inline-block;
            padding: 0.35rem 0.85rem;
            background: rgba(0, 243, 255, 0.15);
            border: 1px solid var(--neon-cyan);
            border-radius: 8px;
            color: var(--neon-cyan);
            font-family: 'Orbitron', sans-serif;
            font-weight: 700;
            font-size: 0.9rem;
        }

        /* Stock indicator */
        .stock-indicator {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }

        .stock-dot {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background: var(--success-green);
            box-shadow: 0 0 10px var(--success-green);
            animation: pulse-dot 2s ease-in-out infinite;
        }

        .stock-dot.low {
            background: var(--neon-orange);
            box-shadow: 0 0 10px var(--neon-orange);
        }

        .stock-dot.out {
            background: var(--danger-red);
            box-shadow: 0 0 10px var(--danger-red);
        }

        @keyframes pulse-dot {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.5; }
        }

        /* Responsive design */
        @media (max-width: 1024px) {
            .table-container {
                overflow-x: auto;
            }

            table {
                min-width: 800px;
            }
        }

        @media (max-width: 768px) {
            .container {
                padding: 2rem 1rem;
            }

            .header {
                flex-direction: column;
                align-items: flex-start;
            }

            .header-buttons {
                width: 100%;
                flex-direction: row;
                justify-content: space-between;
            }

            .cyber-button {
                flex: 1;
            }

            th, td {
                padding: 1rem;
                font-size: 0.85rem;
            }

            .action-buttons {
                flex-direction: column;
                gap: 0.5rem;
            }

            .btn-edit, .btn-delete {
                width: 100%;
                text-align: center;
            }

            .modal-content {
                padding: 2rem 1.5rem;
            }

            .modal-actions {
                flex-direction: column-reverse;
            }

            .btn-modal-cancel,
            .btn-modal-delete {
                width: 100%;
            }
        }

        /* Empty state */
        .empty-state {
            text-align: center;
            padding: 4rem 2rem;
            color: rgba(255, 255, 255, 0.5);
        }

        .empty-state-icon {
            font-size: 4rem;
            margin-bottom: 1rem;
            opacity: 0.3;
        }

        .empty-state-text {
            font-family: 'Outfit', sans-serif;
            font-size: 1.25rem;
            margin-bottom: 0.5rem;
        }

        /* Delete Modal */
        .modal-overlay {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, 0.8);
            backdrop-filter: blur(10px);
            z-index: 1000;
            align-items: center;
            justify-content: center;
            animation: fadeIn 0.3s ease;
        }

        .modal-overlay.active {
            display: flex;
        }

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        .modal-content {
            background: rgba(10, 14, 39, 0.95);
            backdrop-filter: blur(30px) saturate(180%);
            border: 1px solid rgba(255, 0, 85, 0.4);
            border-radius: 20px;
            padding: 2.5rem;
            max-width: 500px;
            width: 90%;
            box-shadow: 
                0 20px 60px rgba(0, 0, 0, 0.6),
                0 0 80px rgba(255, 0, 85, 0.2),
                inset 0 1px 0 rgba(255, 255, 255, 0.1);
            animation: modalSlideIn 0.4s cubic-bezier(0.34, 1.56, 0.64, 1);
            position: relative;
        }

        @keyframes modalSlideIn {
            from {
                opacity: 0;
                transform: translateY(-50px) scale(0.9);
            }
            to {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }

        .modal-header {
            display: flex;
            align-items: center;
            gap: 1rem;
            margin-bottom: 1.5rem;
        }

        .modal-icon {
            width: 60px;
            height: 60px;
            background: rgba(255, 0, 85, 0.2);
            border: 2px solid var(--danger-red);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.75rem;
            animation: pulse-warning 2s ease-in-out infinite;
        }

        @keyframes pulse-warning {
            0%, 100% {
                box-shadow: 0 0 20px rgba(255, 0, 85, 0.4);
            }
            50% {
                box-shadow: 0 0 40px rgba(255, 0, 85, 0.7);
            }
        }

        .modal-title {
            font-family: 'Orbitron', sans-serif;
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--danger-red);
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        .modal-body {
            margin-bottom: 2rem;
        }

        .modal-text {
            font-family: 'Outfit', sans-serif;
            font-size: 1rem;
            line-height: 1.6;
            color: rgba(255, 255, 255, 0.8);
            margin-bottom: 1rem;
        }

        .modal-product-name {
            font-family: 'Orbitron', sans-serif;
            color: var(--neon-cyan);
            font-weight: 700;
            font-size: 1.1rem;
            padding: 0.75rem 1rem;
            background: rgba(0, 243, 255, 0.1);
            border: 1px solid rgba(0, 243, 255, 0.3);
            border-radius: 8px;
            margin-top: 1rem;
        }

        .modal-actions {
            display: flex;
            gap: 1rem;
            justify-content: flex-end;
        }

        .btn-modal-cancel {
            padding: 0.85rem 2rem;
            font-family: 'Outfit', sans-serif;
            font-size: 0.95rem;
            font-weight: 600;
            color: rgba(255, 255, 255, 0.9);
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 10px;
            cursor: pointer;
            transition: all 0.3s ease;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        .btn-modal-cancel:hover {
            background: rgba(255, 255, 255, 0.1);
            border-color: rgba(255, 255, 255, 0.4);
            transform: translateY(-2px);
        }

        .btn-modal-delete {
            padding: 0.85rem 2rem;
            font-family: 'Outfit', sans-serif;
            font-size: 0.95rem;
            font-weight: 700;
            color: #ffffff;
            background: linear-gradient(135deg, var(--danger-red), #cc0044);
            border: none;
            border-radius: 10px;
            cursor: pointer;
            transition: all 0.3s ease;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            box-shadow: 0 0 20px rgba(255, 0, 85, 0.4);
        }

        .btn-modal-delete:hover {
            transform: translateY(-2px);
            box-shadow: 0 0 35px rgba(255, 0, 85, 0.6);
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
            <h1 class="page-title">Product List</h1>
            <div class="header-buttons">
                <a href="/" class="btn-home" title="Back to Home">
                    ←
                </a>
                <a href="/products/create" class="cyber-button">
                    + Create Product
                </a>
            </div>
        </div>

        <!-- Success Message -->
        @if(session('success'))
            <div class="success-message">
                ✓ {{ session('success') }}
            </div>
        @endif

        <!-- Products Table -->
        <div class="table-container">
            @if(count($products) > 0)
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Price</th>
                            <th>Stock</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $product)
                            <tr>
                                <td>#{{ $product->id }}</td>
                                <td><strong>{{ $product->name }}</strong></td>
                                <td>{{ $product->description }}</td>
                                <td>
                                    <span class="price-badge">${{ number_format($product->price, 2) }}</span>
                                </td>
                                <td>
                                    <div class="stock-indicator">
                                        <span class="stock-dot {{ $product->stock == 0 ? 'out' : ($product->stock < 10 ? 'low' : '') }}"></span>
                                        <span>{{ $product->stock }}</span>
                                    </div>
                                </td>
                                <td>
                                    <div class="action-buttons">
                                        <a href="/products/{{ $product->id }}/edit" class="btn-edit">Edit</a>
                                        <button 
                                            type="button" 
                                            class="btn-delete" 
                                            onclick="openDeleteModal({{ $product->id }}, '{{ addslashes($product->name) }}')"
                                        >
                                            Delete
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <div class="empty-state">
                    <div class="empty-state-icon">📦</div>
                    <div class="empty-state-text">No products yet</div>
                    <p>Create your first product to get started</p>
                </div>
            @endif
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div class="modal-overlay" id="deleteModal">
        <div class="modal-content">
            <div class="modal-header">
                <div class="modal-icon">⚠️</div>
                <h2 class="modal-title">Delete Product</h2>
            </div>
            <div class="modal-body">
                <p class="modal-text">
                    Are you sure you want to delete this product? This action cannot be undone.
                </p>
                <div class="modal-product-name" id="modalProductName"></div>
            </div>
            <div class="modal-actions">
                <button type="button" class="btn-modal-cancel" onclick="closeDeleteModal()">
                    Cancel
                </button>
                <button type="button" class="btn-modal-delete" onclick="confirmDelete()">
                    Delete Product
                </button>
            </div>
        </div>
    </div>

    <!-- Hidden form for delete -->
    <form id="deleteForm" method="POST" style="display: none;">
        @csrf
        @method('DELETE')
    </form>

    <script>
        let productToDelete = null;

        function openDeleteModal(productId, productName) {
            productToDelete = productId;
            document.getElementById('modalProductName').textContent = productName;
            document.getElementById('deleteModal').classList.add('active');
            document.body.style.overflow = 'hidden';
        }

        function closeDeleteModal() {
            document.getElementById('deleteModal').classList.remove('active');
            document.body.style.overflow = 'auto';
            productToDelete = null;
        }

        function confirmDelete() {
            if (productToDelete) {
                const form = document.getElementById('deleteForm');
                form.action = `/products/${productToDelete}`;
                form.submit();
            }
        }

        // Close modal on overlay click
        document.getElementById('deleteModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeDeleteModal();
            }
        });

        // Close modal on Escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeDeleteModal();
            }
        });

        // Add stagger animation to table rows
        document.addEventListener('DOMContentLoaded', () => {
            const rows = document.querySelectorAll('tbody tr');
            rows.forEach((row, index) => {
                row.style.opacity = '0';
                row.style.animation = `fadeInUp 0.5s ease ${0.4 + (index * 0.1)}s forwards`;
            });
        });
    </script>
</body>
</html>