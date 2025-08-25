@extends('admin.layout.app')
@section('title', 'Edit Product')

@section('content')
<!-- Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<!-- Quill Rich Text Editor -->
<link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
<script src="https://cdn.quilljs.com/1.3.6/quill.min.js"></script>

<style>
    :root {
        --primary-color: #FC5F49;
        --primary-light: #FD7A67;
        --primary-lighter: #FE9585;
        --primary-lightest: #FFF0EE;
        --primary-dark: #E04732;
        --background: #F8F9FA;
        --white: #FFFFFF;
        --text-dark: #2D3748;
        --text-medium: #4A5568;
        --text-light: #718096;
        --border-light: #E2E8F0;
        --success: #48BB78;
        --warning: #ED8936;
        --danger: #F56565;
        --info: #4299E1;
    }

    .edit-container {
        background-color: var(--background);
        min-height: 100vh;
        padding: 2rem 0;
    }

    .page-header {
        background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-light) 100%);
        color: var(--white);
        padding: 2rem;
        border-radius: 16px;
        margin-bottom: 2rem;
    }

    .page-title {
        font-size: 1.75rem;
        font-weight: 700;
        margin-bottom: 0.5rem;
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }

    .page-subtitle {
        opacity: 0.85;
        font-size: 1rem;
        margin: 0;
    }

    .breadcrumb-custom {
        background: var(--white);
        padding: 1rem 1.5rem;
        border-radius: 12px;
        margin-bottom: 1.5rem;
        border: 1px solid var(--border-light);
    }

    .breadcrumb-custom .breadcrumb-item a {
        color: var(--primary-color);
        text-decoration: none;
    }

    .breadcrumb-custom .breadcrumb-item.active {
        color: var(--text-medium);
    }

    .form-container {
        background: var(--white);
        border-radius: 16px;
        padding: 2rem;
        box-shadow: 0 1px 3px rgba(252, 95, 73, 0.08);
    }

    .form-label {
        font-weight: 600;
        color: var(--text-medium);
        margin-bottom: 0.5rem;
    }

    .form-control {
        border: 1px solid var(--border-light);
        border-radius: 8px;
        padding: 0.75rem;
        transition: border-color 0.2s ease;
        font-size: 0.9rem;
    }

    .form-control:focus {
        outline: none;
        border-color: var(--primary-color);
        box-shadow: 0 0 0 3px rgba(252, 95, 73, 0.1);
    }

    .form-control.is-invalid {
        border-color: var(--danger);
    }

    .invalid-feedback {
        color: var(--danger);
        font-size: 0.875rem;
        margin-top: 0.25rem;
    }

    .btn-warning-custom {
        background: var(--primary-color);
        border: 1px solid var(--primary-color);
        color: var(--white);
        padding: 0.75rem 1.5rem;
        border-radius: 10px;
        font-weight: 500;
        transition: all 0.2s ease;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        text-decoration: none;
    }

    .btn-warning-custom:hover {
        background: var(--primary-dark);
        border-color: var(--primary-dark);
        color: var(--white);
        transform: translateY(-1px);
        text-decoration: none;
    }

    .btn-secondary-custom {
        background: var(--background);
        border: 1px solid var(--border-light);
        color: var(--text-medium);
        padding: 0.75rem 1.5rem;
        border-radius: 10px;
        font-weight: 500;
        transition: all 0.2s ease;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
    }

    .btn-secondary-custom:hover {
        background: var(--border-light);
        color: var(--text-dark);
        text-decoration: none;
    }

    .current-image-container {
        position: relative;
        display: inline-block;
        margin-bottom: 1rem;
    }

    .current-image {
        width: 200px;
        height: 200px;
        object-fit: cover;
        border-radius: 12px;
        border: 1px solid var(--border-light);
    }

    .change-image-overlay {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(0, 0, 0, 0.7);
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        opacity: 0;
        transition: opacity 0.2s ease;
        cursor: pointer;
        color: white;
    }

    .current-image-container:hover .change-image-overlay {
        opacity: 1;
    }

    .image-upload-area {
        border: 2px dashed var(--border-light);
        border-radius: 12px;
        padding: 2rem;
        text-align: center;
        transition: all 0.2s ease;
        background: var(--background);
        cursor: pointer;
        position: relative;
    }

    .image-upload-area:hover {
        border-color: var(--primary-color);
        background: var(--primary-lightest);
    }

    .image-upload-area.dragover {
        border-color: var(--primary-color);
        background: var(--primary-lightest);
    }

    .upload-icon {
        font-size: 3rem;
        color: var(--text-light);
        margin-bottom: 1rem;
    }

    .upload-text {
        color: var(--text-medium);
        margin-bottom: 0.5rem;
    }

    .upload-hint {
        color: var(--text-light);
        font-size: 0.875rem;
    }

    .image-upload-container {
        position: relative;
    }

    .image-previews-container {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
        gap: 1rem;
        margin-top: 1rem;
    }

    .image-preview-item {
        position: relative;
        width: 150px;
        height: 150px;
        border-radius: 12px;
        overflow: hidden;
        border: 3px solid var(--border-light);
        background: var(--background);
        cursor: move;
        transition: all 0.2s ease;
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    }

    .image-preview-item:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0,0,0,0.15);
    }

    .image-preview-item.dragging {
        opacity: 0.5;
        transform: rotate(5deg);
    }

    .image-preview-item img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .image-preview-item .image-controls {
        position: absolute;
        top: 8px;
        right: 8px;
        display: flex;
        gap: 5px;
        flex-direction: column;
    }

    .image-preview-item .control-btn {
        background: rgba(0,0,0,0.7);
        color: white;
        border: none;
        border-radius: 50%;
        width: 28px;
        height: 28px;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        font-size: 12px;
        transition: all 0.2s;
        backdrop-filter: blur(4px);
    }

    .image-preview-item .control-btn:hover {
        background: rgba(0,0,0,0.9);
        transform: scale(1.1);
    }

    .image-preview-item .remove-btn {
        background: var(--danger);
    }

    .image-preview-item .remove-btn:hover {
        background: #dc3545;
    }

    .image-preview-item .thumbnail-btn {
        background: rgba(255,193,7,0.9);
        color: #333;
    }

    .image-preview-item .thumbnail-btn.active {
        background: #ffc107;
        color: #000;
    }

    .image-preview-item .thumbnail-btn:hover {
        background: #ffc107;
        color: #000;
    }

    .image-preview-item.primary {
        border-color: var(--primary-color);
        box-shadow: 0 0 0 2px rgba(252, 95, 73, 0.2);
    }

    .image-preview-item .primary-badge {
        position: absolute;
        bottom: 8px;
        left: 8px;
        background: var(--primary-color);
        color: white;
        font-size: 10px;
        padding: 4px 8px;
        border-radius: 12px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        box-shadow: 0 2px 4px rgba(0,0,0,0.2);
    }

    .image-preview-item .image-index {
        position: absolute;
        top: 8px;
        left: 8px;
        background: rgba(0,0,0,0.7);
        color: white;
        border-radius: 50%;
        width: 24px;
        height: 24px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 11px;
        font-weight: 600;
    }

    .image-controls {
        padding: 0.75rem;
        background: var(--primary-lightest);
        border-radius: 8px;
        border-left: 4px solid var(--primary-color);
    }

    .max-images-warning {
        background: rgba(255, 193, 7, 0.1);
        border: 1px solid #ffc107;
        color: #856404;
        padding: 0.75rem;
        border-radius: 8px;
        margin-top: 1rem;
        font-size: 0.875rem;
    }

    .existing-images-section {
        margin-bottom: 2rem;
        padding: 1rem;
        background: var(--background);
        border-radius: 12px;
        border: 1px solid var(--border-light);
    }

    .new-images-section {
        margin-top: 2rem;
        padding: 1rem;
        background: var(--white);
        border-radius: 12px;
        border: 1px solid var(--border-light);
    }

    .new-image-preview {
        max-width: 200px;
        max-height: 200px;
        border-radius: 8px;
        border: 1px solid var(--border-light);
        margin: 1rem auto;
        display: none;
    }

    .alert-custom {
        border: none;
        border-radius: 12px;
        padding: 1rem 1.5rem;
        margin-bottom: 1.5rem;
    }

    .alert-danger {
        background: rgba(245, 101, 101, 0.1);
        color: var(--danger);
        border-left: 4px solid var(--danger);
    }

    .form-actions {
        background: var(--background);
        margin: 2rem -2rem -2rem;
        padding: 1.5rem 2rem;
        border-radius: 0 0 16px 16px;
        display: flex;
        gap: 1rem;
        justify-content: flex-end;
    }

    .product-info {
        background: var(--primary-lightest);
        padding: 1rem 1.5rem;
        border-radius: 12px;
        margin-bottom: 2rem;
        border-left: 4px solid var(--primary-color);
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .edit-container {
            padding: 1rem 0;
        }
        
        .page-header {
            padding: 1.5rem;
            text-align: center;
        }
        
        .page-title {
            font-size: 1.5rem;
            justify-content: center;
        }
        
        .form-container {
            padding: 1.5rem;
        }

        .form-actions {
            margin: 2rem -1.5rem -1.5rem;
            padding: 1rem 1.5rem;
            flex-direction: column;
        }

        .current-image {
            width: 150px;
            height: 150px;
        }
    }

    /* Quill Rich Text Editor Styles */
    .ql-editor {
        min-height: 120px;
        font-size: 14px;
        line-height: 1.6;
    }

    .ql-toolbar {
        border-top: 1px solid var(--border-light);
        border-left: 1px solid var(--border-light);
        border-right: 1px solid var(--border-light);
        border-radius: 8px 8px 0 0;
        background: #f8f9fa;
    }

    .ql-container {
        border-bottom: 1px solid var(--border-light);
        border-left: 1px solid var(--border-light);
        border-right: 1px solid var(--border-light);
        border-radius: 0 0 8px 8px;
        font-family: inherit;
    }

    .ql-toolbar .ql-picker-label {
        color: var(--text-medium);
    }

    .ql-toolbar .ql-stroke {
        stroke: var(--text-medium);
    }

    .ql-toolbar .ql-fill {
        fill: var(--text-medium);
    }

    .ql-toolbar button:hover .ql-stroke,
    .ql-toolbar button:focus .ql-stroke,
    .ql-toolbar button.ql-active .ql-stroke {
        stroke: var(--primary-color);
    }

    .ql-toolbar button:hover .ql-fill,
    .ql-toolbar button:focus .ql-fill,
    .ql-toolbar button.ql-active .ql-fill {
        fill: var(--primary-color);
    }

    .ql-toolbar button:hover,
    .ql-toolbar button:focus,
    .ql-toolbar button.ql-active {
        color: var(--primary-color);
    }

    .editor-container {
        position: relative;
    }

    .editor-container.is-invalid .ql-toolbar,
    .editor-container.is-invalid .ql-container {
        border-color: var(--danger);
    }

    .editor-container.is-invalid + .invalid-feedback {
        display: block;
    }

    #description-editor {
        background: white;
    }

    .ql-snow .ql-tooltip {
        z-index: 1050;
    }
