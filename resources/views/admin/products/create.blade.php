@extends('admin.layout.app')
@section('title', 'Add New Product')

@section('content')
<!-- Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

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

    .create-container {
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

    .btn-primary-custom {
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

    .btn-primary-custom:hover {
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

    .image-preview {
        max-width: 200px;
        max-height: 200px;
        border-radius: 8px;
        border: 1px solid var(--border-light);
        margin: 1rem auto;
        display: none;
    }

    .multiple-image-upload {
        position: relative;
    }

    .image-previews-container {
        display: flex;
        flex-wrap: wrap;
        gap: 1rem;
        margin-top: 1rem;
    }

    .image-preview-item {
        position: relative;
        width: 120px;
        height: 120px;
        border-radius: 8px;
        overflow: hidden;
        border: 2px solid var(--border-light);
        background: var(--background);
        flex-shrink: 0;
    }

    .image-preview-item img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .image-preview-item .remove-image {
        position: absolute;
        top: 5px;
        right: 5px;
        background: var(--danger);
        color: white;
        border: none;
        border-radius: 50%;
        width: 25px;
        height: 25px;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        font-size: 12px;
        opacity: 0.9;
        transition: opacity 0.2s;
        z-index: 10;
    }

    .image-preview-item .remove-image:hover {
        opacity: 1;
        background: #dc3545;
    }

    .image-preview-item.primary {
        border-color: var(--primary-color);
    }

    .image-preview-item .primary-badge {
        position: absolute;
        bottom: 5px;
        left: 5px;
        background: var(--primary-color);
        color: white;
        font-size: 10px;
        padding: 2px 6px;
        border-radius: 4px;
        font-weight: 500;
        z-index: 10;
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

    /* Responsive Design */
    @media (max-width: 768px) {
        .create-container {
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
    }
</style>

<div class="create-container">
    <div class="container-fluid">
        <!-- Breadcrumb -->
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb breadcrumb-custom">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.products.index') }}">Products</a></li>
                <li class="breadcrumb-item active" aria-current="page">Add New Product</li>
            </ol>
        </nav>

        <!-- Page Header -->
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col-12">
                    <h1 class="page-title">
                        <i class="fas fa-plus-circle"></i>
                        Add New Product
                    </h1>
                    <p class="page-subtitle">Create a new product for your inventory</p>
                </div>
            </div>
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

        <!-- Create Form -->
        <div class="form-container">
            <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data" id="createProductForm">
                @csrf
                
                <div class="row">
                    <!-- Product Name -->
                    <div class="col-md-6 mb-3">
                        <label for="name" class="form-label">Product Name <span class="text-danger">*</span></label>
                        <input type="text" 
                               class="form-control @error('name') is-invalid @enderror" 
                               id="name" 
                               name="name" 
                               value="{{ old('name') }}" 
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
                                <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
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
                    <textarea class="form-control @error('description') is-invalid @enderror" 
                              id="description" 
                              name="description" 
                              rows="4" 
                              required 
                              placeholder="Enter product description">{{ old('description') }}</textarea>
                    @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="row">
                    <!-- Price -->
                    <div class="col-md-6 mb-3">
                        <label for="price" class="form-label">Price ($) <span class="text-danger">*</span></label>
                        <input type="number" 
                               class="form-control @error('price') is-invalid @enderror" 
                               id="price" 
                               name="price" 
                               step="0.01" 
                               min="0" 
                               value="{{ old('price') }}" 
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
                               value="{{ old('stock') }}" 
                               required 
                               placeholder="0">
                        @error('stock')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- Product Image -->
                <div class="mb-3">
                    <label for="image" class="form-label">Product Image</label>
                    <div class="image-upload-area" onclick="document.getElementById('image').click()">
                        <div class="upload-icon">
                            <i class="fas fa-cloud-upload-alt"></i>
                        </div>
                        <div class="upload-text">Click to upload or drag and drop</div>
                        <div class="upload-hint">PNG, JPG, JPEG up to 2MB</div>
                        <input type="file" 
                               class="form-control @error('image') is-invalid @enderror" 
                               id="image" 
                               name="image" 
                               accept="image/*" 
                               style="display: none;">
                    </div>
                    <img id="imagePreview" class="image-preview" alt="Preview">
                    @error('image')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Multiple Images Upload -->
                <div class="mb-3">
                    <label for="images" class="form-label">Additional Product Images</label>
                    <div class="multiple-image-upload">
                        <input type="file" 
                               class="form-control @error('images.*') is-invalid @enderror" 
                               id="images" 
                               name="images[]" 
                               accept="image/*"
                               multiple
                               onchange="handleMultipleImages(this)">
                        <small class="text-muted">Upload multiple images. These will be additional images beyond the main product image above.</small>
                        <div id="image-previews" class="image-previews-container mt-3">
                            <!-- Image previews will be displayed here -->
                        </div>
                    </div>
                    @error('images.*')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Product Variants -->
                <div class="mb-3">
                    <label class="form-label">Product Variants</label>
                    <div class="border rounded p-3 bg-light">
                        <p class="text-muted mb-3">Create specific size-color combinations with individual stock and pricing. Variants are required for products with size/color options.</p>
                        
                        <div id="variants-container">
                            <!-- Variants will be dynamically added here -->
                        </div>
                        
                        <button type="button" class="btn btn-sm btn-outline-primary" id="add-variant">
                            <i class="fas fa-plus"></i> Add Variant
                        </button>
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
                               {{ old('status', true) ? 'checked' : '' }}>
                        <label class="form-check-label" for="status">
                            Active Status
                        </label>
                    </div>
                    <small class="text-muted">Product will be active by default</small>
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
                        <option value="All Items" {{ old('flag') == 'All Items' ? 'selected' : '' }}>All Items</option>
                        <option value="New Arrivals" {{ old('flag') == 'New Arrivals' ? 'selected' : '' }}>New Arrivals</option>
                        <option value="Featured" {{ old('flag') == 'Featured' ? 'selected' : '' }}>Featured</option>
                        <option value="On Sale" {{ old('flag') == 'On Sale' ? 'selected' : '' }}>On Sale</option>
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
                    <button type="submit" class="btn-primary-custom" id="submitBtn">
                        <span id="submitText">
                            <i class="fas fa-save"></i>
                            Create Product
                        </span>
                        <span id="submitSpinner" style="display: none;">
                            <i class="fas fa-spinner fa-spin"></i>
                            Creating...
                        </span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const imageInput = document.getElementById('image');
    const imagePreview = document.getElementById('imagePreview');
    const uploadArea = document.querySelector('.image-upload-area');
    const form = document.getElementById('createProductForm');
    const submitBtn = document.getElementById('submitBtn');
    const submitText = document.getElementById('submitText');
    const submitSpinner = document.getElementById('submitSpinner');

    console.log('Product create form initialized');

    // Legacy single image preview functionality
    if (imageInput) {
        imageInput.addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    imagePreview.src = e.target.result;
                    imagePreview.style.display = 'block';
                    if (uploadArea) uploadArea.style.display = 'none';
                };
                reader.readAsDataURL(file);
            }
        });

        // Reset image preview if clicked again
        imagePreview.addEventListener('click', function() {
            imageInput.value = '';
            imagePreview.style.display = 'none';
            if (uploadArea) uploadArea.style.display = 'block';
        });
    }

    // Drag and drop functionality for legacy single image
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
            
            const files = e.dataTransfer.files;
            if (files.length > 0) {
                imageInput.files = files;
                imageInput.dispatchEvent(new Event('change'));
            }
        });
    }

    // Form submission handling
    if (form) {
        form.addEventListener('submit', function(e) {
            console.log('Form submitting...');
            if (submitBtn) {
                submitBtn.disabled = true;
                if (submitText) submitText.style.display = 'none';
                if (submitSpinner) submitSpinner.style.display = 'inline';
            }
        });
    }

    // Variants handling
    let variantIndex = 0;
    const variantsContainer = document.getElementById('variants-container');
    const addVariantBtn = document.getElementById('add-variant');

    if (addVariantBtn && variantsContainer) {
        function addVariant() {
            const variantHtml = `
                <div class="variant-row border rounded p-3 mb-3 bg-white">
                    <div class="row align-items-end">
                        <div class="col-md-3">
                            <label class="form-label">Size</label>
                            <select name="variants[${variantIndex}][size_id]" class="form-control size-select">
                                <option value="">Select Size</option>
                                @foreach($sizes as $size)
                                <option value="{{ $size->id }}">{{ $size->name }} @if($size->display_name)({{ $size->display_name }})@endif</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Color</label>
                            <select name="variants[${variantIndex}][color_id]" class="form-control color-select">
                                <option value="">Select Color</option>
                                @foreach($colors as $color)
                                <option value="{{ $color->id }}">{{ $color->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-2">
                            <label class="form-label">Stock</label>
                            <input type="number" name="variants[${variantIndex}][stock]" class="form-control" min="0" value="0" required>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Price Adjustment (PKR)</label>
                            <input type="number" name="variants[${variantIndex}][price_adjustment]" class="form-control" step="0.01" value="0" placeholder="0.00">
                        </div>
                        <div class="col-md-1">
                            <button type="button" class="btn btn-sm btn-danger remove-variant">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                    </div>
                </div>
            `;
            
            variantsContainer.insertAdjacentHTML('beforeend', variantHtml);
            variantIndex++;
        }

        addVariantBtn.addEventListener('click', addVariant);

        // Remove variant
        variantsContainer.addEventListener('click', function(e) {
            if (e.target.classList.contains('remove-variant') || e.target.closest('.remove-variant')) {
                e.target.closest('.variant-row').remove();
            }
        });
    }
});

