@extends('products.layout')

@section('title', 'Create Product')

@push('styles')
<style>
    /* Orb color overrides for create page */
    .orb-1 {
        background: var(--neon-cyan);
        top: 15%;
        left: 10%;
    }

    .orb-2 {
        background: var(--neon-orange);
        bottom: 20%;
        right: 15%;
        animation-delay: 10s;
    }

    .container {
        max-width: 800px;
        margin: 0 auto;
        padding: 3rem 2rem;
    }

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
        from { opacity: 0; transform: translateY(-30px); }
        to   { opacity: 1; transform: translateY(0); }
    }

    .page-title {
        font-family: 'Orbitron', sans-serif;
        font-size: clamp(2rem, 5vw, 3rem);
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

    .form-container {
        background: rgba(10, 14, 39, 0.4);
        backdrop-filter: blur(20px) saturate(180%);
        border: 1px solid rgba(0, 243, 255, 0.2);
        border-radius: 20px;
        padding: 3rem;
        box-shadow:
            0 8px 32px rgba(0, 0, 0, 0.4),
            inset 0 1px 0 rgba(255, 255, 255, 0.1),
            0 0 60px rgba(0, 243, 255, 0.05);
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
        background: linear-gradient(90deg, transparent, var(--neon-cyan), transparent);
        animation: scanTop 3s ease-in-out infinite;
    }

    @keyframes scanTop {
        0%, 100% { left: -100%; }
        50%       { left: 100%; }
    }

    @keyframes fadeInUp {
        from { opacity: 0; transform: translateY(30px); }
        to   { opacity: 1; transform: translateY(0); }
    }

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
        color: var(--neon-cyan);
        margin-bottom: 0.75rem;
        text-shadow: 0 0 10px rgba(0, 243, 255, 0.3);
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
        border: 1px solid rgba(0, 243, 255, 0.2);
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
        border-color: var(--neon-cyan);
        background: rgba(0, 243, 255, 0.05);
        box-shadow: 0 0 20px rgba(0, 243, 255, 0.2), inset 0 0 20px rgba(0, 243, 255, 0.05);
        transform: translateY(-2px);
    }

    textarea {
        min-height: 120px;
        resize: vertical;
        font-family: 'Outfit', sans-serif;
    }

    .input-wrapper { position: relative; }

    .input-icon {
        position: absolute;
        right: 1rem;
        top: 50%;
        transform: translateY(-50%);
        color: var(--neon-cyan);
        opacity: 0.5;
        font-size: 1.2rem;
        pointer-events: none;
    }

    .btn-submit {
        width: 100%;
        padding: 1.25rem 3rem;
        font-family: 'Orbitron', sans-serif;
        font-size: 1rem;
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
        box-shadow: 0 0 20px rgba(0, 243, 255, 0.4), 0 4px 15px rgba(0, 0, 0, 0.3);
        position: relative;
        margin-top: 1rem;
    }

    .btn-submit::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.4), transparent);
        transition: left 0.5s ease;
    }

    .btn-submit:hover::before { left: 100%; }

    .btn-submit:hover {
        transform: translateY(-3px) scale(1.02);
        box-shadow: 0 0 40px rgba(0, 243, 255, 0.6), 0 6px 25px rgba(0, 0, 0, 0.4);
    }

    .btn-submit:active { transform: translateY(-1px) scale(1); }

    .form-row {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 1.5rem;
        animation: fadeInUp 0.6s ease 0.7s both;
    }

    .error-message {
        display: block;
        color: var(--danger-red);
        font-size: 0.85rem;
        margin-top: 0.5rem;
        font-weight: 500;
        animation: shake 0.3s ease;
    }

    @keyframes shake {
        0%, 100% { transform: translateX(0); }
        25%       { transform: translateX(-5px); }
        75%       { transform: translateX(5px); }
    }

    .file-input { display: none; }

    .file-label {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 1rem;
        padding: 1.5rem;
        background: rgba(0, 0, 0, 0.3);
        border: 2px dashed rgba(0, 243, 255, 0.3);
        border-radius: 10px;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .file-label:hover {
        border-color: var(--neon-cyan);
        background: rgba(0, 243, 255, 0.05);
        box-shadow: 0 0 20px rgba(0, 243, 255, 0.2);
    }

    .file-icon { font-size: 2rem; }

    .file-text {
        font-family: 'Outfit', sans-serif;
        font-size: 1rem;
        color: rgba(255, 255, 255, 0.7);
    }

    .image-preview { margin-top: 1rem; display: none; }
    .image-preview.active { display: block; }

    .image-preview img {
        max-width: 100%;
        max-height: 300px;
        border-radius: 10px;
        border: 1px solid rgba(0, 243, 255, 0.3);
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.3);
    }

    .btn-submit.loading {
        pointer-events: none;
        opacity: 0.7;
    }

    .btn-submit.loading::after {
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

    @media (max-width: 768px) {
        .container { padding: 2rem 1rem; }
        .form-container { padding: 2rem 1.5rem; }
        .header { flex-direction: column; align-items: flex-start; }
        .form-row { grid-template-columns: 1fr; gap: 2rem; }
    }
</style>
@endpush

@section('content')
<div class="container">
    <!-- Header -->
    <div class="header">
        <h1 class="page-title">Create Product</h1>
        <a href="/products" class="btn-back">
            <span>⬅</span>
            <span>Back to List</span>
        </a>
    </div>

    <!-- Form Container -->
    <div class="form-container">
        <form method="POST" action="/products" id="productForm" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
                <label for="name">Product Name</label>
                <div class="input-wrapper">
                    <input
                        type="text"
                        id="name"
                        name="name"
                        value="{{ old('name') }}"
                        placeholder="Enter product name"
                        required
                    >
                </div>
                @error('name')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="description">Description</label>
                <textarea
                    id="description"
                    name="description"
                    placeholder="Enter product description"
                    required
                >{{ old('description') }}</textarea>
                @error('description')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="image">Product Image</label>
                <div class="file-upload-wrapper">
                    <input
                        type="file"
                        id="image"
                        name="image"
                        accept="image/*"
                        class="file-input"
                    >
                    <label for="image" class="file-label">
                        <span class="file-icon">📷</span>
                        <span class="file-text">Choose Image</span>
                    </label>
                    <div id="imagePreview" class="image-preview"></div>
                </div>
                @error('image')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="price">Price ($)</label>
                    <div class="input-wrapper">
                        <input
                            type="number"
                            id="price"
                            name="price"
                            value="{{ old('price') }}"
                            placeholder="0.00"
                            step="0.01"
                            min="0"
                            required
                        >
                        <span class="input-icon">$</span>
                    </div>
                    @error('price')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="stock">Stock Quantity</label>
                    <div class="input-wrapper">
                        <input
                            type="number"
                            id="stock"
                            name="stock"
                            value="{{ old('stock') }}"
                            placeholder="0"
                            min="0"
                            required
                        >
                        <span class="input-icon">📦</span>
                    </div>
                    @error('stock')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <button type="submit" class="btn-submit" id="submitBtn">
                Save Product
            </button>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
    const form      = document.getElementById('productForm');
    const submitBtn = document.getElementById('submitBtn');

    form.addEventListener('submit', function () {
        submitBtn.classList.add('loading');
        submitBtn.textContent = 'Creating Product...';
    });

    document.querySelectorAll('input, textarea').forEach(input => {
        input.addEventListener('focus', function () {
            this.parentElement.style.transform = 'scale(1.01)';
        });
        input.addEventListener('blur', function () {
            this.parentElement.style.transform = 'scale(1)';
        });
    });

    const textarea = document.querySelector('textarea');
    textarea.addEventListener('input', function () {
        this.style.height = 'auto';
        this.style.height = this.scrollHeight + 'px';
    });

    const imageInput   = document.getElementById('image');
    const imagePreview = document.getElementById('imagePreview');
    const fileLabel    = document.querySelector('.file-label');
    const fileText     = document.querySelector('.file-text');

    imageInput.addEventListener('change', function (e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function (e) {
                imagePreview.innerHTML = `<img src="${e.target.result}" alt="Preview">`;
                imagePreview.classList.add('active');
                fileText.textContent = file.name;
                fileLabel.style.borderColor = 'var(--neon-cyan)';
            };
            reader.readAsDataURL(file);
        } else {
            imagePreview.innerHTML = '';
            imagePreview.classList.remove('active');
            fileText.textContent = 'Choose Image';
            fileLabel.style.borderColor = 'rgba(0, 243, 255, 0.3)';
        }
    });
</script>
@endpush