</style>

<div class="edit-container">
    <div class="container-fluid">
        <!-- Breadcrumb -->
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb breadcrumb-custom">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.products.index') }}">Products</a></li>
                <li class="breadcrumb-item active" aria-current="page">Edit Product</li>
            </ol>
        </nav>

        <!-- Page Header -->
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col-12">
                    <h1 class="page-title">
                        <i class="fas fa-edit"></i>
                        Edit Product
                    </h1>
                    <p class="page-subtitle">Update product information and details</p>
                </div>
            </div>
        </div>

        <!-- Product Info -->
        <div class="product-info">
            <h6><i class="fas fa-info-circle"></i> Editing Product</h6>
            <p class="mb-0">
                <strong>{{ $product->name }}</strong> (ID: #{{ $product->id }}) | 
                Created: {{ $product->created_at}} | 
                Last Updated: {{ $product->updated_at}}
            </p>
        </div>

        <!-- Error Messages -->
        @if ($errors->any())
            <div class="alert alert-danger alert-custom">
                <h6><i class="fas fa-exclamation-triangle"></i> Please fix the following errors:</h6>
                <ul class="mb-0 mt-2">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Edit Form -->
        <div class="form-container">
            <form action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data" id="editProductForm">
                @csrf
                @method('PUT')
                
                <div class="row">
                    <!-- Product Name -->
                    <div class="col-md-6 mb-3">
                        <label for="name" class="form-label">Product Name <span class="text-danger">*</span></label>
                        <input type="text" 
                               class="form-control @error('name') is-invalid @enderror" 
                               id="name" 
                               name="name" 
                               value="{{ old('name', $product->name) }}" 
                               required 
                               placeholder="Enter product name">
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Category -->
                    <div class="col-md-6 mb-3">
                        <label for="category_id" class="form-label">Category <span class="text-danger">*</span></label>
                        <select class="form-control @error('category_id') is-invalid @enderror" 
                                id="category_id" 
                                name="category_id" 
                                required>
                            <option value="">Select Category</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" 
                                    {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- Description -->
                <div class="mb-3">
                    <label for="description" class="form-label">Description <span class="text-danger">*</span></label>
                    <div class="editor-container @error('description') is-invalid @enderror">
                        <div id="description-editor" style="min-height: 150px;">{!! old('description', $product->description) !!}</div>
                        <textarea name="description" id="description" class="d-none" required>{{ old('description', $product->description) }}</textarea>
                    </div>
                    @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <small class="text-muted mt-1">Use the toolbar above to format your product description with bold text, colors, lists, and more.</small>
                </div>

                <div class="row">
                    <!-- Price -->
                    <div class="col-md-6 mb-3">
                        <label for="price" class="form-label">Price (PKR) <span class="text-danger">*</span></label>
                        <input type="number" 
                               class="form-control @error('price') is-invalid @enderror" 
                               id="price" 
                               name="price" 
                               step="0.01" 
                               min="0" 
                               value="{{ old('price', $product->price) }}" 
                               required 
                               placeholder="0.00">
                        @error('price')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Stock -->
                    <div class="col-md-6 mb-3">
                        <label for="stock" class="form-label">Stock Quantity <span class="text-danger">*</span></label>
                        <input type="number" 
                               class="form-control @error('stock') is-invalid @enderror" 
                               id="stock" 
                               name="stock" 
                               min="0" 
                               value="{{ old('stock', $product->stock) }}" 
                               required 
                               placeholder="0">
                        @error('stock')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- Product Images Upload (Max 4 Images) -->
                <div class="mb-3">
                    <label for="images" class="form-label">Product Images <span class="text-danger">*</span></label>
                    
                    <!-- Existing Images -->
                    @if($product->images && $product->images->count() > 0)
                        <div class="existing-images-section">
                            <h6 class="text-muted mb-3">Current Images</h6>
                            <div id="existing-images-container" class="image-previews-container">
                                @foreach($product->images->sortBy('sort_order') as $index => $image)
                                    <div class="image-preview-item existing-image-item {{ $image->is_primary ? 'primary' : '' }}" 
                                         data-image-id="{{ $image->id }}" 
                                         data-index="{{ $index }}">
                                        <img src="{{ asset('storage/' . $image->image_path) }}" alt="{{ $image->alt_text }}">
                                        <div class="image-controls">
                                            <button type="button" class="control-btn remove-btn" onclick="removeExistingImage({{ $image->id }}, this)">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                            <button type="button" class="control-btn thumbnail-btn {{ $image->is_primary ? 'active' : '' }}" 
                                                    onclick="setExistingThumbnail({{ $index }}, this)">
                                                <i class="fas fa-star"></i>
                                            </button>
                                        </div>
                                        @if($image->is_primary)
                                            <div class="primary-badge">Primary</div>
                                        @endif
                                        <div class="image-index">{{ $index + 1 }}</div>
                                    </div>
                                @endforeach
                            </div>
                            
                            <!-- Hidden inputs for removed images -->
                            <div id="removed-images-inputs"></div>
                            
                            <!-- Hidden input for existing thumbnail selection -->
                            <input type="hidden" id="existing_thumbnail_index" name="existing_thumbnail_index" 
                                   value="{{ $product->images->where('is_primary', true)->first() ? $product->images->sortBy('sort_order')->search(function($image) use ($product) { return $image->is_primary; }) : 0 }}">
                        </div>
                    @endif
                    
                    @if(!$product->images || $product->images->count() < 4)
                        <div class="new-images-section mt-4">
                            <h6 class="text-muted mb-3">Add New Images ({{ 4 - ($product->images ? $product->images->count() : 0) }} slots remaining)</h6>
                            <div class="image-upload-container">
                                <div class="image-upload-area" onclick="document.getElementById('images').click()">
                                    <div class="upload-icon">
                                        <i class="fas fa-cloud-upload-alt"></i>
                                    </div>
                                    <div class="upload-text">Click to upload or drag and drop</div>
                                    <div class="upload-hint">PNG, JPG, JPEG up to 2MB each (Maximum {{ 4 - ($product->images ? $product->images->count() : 0) }} more images)</div>
                                    <input type="file" 
                                           class="form-control @error('images.*') is-invalid @enderror" 
                                           id="images" 
                                           name="images[]" 
                                           accept="image/*"
                                           multiple
                                           style="display: none;"
                                           onchange="handleMultipleImages(this)">
                                </div>
                                
                                <div id="image-previews" class="image-previews-container mt-3">
                                    <!-- New image previews will be displayed here -->
                                </div>
                                
                                <div id="image-controls" class="image-controls mt-3" style="display: none;">
                                    <small class="text-info">
                                        <i class="fas fa-info-circle"></i>
                                        Click on the star icon to set an image as thumbnail. Drag to reorder images.
                                    </small>
                                </div>
                                
                                <!-- Hidden input for new images thumbnail selection -->
                                <input type="hidden" id="thumbnail_image_index" name="thumbnail_image_index" value="0">
                            </div>
                        </div>
                    @else
                        <div class="alert alert-warning">
                            <i class="fas fa-info-circle"></i>
                            Maximum of 4 images reached. Remove some images to add new ones.
                        </div>
                    @endif
                    
                    @error('images.*')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                    @error('images')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Product Variants -->
                <div class="mb-3">
                    <label class="form-label">Product Variants</label>
                    <div class="border rounded p-3 bg-light">
                        <p class="text-muted mb-3">Create specific color combinations with individual stock and pricing. These are product variants with color-based pricing.</p>
                        
                        <!-- Existing Variants -->
                        @if($product->variants && $product->variants->count() > 0)
                            <div class="mb-3">
                                <h6 class="text-primary"><i class="fas fa-box"></i> Existing Variants</h6>
                                <div id="existing-variants-container">
                                    @foreach($product->variants as $index => $variant)
                                        <div class="variant-row border rounded p-3 mb-3 bg-white existing-variant" data-variant-id="{{ $variant->id }}">
                                            <div class="row align-items-end">
                                                <div class="col-md-4">
                                                    <label class="form-label">Color <span class="text-danger">*</span></label>
                                                    <select name="existing_variants[{{ $variant->id }}][color_id]" class="form-control color-select" required>
                                                        <option value="">Select Color</option>
                                                        @foreach($allColors ?? [] as $color)
                                                        <option value="{{ $color->id }}" {{ $variant->color_id == $color->id ? 'selected' : '' }}>{{ $color->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-md-2">
                                                    <label class="form-label">Stock <span class="text-danger">*</span></label>
                                                    <input type="number" 
                                                           name="existing_variants[{{ $variant->id }}][stock]" 
                                                           class="form-control" 
                                                           min="0" 
                                                           value="{{ old('existing_variants.'.$variant->id.'.stock', $variant->stock) }}" 
                                                           required>
                                                </div>
                                                <div class="col-md-2">
                                                    <label class="form-label">Price Adjustment ($)</label>
                                                    <input type="number" 
                                                           name="existing_variants[{{ $variant->id }}][price_adjustment]" 
                                                           class="form-control price-adjustment-input" 
                                                           step="0.01" 
                                                           value="{{ old('existing_variants.'.$variant->id.'.price_adjustment', $variant->price_adjustment) }}" 
                                                           placeholder="0.00">
                                                    <small class="text-muted">±Amount from base price</small>
                                                </div>
                                                <div class="col-md-2">
                                                    <label class="form-label">Final Price</label>
                                                    <div class="form-control-plaintext bg-light p-2 rounded text-center">
                                                        <strong class="final-price-display text-success">${{ number_format($product->price + $variant->price_adjustment, 2) }}</strong>
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <button type="button" class="btn btn-sm btn-danger remove-existing-variant w-100" data-variant-id="{{ $variant->id }}">
                                                        <i class="fas fa-trash"></i> Remove
                                                    </button>
                                                    <input type="hidden" name="existing_variants[{{ $variant->id }}][id]" value="{{ $variant->id }}">
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                        
                        <!-- New Variants -->
                        <div class="mb-3">
                            <h6 class="text-success">
                                {{-- <i class="fas fa-plus-circle"></i> Add New Variants</h6> --}}
                            <div id="variants-container">
                                <!-- New variants will be dynamically added here -->
                            </div>
                            
                            <button type="button" class="btn btn-sm btn-outline-primary" id="add-variant">
                                <i class="fas fa-plus"></i> Add New Variant
                            </button>
                        </div>

                        <!-- Hidden inputs for removed variants -->
                        <div id="removed-variants-container"></div>
                    </div>
                </div>

                <!-- Status -->
                <div class="mb-3">
                    <div class="form-check form-switch">
                        <input class="form-check-input" 
                               type="checkbox" 
                               id="status" 
                               name="status" 
                               value="1"
                               {{ old('status', $product->status) ? 'checked' : '' }}>
                        <label class="form-check-label" for="status">
                            Active Status
                        </label>
                    </div>
                    <small class="text-muted">Toggle to activate/deactivate the product</small>
                    @error('status')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Product Flag -->
                <div class="mb-3">
                    <label for="flag" class="form-label">Product Flag</label>
                    <select class="form-control @error('flag') is-invalid @enderror" 
                            id="flag" 
                            name="flag">
                        <option value="All Items" {{ old('flag', $product->flag) == 'All Items' ? 'selected' : '' }}>All Items</option>
                        <option value="New Arrivals" {{ old('flag', $product->flag) == 'New Arrivals' ? 'selected' : '' }}>New Arrivals</option>
                        <option value="Featured" {{ old('flag', $product->flag) == 'Featured' ? 'selected' : '' }}>Featured</option>
                        <option value="On Sale" {{ old('flag', $product->flag) == 'On Sale' ? 'selected' : '' }}>On Sale</option>
                    </select>
                    <small class="text-muted">Choose how this product should be categorized on the site</small>
                    @error('flag')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Form Actions -->
                <div class="form-actions">
                    <a href="{{ route('admin.products.index') }}" class="btn-secondary-custom">
                        <i class="fas fa-times"></i>
                        Cancel
                    </a>
                    {{-- <a href="{{ route('admin.products.show', $product->id) }}" class="btn-secondary-custom">
                        <i class="fas fa-eye"></i>
                        View Product
                    </a> --}}
                    <button type="submit" class="btn-warning-custom" id="submitBtn">
                        <span id="submitText">
                            <i class="fas fa-save"></i>
                            Update Product
                        </span>
                        <span id="submitSpinner" style="display: none;">
                            <i class="fas fa-spinner fa-spin"></i>
                            Updating...
                        </span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const imagesInput = document.getElementById('images');
    const container = document.getElementById('image-previews');
    const uploadArea = document.querySelector('.image-upload-area');
    const form = document.getElementById('editProductForm');
    const submitBtn = document.getElementById('submitBtn');
    const submitText = document.getElementById('submitText');
    const submitSpinner = document.getElementById('submitSpinner');
    const thumbnailIndexInput = document.getElementById('thumbnail_image_index');
    const existingThumbnailIndexInput = document.getElementById('existing_thumbnail_index');
    const imageControlsDiv = document.getElementById('image-controls');
    const removedImagesContainer = document.getElementById('removed-images-inputs');

    console.log('Enhanced product edit form initialized');

    // Initialize Quill Rich Text Editor
    let quill = null;
    const descriptionEditor = document.getElementById('description-editor');
    const descriptionInput = document.getElementById('description');
    
    if (descriptionEditor) {
        quill = new Quill(descriptionEditor, {
            theme: 'snow',
            modules: {
                toolbar: [
                    [{ 'header': [1, 2, 3, 4, 5, 6, false] }],
                    [{ 'font': [] }],
                    [{ 'size': ['small', false, 'large', 'huge'] }],
                    ['bold', 'italic', 'underline', 'strike'],
                    [{ 'color': [] }, { 'background': [] }],
                    [{ 'script': 'sub'}, { 'script': 'super' }],
                    [{ 'list': 'ordered'}, { 'list': 'bullet' }],
                    [{ 'indent': '-1'}, { 'indent': '+1' }],
                    [{ 'direction': 'rtl' }],
                    [{ 'align': [] }],
                    ['blockquote', 'code-block'],
                    ['link', 'image', 'video'],
                    ['clean']
                ]
            },
            placeholder: 'Enter detailed product description with formatting...'
        });

        // Update hidden textarea on content change
        quill.on('text-change', function() {
            const content = quill.root.innerHTML;
            descriptionInput.value = content;
            
            // Validation feedback
            const editorContainer = document.querySelector('.editor-container');
            if (quill.getText().trim().length === 0) {
                editorContainer.classList.add('is-invalid');
            } else {
                editorContainer.classList.remove('is-invalid');
            }
        });

        // Initial validation check
        if (quill.getText().trim().length === 0) {
            document.querySelector('.editor-container').classList.add('is-invalid');
        }
    }

    let selectedImages = [];
    let thumbnailIndex = 0;
    let removedImageIds = [];
    const MAX_IMAGES = 4;
    const existingImagesCount = {{ $product->images ? $product->images->count() : 0 }};

    // Drag and drop functionality for upload area
    if (uploadArea) {
        uploadArea.addEventListener('dragover', function(e) {
            e.preventDefault();
            uploadArea.classList.add('dragover');
        });

        uploadArea.addEventListener('dragleave', function(e) {
            e.preventDefault();
            uploadArea.classList.remove('dragover');
        });

        uploadArea.addEventListener('drop', function(e) {
            e.preventDefault();
            uploadArea.classList.remove('dragover');
            
            const files = Array.from(e.dataTransfer.files).filter(file => file.type.startsWith('image/'));
            handleNewImages(files);
        });
    }

    // Form submission handling
    if (form) {
        form.addEventListener('submit', function(e) {
            console.log('Form submitting...');
            
            // Update description from Quill editor
            if (quill) {
                const content = quill.root.innerHTML;
                descriptionInput.value = content;
                
                // Validate description content
                if (quill.getText().trim().length === 0) {
                    e.preventDefault();
                    alert('Please enter a product description.');
                    document.querySelector('.editor-container').classList.add('is-invalid');
                    return false;
                }
            }
            
            // Update the file input with current images
            updateFileInput();
            
            if (submitBtn) {
                submitBtn.disabled = true;
                if (submitText) submitText.style.display = 'none';
                if (submitSpinner) submitSpinner.style.display = 'inline';
            }
        });
    }

    // Global functions for existing image management
    window.removeExistingImage = function(imageId, buttonElement) {
        console.log('Removing existing image:', imageId);
        
        // Add to removed images array
        if (!removedImageIds.includes(imageId)) {
            removedImageIds.push(imageId);
            
            // Add hidden input for this removed image
            const hiddenInput = document.createElement('input');
            hiddenInput.type = 'hidden';
            hiddenInput.name = 'remove_images[]';
            hiddenInput.value = imageId;
            removedImagesContainer.appendChild(hiddenInput);
        }
        
        // Remove the image item from DOM
        const imageItem = buttonElement.closest('.image-preview-item');
        imageItem.style.animation = 'fadeOutScale 0.3s ease-out forwards';
        setTimeout(() => {
            imageItem.remove();
            updateExistingImageIndices();
        }, 300);
    };

    window.setExistingThumbnail = function(index, buttonElement) {
        console.log('Setting existing thumbnail:', index);
        
        // Update hidden input
        if (existingThumbnailIndexInput) {
            existingThumbnailIndexInput.value = index;
        }
        
        // Update visual indicators
        document.querySelectorAll('.existing-image-item').forEach((item, i) => {
            const thumbnailBtn = item.querySelector('.thumbnail-btn');
            const primaryBadge = item.querySelector('.primary-badge');
            
            if (i === index) {
                item.classList.add('primary');
                if (thumbnailBtn) thumbnailBtn.classList.add('active');
                if (!primaryBadge) {
                    const badge = document.createElement('div');
                    badge.className = 'primary-badge';
                    badge.textContent = 'Primary';
                    item.appendChild(badge);
                }
            } else {
                item.classList.remove('primary');
                if (thumbnailBtn) thumbnailBtn.classList.remove('active');
                if (primaryBadge) primaryBadge.remove();
            }
        });
    };

    function updateExistingImageIndices() {
        document.querySelectorAll('.existing-image-item').forEach((item, index) => {
            const indexElement = item.querySelector('.image-index');
            if (indexElement) {
                indexElement.textContent = index + 1;
            }
            item.setAttribute('data-index', index);
            
            // Update thumbnail button onclick
            const thumbnailBtn = item.querySelector('.thumbnail-btn');
            if (thumbnailBtn) {
                thumbnailBtn.setAttribute('onclick', `setExistingThumbnail(${index}, this)`);
            }
        });
    }

    function handleNewImages(files) {
        if (!files || files.length === 0) return;

        const remainingSlots = MAX_IMAGES - existingImagesCount - selectedImages.length;
        if (remainingSlots <= 0) {
            showMaxImagesWarning();
            return;
        }

        const filesToAdd = Array.from(files).slice(0, remainingSlots);
        
        filesToAdd.forEach(file => {
            if (file.size > 2 * 1024 * 1024) {
                console.warn('File too large:', file.name);
                return;
            }
            selectedImages.push(file);
        });

        if (files.length > remainingSlots) {
            showMaxImagesWarning();
        }

        renderImagePreviews();
    }

    function renderImagePreviews() {
        if (!container) return;

        container.innerHTML = '';

        if (selectedImages.length === 0) {
            if (imageControlsDiv) imageControlsDiv.style.display = 'none';
            return;
        }

        if (imageControlsDiv) imageControlsDiv.style.display = 'block';

        selectedImages.forEach((file, index) => {
            const reader = new FileReader();
            reader.onload = function(e) {
                const imageItem = createImagePreviewItem(e.target.result, index, file.name);
                container.appendChild(imageItem);
            };
            reader.readAsDataURL(file);
        });
    }

    function createImagePreviewItem(src, index, fileName) {
        const div = document.createElement('div');
        div.className = `image-preview-item ${index === thumbnailIndex ? 'primary' : ''}`;
        div.draggable = true;
        div.dataset.index = index;

        div.innerHTML = `
            <img src="${src}" alt="${fileName}">
            <div class="image-controls">
                <button type="button" class="control-btn remove-btn" onclick="removeImage(${index})">
                    <i class="fas fa-trash"></i>
                </button>
                <button type="button" class="control-btn thumbnail-btn ${index === thumbnailIndex ? 'active' : ''}" onclick="setThumbnail(${index})">
                    <i class="fas fa-star"></i>
                </button>
            </div>
            ${index === thumbnailIndex ? '<div class="primary-badge">Primary</div>' : ''}
            <div class="image-index">${index + 1}</div>
        `;

        // Add drag and drop event listeners
        div.addEventListener('dragstart', handleDragStart);
        div.addEventListener('dragover', handleDragOver);
        div.addEventListener('drop', handleDrop);
        div.addEventListener('dragend', handleDragEnd);

        return div;
    }

    // Global functions for new image management
    window.removeImage = function(index) {
        console.log('Removing image at index:', index);
        selectedImages.splice(index, 1);
        
        // Adjust thumbnail index if necessary
        if (thumbnailIndex >= selectedImages.length && selectedImages.length > 0) {
            thumbnailIndex = selectedImages.length - 1;
        } else if (selectedImages.length === 0) {
            thumbnailIndex = 0;
        }
        
        renderImagePreviews();
        updateThumbnailInput();
    };

    window.setThumbnail = function(index) {
        console.log('Setting thumbnail to index:', index);
        thumbnailIndex = index;
        renderImagePreviews();
        updateThumbnailInput();
    };

    function updateThumbnailInput() {
        if (thumbnailIndexInput) {
            thumbnailIndexInput.value = thumbnailIndex;
        }
    }

    function updateFileInput() {
        if (!imagesInput || selectedImages.length === 0) return;

        const dt = new DataTransfer();
        selectedImages.forEach(file => dt.items.add(file));
        imagesInput.files = dt.files;
    }

    function showMaxImagesWarning() {
        if (document.querySelector('.max-images-warning')) return;
        
        const warning = document.createElement('div');
        warning.className = 'max-images-warning';
        warning.innerHTML = `
            <i class="fas fa-exclamation-triangle"></i>
            You can only upload a maximum of ${MAX_IMAGES} images total. Remove some existing images first.
        `;
        
        container.parentNode.insertBefore(warning, container.nextSibling);
        
        setTimeout(() => warning.remove(), 5000);
    }

    // Drag and drop for reordering
    let draggedIndex = null;

    function handleDragStart(e) {
        draggedIndex = parseInt(e.target.closest('.image-preview-item').dataset.index);
        e.target.closest('.image-preview-item').classList.add('dragging');
    }

    function handleDragOver(e) {
        e.preventDefault();
    }

    function handleDrop(e) {
        e.preventDefault();
        const targetIndex = parseInt(e.target.closest('.image-preview-item').dataset.index);
        
        if (draggedIndex !== null && draggedIndex !== targetIndex) {
            // Reorder the images array
            const draggedItem = selectedImages[draggedIndex];
            selectedImages.splice(draggedIndex, 1);
            selectedImages.splice(targetIndex, 0, draggedItem);
            
            // Update thumbnail index if needed
            if (thumbnailIndex === draggedIndex) {
                thumbnailIndex = targetIndex;
            } else if (draggedIndex < thumbnailIndex && targetIndex >= thumbnailIndex) {
                thumbnailIndex--;
            } else if (draggedIndex > thumbnailIndex && targetIndex <= thumbnailIndex) {
                thumbnailIndex++;
            }
            
            renderImagePreviews();
            updateThumbnailInput();
        }
    }

    function handleDragEnd(e) {
        e.target.closest('.image-preview-item').classList.remove('dragging');
        draggedIndex = null;
    }

    // Initialize the form
    window.handleMultipleImages = function(input) {
        handleNewImages(input.files);
    };

    // Variants handling with dynamic pricing
    let variantIndex = 0;
    const variantsContainer = document.getElementById('variants-container');
    const addVariantBtn = document.getElementById('add-variant');
    const productPriceInput = document.getElementById('price');
    const removedVariantsContainer = document.getElementById('removed-variants-container');
    let removedVariantIds = [];

    if (addVariantBtn && variantsContainer) {
        function getBasePrice() {
            const priceValue = parseFloat(productPriceInput.value) || 0;
            return priceValue;
        }

        function updateAllVariantPrices() {
            const basePrice = getBasePrice();
            
            // Update existing variants
            const existingVariantRows = document.querySelectorAll('.existing-variant');
            existingVariantRows.forEach(row => {
                const priceAdjustmentInput = row.querySelector('.price-adjustment-input');
                const finalPriceDisplay = row.querySelector('.final-price-display');
                const priceAdjustment = parseFloat(priceAdjustmentInput.value) || 0;
                const finalPrice = basePrice + priceAdjustment;
                
                if (finalPriceDisplay) {
                    finalPriceDisplay.textContent = `$${finalPrice.toFixed(2)}`;
                }
            });
            
            // Update new variants
            const newVariantRows = variantsContainer.querySelectorAll('.variant-row');
            newVariantRows.forEach(row => {
                const priceAdjustmentInput = row.querySelector('.price-adjustment-input');
                const finalPriceDisplay = row.querySelector('.final-price-display');
                const priceAdjustment = parseFloat(priceAdjustmentInput.value) || 0;
                const finalPrice = basePrice + priceAdjustment;
                
                if (finalPriceDisplay) {
                    finalPriceDisplay.textContent = `$${finalPrice.toFixed(2)}`;
                }
            });
        }

        function addVariant() {
            const basePrice = getBasePrice();
            const variantHtml = `
                <div class="variant-row border rounded p-3 mb-3 bg-white">
                    <div class="row align-items-end">
                        <div class="col-md-4">
                            <label class="form-label">Color <span class="text-danger">*</span></label>
                            <select name="variants[${variantIndex}][color_id]" class="form-control color-select" required>
                                <option value="">Select Color</option>
                                @foreach($allColors ?? [] as $color)
                                <option value="{{ $color->id }}">{{ $color->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-2">
                            <label class="form-label">Stock <span class="text-danger">*</span></label>
                            <input type="number" name="variants[${variantIndex}][stock]" class="form-control" min="0" value="0" required>
                        </div>
                        <div class="col-md-2">
                            <label class="form-label">Price Adjustment ($)</label>
                            <input type="number" 
                                   name="variants[${variantIndex}][price_adjustment]" 
                                   class="form-control price-adjustment-input" 
                                   step="0.01" 
                                   value="0" 
                                   placeholder="0.00">
                            <small class="text-muted">±Amount from base price</small>
                        </div>
                        <div class="col-md-2">
                            <label class="form-label">Final Price</label>
                            <div class="form-control-plaintext bg-light p-2 rounded text-center">
                                <strong class="final-price-display text-success">$${basePrice.toFixed(2)}</strong>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <button type="button" class="btn btn-sm btn-danger remove-variant w-100">
                                <i class="fas fa-trash"></i> Remove
                            </button>
                        </div>
                    </div>
                </div>
            `;
            
            variantsContainer.insertAdjacentHTML('beforeend', variantHtml);
            variantIndex++;
            
            // Add event listener for price adjustment changes
            const newRow = variantsContainer.lastElementChild;
            const priceAdjustmentInput = newRow.querySelector('.price-adjustment-input');
            priceAdjustmentInput.addEventListener('input', updateAllVariantPrices);
        }

        // Update variant prices when main product price changes
        if (productPriceInput) {
            productPriceInput.addEventListener('input', updateAllVariantPrices);
        }

        addVariantBtn.addEventListener('click', addVariant);

        // Handle existing variant price adjustment changes
        document.addEventListener('input', function(e) {
            if (e.target.classList.contains('price-adjustment-input')) {
                updateAllVariantPrices();
            }
        });

        // Remove new variant
        variantsContainer.addEventListener('click', function(e) {
            if (e.target.classList.contains('remove-variant') || e.target.closest('.remove-variant')) {
                e.target.closest('.variant-row').remove();
            }
        });

        // Remove existing variant
        document.addEventListener('click', function(e) {
            if (e.target.classList.contains('remove-existing-variant') || e.target.closest('.remove-existing-variant')) {
                const button = e.target.closest('.remove-existing-variant');
                const variantId = button.getAttribute('data-variant-id');
                const variantRow = button.closest('.existing-variant');
                
                // Add to removed variants list
                if (variantId && !removedVariantIds.includes(variantId)) {
                    removedVariantIds.push(variantId);
                    
                    // Add hidden input to mark for deletion
                    const hiddenInput = document.createElement('input');
                    hiddenInput.type = 'hidden';
                    hiddenInput.name = 'remove_variants[]';
                    hiddenInput.value = variantId;
                    removedVariantsContainer.appendChild(hiddenInput);
                }
                
                // Remove the variant row from DOM
                variantRow.style.animation = 'fadeOutScale 0.3s ease-out forwards';
                setTimeout(() => {
                    variantRow.remove();
                }, 300);
            }
        });

        // Initial price update
        updateAllVariantPrices();
    }

    console.log('Product edit form ready');
});
</script>

@endsection