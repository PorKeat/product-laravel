@extends('products.layout')

@section('title', 'Product List')

@push('styles')
<style>
    .container {
        max-width: 1400px;
        margin: 0 auto;
        padding: 3rem 2rem;
    }

    .header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 3rem;
        animation: fadeInDown 0.8s ease;
    }

    @keyframes fadeInDown {
        from { opacity: 0; transform: translateY(-30px); }
        to   { opacity: 1; transform: translateY(0); }
    }

    .page-title {
        font-family: 'Orbitron', sans-serif;
        font-size: clamp(2rem, 5vw, 3.5rem);
        font-weight: 900;
        background: linear-gradient(135deg, #ffffff 0%, var(--neon-cyan) 50%, var(--neon-magenta) 100%);
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
        50%       { background-position: 100% 50%; }
    }

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
        box-shadow: 0 0 20px rgba(0, 243, 255, 0.4), 0 4px 15px rgba(0, 0, 0, 0.3);
        text-decoration: none;
        display: inline-block;
        white-space: nowrap;
    }

    .cyber-button::before {
        content: '';
        position: absolute;
        top: 0; left: -100%;
        width: 100%; height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255,255,255,0.4), transparent);
        transition: left 0.5s ease;
    }

    .cyber-button:hover::before { left: 100%; }

    .cyber-button:hover {
        transform: translateY(-2px) scale(1.05);
        box-shadow: 0 0 30px rgba(0, 243, 255, 0.6), 0 6px 20px rgba(0, 0, 0, 0.4);
    }

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
        from { opacity: 0; transform: translateY(30px); }
        to   { opacity: 1; transform: translateY(0); }
    }

    table { width: 100%; border-collapse: collapse; }

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
        box-shadow: 0 4px 20px rgba(0, 243, 255, 0.1);
    }

    td {
        padding: 1.25rem 1.5rem;
        font-size: 0.95rem;
        color: rgba(255, 255, 255, 0.9);
        font-weight: 400;
        vertical-align: middle;
    }

    td:first-child {
        font-family: 'Orbitron', sans-serif;
        color: var(--neon-cyan);
        font-weight: 600;
    }

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
        white-space: nowrap;
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
        white-space: nowrap;
    }

    .btn-delete:hover {
        transform: translateY(-2px);
        box-shadow: 0 0 25px rgba(255, 0, 85, 0.5);
    }

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
        white-space: nowrap;
    }

    .stock-indicator {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
    }

    .stock-dot {
        width: 8px; height: 8px;
        border-radius: 50%;
        background: var(--success-green);
        box-shadow: 0 0 10px var(--success-green);
        animation: pulse-dot 2s ease-in-out infinite;
        flex-shrink: 0;
    }

    .stock-dot.low  { background: var(--neon-orange); box-shadow: 0 0 10px var(--neon-orange); }
    .stock-dot.out  { background: var(--danger-red);  box-shadow: 0 0 10px var(--danger-red); }

    @keyframes pulse-dot {
        0%, 100% { opacity: 1; }
        50%       { opacity: 0.5; }
    }

    .product-thumbnail {
        width: 60px; height: 60px;
        object-fit: cover;
        border-radius: 8px;
        border: 1px solid rgba(0, 243, 255, 0.3);
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.3);
        transition: all 0.3s ease;
        display: block;
    }

    .product-thumbnail:hover {
        transform: scale(1.5);
        box-shadow: 0 4px 20px rgba(0, 243, 255, 0.4);
        z-index: 10;
        position: relative;
    }

    .no-image {
        width: 60px; height: 60px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: rgba(0, 0, 0, 0.3);
        border-radius: 8px;
        border: 1px solid rgba(255, 255, 255, 0.1);
        font-size: 1.5rem;
        opacity: 0.5;
    }

    .empty-state {
        text-align: center;
        padding: 5rem 2rem;
        color: rgba(255, 255, 255, 0.4);
    }

    .empty-state-icon { font-size: 4rem; margin-bottom: 1rem; opacity: 0.3; }

    .empty-state-text {
        font-family: 'Outfit', sans-serif;
        font-size: 1.25rem;
        margin-bottom: 0.5rem;
        color: rgba(255, 255, 255, 0.5);
    }

    /* ── Delete Modal ── */
    .modal-overlay {
        display: none;
        position: fixed;
        inset: 0;
        background: rgba(0, 0, 0, 0.8);
        backdrop-filter: blur(10px);
        z-index: 1000;
        align-items: center;
        justify-content: center;
    }

    .modal-overlay.active { display: flex; }

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
            0 0 80px rgba(255, 0, 85, 0.15),
            inset 0 1px 0 rgba(255, 255, 255, 0.1);
        animation: modalSlideIn 0.4s cubic-bezier(0.34, 1.56, 0.64, 1);
    }

    @keyframes modalSlideIn {
        from { opacity: 0; transform: translateY(-40px) scale(0.92); }
        to   { opacity: 1; transform: translateY(0) scale(1); }
    }

    .modal-header {
        display: flex;
        align-items: center;
        gap: 1rem;
        margin-bottom: 1.5rem;
    }

    .modal-icon {
        width: 56px; height: 56px;
        background: rgba(255, 0, 85, 0.15);
        border: 2px solid var(--danger-red);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
        flex-shrink: 0;
        animation: pulse-warning 2s ease-in-out infinite;
    }

    @keyframes pulse-warning {
        0%, 100% { box-shadow: 0 0 20px rgba(255, 0, 85, 0.3); }
        50%       { box-shadow: 0 0 40px rgba(255, 0, 85, 0.6); }
    }

    .modal-title {
        font-family: 'Orbitron', sans-serif;
        font-size: 1.4rem;
        font-weight: 700;
        color: var(--danger-red);
        text-transform: uppercase;
        letter-spacing: 0.05em;
    }

    .modal-body { margin-bottom: 2rem; }

    .modal-text {
        font-family: 'Outfit', sans-serif;
        font-size: 1rem;
        line-height: 1.6;
        color: rgba(255, 255, 255, 0.75);
    }

    .modal-product-name {
        font-family: 'Orbitron', sans-serif;
        color: var(--neon-cyan);
        font-weight: 700;
        font-size: 1rem;
        padding: 0.75rem 1rem;
        background: rgba(0, 243, 255, 0.08);
        border: 1px solid rgba(0, 243, 255, 0.25);
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
        font-size: 0.9rem;
        font-weight: 600;
        color: rgba(255, 255, 255, 0.8);
        background: rgba(255, 255, 255, 0.05);
        border: 1px solid rgba(255, 255, 255, 0.15);
        border-radius: 10px;
        cursor: pointer;
        transition: all 0.25s ease;
        text-transform: uppercase;
        letter-spacing: 0.05em;
    }

    .btn-modal-cancel:hover {
        background: rgba(255, 255, 255, 0.1);
        border-color: rgba(255, 255, 255, 0.35);
        transform: translateY(-2px);
    }

    .btn-modal-delete {
        padding: 0.85rem 2rem;
        font-family: 'Outfit', sans-serif;
        font-size: 0.9rem;
        font-weight: 700;
        color: #ffffff;
        background: linear-gradient(135deg, var(--danger-red), #cc0044);
        border: none;
        border-radius: 10px;
        cursor: pointer;
        transition: all 0.25s ease;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        box-shadow: 0 0 20px rgba(255, 0, 85, 0.35);
    }

    .btn-modal-delete:hover {
        transform: translateY(-2px);
        box-shadow: 0 0 35px rgba(255, 0, 85, 0.6);
    }

    @media (max-width: 1024px) {
        .table-container { overflow-x: auto; }
        table { min-width: 800px; }
    }

    @media (max-width: 768px) {
        .container { padding: 2rem 1rem; }
        .header { flex-direction: column; align-items: flex-start; gap: 1rem; }
        .cyber-button { width: 100%; text-align: center; }
        th, td { padding: 1rem; font-size: 0.85rem; }
        .action-buttons { flex-direction: column; gap: 0.5rem; }
        .btn-edit, .btn-delete { width: 100%; text-align: center; }
        .modal-content { padding: 2rem 1.5rem; }
        .modal-actions { flex-direction: column-reverse; }
        .btn-modal-cancel, .btn-modal-delete { width: 100%; text-align: center; }
    }
</style>
@endpush

@section('content')
<div class="container">

    <div class="header">
        <h1 class="page-title">Product List</h1>
        <a href="/products/create" class="cyber-button">+ Create Product</a>
    </div>

    <div class="table-container">
        @if(count($products) > 0)
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Image</th>
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
                            <td>
                                @if($product->image)
                                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="product-thumbnail">
                                @else
                                    <div class="no-image">📷</div>
                                @endif
                            </td>
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
                                    >Delete</button>
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

{{-- Delete Confirmation Modal --}}
<div class="modal-overlay" id="deleteModal">
    <div class="modal-content">
        <div class="modal-header">
            <div class="modal-icon">⚠️</div>
            <h2 class="modal-title">Delete Product</h2>
        </div>
        <div class="modal-body">
            <p class="modal-text">Are you sure you want to delete this product? This action cannot be undone.</p>
            <div class="modal-product-name" id="modalProductName"></div>
        </div>
        <div class="modal-actions">
            <button type="button" class="btn-modal-cancel" onclick="closeDeleteModal()">Cancel</button>
            <button type="button" class="btn-modal-delete" onclick="confirmDelete()">Delete Product</button>
        </div>
    </div>
</div>

<form id="deleteForm" method="POST" style="display:none;">
    @csrf
    @method('DELETE')
</form>
@endsection

@push('scripts')
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

    document.getElementById('deleteModal').addEventListener('click', function (e) {
        if (e.target === this) closeDeleteModal();
    });

    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape') closeDeleteModal();
    });

    document.addEventListener('DOMContentLoaded', () => {
        document.querySelectorAll('tbody tr').forEach((row, i) => {
            row.style.opacity = '0';
            row.style.animation = `fadeInUp 0.5s ease ${0.4 + i * 0.07}s forwards`;
        });
    });
</script>
@endpush