// Global function for handling multiple images
let selectedMultipleImages = [];

function handleMultipleImages(input) {
    console.log('handleMultipleImages called, files:', input.files.length);
    const files = Array.from(input.files);
    const container = document.getElementById('image-previews');
    
    if (!container) {
        console.error('image-previews container not found');
        return;
    }

    // Clear existing previews
    container.innerHTML = '';
    selectedMultipleImages = [];

    files.forEach((file, index) => {
        if (file.type.startsWith('image/')) {
            selectedMultipleImages.push(file);
            const reader = new FileReader();
            
            reader.onload = function(e) {
                const imageDiv = document.createElement('div');
                imageDiv.className = 'image-preview-item';
                imageDiv.innerHTML = `
                    <img src="${e.target.result}" alt="Preview ${index + 1}">
                    <button type="button" class="remove-image" onclick="removeMultipleImage(${index})">
                        <i class="fas fa-times"></i>
                    </button>
                `;
                container.appendChild(imageDiv);
            };
            
            reader.readAsDataURL(file);
        }
    });
}

function removeMultipleImage(indexToRemove) {
    console.log('Removing image at index:', indexToRemove);
    
    // Remove from selectedMultipleImages array
    selectedMultipleImages.splice(indexToRemove, 1);
    
    // Update the file input
    const input = document.getElementById('images');
    const dt = new DataTransfer();
    
    selectedMultipleImages.forEach(file => {
        dt.items.add(file);
    });
    
    input.files = dt.files;
    
    // Refresh the preview
    handleMultipleImages(input);
}
</script>

@endsection