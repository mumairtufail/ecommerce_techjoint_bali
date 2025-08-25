@extends('admin.layout.app')
@section('title', 'Products Management')

@push('head')
<!-- DataTables CSS -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
@endpush

@section('content')

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
        --danger: #F56565;
        --info: #4299E1;
    }

    .products-container {
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

    .btn-add-product {
        background: rgba(255, 255, 255, 0.2);
        border: 1px solid rgba(255, 255, 255, 0.3);
        color: var(--white);
        padding: 0.75rem 1.5rem;
        border-radius: 10px;
        text-decoration: none;
        font-weight: 500;
        transition: all 0.2s ease;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
    }

    .btn-add-product:hover {
        background: rgba(255, 255, 255, 0.3);
        color: var(--white);
        text-decoration: none;
        transform: translateY(-1px);
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

    .table-container {
        background: var(--white);
        border-radius: 16px;
        padding: 1.5rem;
        box-shadow: 0 1px 3px rgba(252, 95, 73, 0.08);
    }

    .product-image {
        width: 60px;
        height: 60px;
        object-fit: cover;
        border-radius: 8px;
        border: 1px solid var(--border-light);
    }

    .product-image-placeholder {
        width: 60px;
        height: 60px;
        background: var(--background);
        border: 1px solid var(--border-light);
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--text-light);
    }

    .product-name {
        font-weight: 600;
        color: var(--text-dark);
        margin-bottom: 2px;
    }

    .product-id {
        color: var(--text-light);
        font-size: 0.8rem;
    }

    .category-badge {
        background: var(--primary-lightest);
        color: var(--primary-dark);
        padding: 0.25rem 0.75rem;
        border-radius: 12px;
        font-size: 0.8rem;
        font-weight: 500;
    }

    .price-text {
        color: var(--success);
        font-size: 1rem;
        font-weight: 600;
    }

    .stock-badge {
        padding: 0.25rem 0.75rem;
        border-radius: 12px;
        font-size: 0.8rem;
        font-weight: 500;
    }

    .stock-normal {
        background: rgba(72, 187, 120, 0.1);
        color: var(--success);
    }

    .stock-low {
        background: rgba(245, 101, 101, 0.1);
        color: var(--danger);
    }

    .stock-out {
        background: rgba(108, 117, 125, 0.1);
        color: #6c757d;
    }

    .status-badge {
        padding: 0.25rem 0.75rem;
        border-radius: 12px;
        font-size: 0.8rem;
        font-weight: 500;
        text-transform: uppercase;
    }

    .status-active {
        background: rgba(72, 187, 120, 0.1);
        color: var(--success);
    }

    .status-inactive {
        background: rgba(108, 117, 125, 0.1);
        color: #6c757d;
    }

    .action-buttons {
        display: flex;
        gap: 0.25rem;
        align-items: center;
    }

    .action-btn {
        width: 32px;
        height: 32px;
        padding: 0;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 6px;
        background: transparent;
        border: 1px solid var(--border-light);
        color: var(--text-light);
        cursor: pointer;
        text-decoration: none;
        transition: all 0.2s ease;
    }

    .action-btn:hover {
        background-color: var(--background);
        transform: translateY(-1px);
        text-decoration: none;
    }

    .action-btn.btn-view:hover {
        border-color: var(--info);
        color: var(--info);
    }

    .action-btn.btn-edit:hover {
        border-color: var(--primary-color);
        color: var(--primary-color);
    }

    .action-btn.btn-delete:hover {
        background-color: rgba(245, 101, 101, 0.1);
        border-color: var(--danger);
        color: var(--danger);
    }

    .table thead th {
        background: var(--primary-lightest);
        color: var(--text-dark);
        border: none;
        padding: 1rem;
        font-weight: 600;
        font-size: 0.875rem;
        text-transform: uppercase;
        letter-spacing: 0.05em;
    }

    .table tbody td {
        padding: 1rem;
        border-color: var(--border-light);
        vertical-align: middle;
    }

    .table tbody tr:hover {
        background-color: rgba(252, 95, 73, 0.02);
    }

    .dataTables_wrapper .dataTables_length select,
    .dataTables_wrapper .dataTables_filter input {
        border: 1px solid var(--border-light);
        border-radius: 8px;
        padding: 0.5rem;
        color: var(--text-dark);
    }

    .dataTables_wrapper .dataTables_filter input:focus {
        outline: none;
        border-color: var(--primary-color);
        box-shadow: 0 0 0 2px rgba(252, 95, 73, 0.1);
    }

    .dataTables_wrapper .dataTables_paginate .paginate_button {
        padding: 0.5rem 1rem;
        margin: 0 0.25rem;
        border-radius: 6px;
        border: 1px solid var(--border-light);
        color: var(--text-medium);
    }

    .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
        background: var(--primary-color) !important;
        color: var(--white) !important;
        border-color: var(--primary-color) !important;
    }

    .dataTables_wrapper .dataTables_paginate .paginate_button.current {
        background: var(--primary-color) !important;
        color: var(--white) !important;
        border-color: var(--primary-color) !important;
    }

    .flag-badge {
        padding: 0.25rem 0.75rem;
        border-radius: 12px;
        font-size: 0.8rem;
        font-weight: 500;
    }
    
    .flag-new {
        background: rgba(66, 153, 225, 0.1);
        color: #4299E1;
    }
    
    .flag-featured {
        background: rgba(237, 137, 54, 0.1);
        color: #ED8936;
    }
    
    .flag-sale {
        background: rgba(245, 101, 101, 0.1);
        color: #F56565;
    }
    
    .flag-all {
        background: rgba(160, 174, 192, 0.1);
        color: #718096;
    }
</style>

<div class="products-container">
    <div class="container-fluid">
        <!-- Session Flash Messages -->
        @if(session('success'))
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success!',
                        text: '{{ session('success') }}',
                        confirmButtonColor: '#FC5F49',
                        timer: 3000,
                        timerProgressBar: true
                    });
                });
            </script>
        @endif

        @if(session('error'))
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: '{{ session('error') }}',
                        confirmButtonColor: '#FC5F49'
                    });
                });
            </script>
        @endif

        <!-- Breadcrumb -->
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb breadcrumb-custom">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Products</li>
            </ol>
        </nav>

        <!-- Page Header -->
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col-lg-8">
                    <h1 class="page-title">
                        <i class="fas fa-box"></i>
                        Products Management
                    </h1>
                    <p class="page-subtitle">Manage your product inventory and details</p>
                </div>
                <div class="col-lg-4 text-lg-end mt-3 mt-lg-0">
                    <a href="{{ route('admin.products.create') }}" class="btn-add-product">
                        <i class="fas fa-plus"></i>
                        Add New Product
                    </a>
                </div>
            </div>
        </div>

        <!-- Products Table -->
        <div class="table-container">
            <table id="productsTable" class="table table-hover w-100">
                <thead>
                    <tr>
                        <th>Image</th>
                        <th>Product</th>
                        <th>Category</th>
                        <th>Price</th>
                        <th>Stock & Variants</th>
                        <th>Status</th>
                        <th>Flag</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($products as $product)
                    <tr id="product-row-{{ $product->id }}">
                        <td>
                            @if($product->image)
                                <img src="{{ asset('storage/' . $product->image) }}" 
                                     alt="{{ $product->name }}" 
                                     class="product-image">
                            @else
                                <div class="product-image-placeholder">
                                    <i class="fas fa-image"></i>
                                </div>
                            @endif
                        </td>
                        <td>
                            <div class="product-name">{{ $product->name }}</div>
                            <div class="product-id">ID: #{{ $product->id }}</div>
                        </td>
                        <td>
                            <span class="category-badge">{{ $product->category->name }}</span>
                        </td>
                        <td>
                            <div class="price-text">${{ number_format($product->price, 2) }}</div>
                        </td>
                        <td>
                            @if($product->variants->count() > 0)
                                <div class="variants-info">
                                    <small class="text-muted d-block">{{ $product->variants->count() }} variants</small>
                                    <div class="variant-summary">
                                        {{-- @if($product->sizes->count() > 0)
                                        <span class="badge bg-light text-dark me-1" style="font-size: 0.7rem;">
                                            Sizes: {{ $product->sizes->pluck('name')->join(', ') }}
                                        </span>
                                        @endif --}}
                                        {{-- @if($product->colors->count() > 0)
                                        <span class="badge bg-light text-dark" style="font-size: 0.7rem;">
                                            Colors: {{ $product->colors->pluck('name')->join(', ') }}
                                        </span>
                                        @endif --}}
                                    </div>
                                    <small class="text-success">Total Stock: {{ $product->variants->sum('stock') }}</small>
                                </div>
                            @else
                                <span class="stock-badge 
                                    {{ $product->stock == 0 ? 'stock-out' : ($product->stock <= 10 ? 'stock-low' : 'stock-normal') }}">
                                    {{ $product->stock }} units
                                </span>
                            @endif
                        </td>
                        <td>
                            <span class="status-badge {{ $product->status ? 'status-active' : 'status-inactive' }}">
                                {{ $product->status ? 'Active' : 'Inactive' }}
                            </span>
                        </td>
                        <td>
                            <span class="flag-badge 
                                {{ $product->flag == 'New Arrivals' ? 'flag-new' : 
                                   ($product->flag == 'Featured' ? 'flag-featured' : 
                                   ($product->flag == 'On Sale' ? 'flag-sale' : 'flag-all')) }}">
                                {{ $product->flag }}
                            </span>
                        </td>
                        <td>
                            <div class="action-buttons">
                                <a href="{{ route('admin.products.edit', $product->id) }}" 
                                   class="action-btn btn-edit" 
                                   title="Edit Product">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <button class="action-btn btn-delete delete-product" 
                                        data-id="{{ $product->id }}"
                                        data-name="{{ $product->name }}"
                                        title="Delete Product">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<!-- Load jQuery first (only once) -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Then load SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!-- DataTables JS -->
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

<script>
console.log('Products page script loaded');

$(document).ready(function() {
    console.log('Products jQuery ready');
    console.log('jQuery version:', $.fn.jquery);
    console.log('SweetAlert2 available:', typeof Swal !== 'undefined');
    console.log('DataTable available:', typeof $.fn.DataTable !== 'undefined');
    
    // Wait a bit for all scripts to load
    setTimeout(function() {
        console.log('Products page initialization starting...');
        
        // Initialize DataTable
        try {
            if (typeof $.fn.DataTable !== 'undefined') {
                const table = $('#productsTable').DataTable({
                    responsive: true,
                    pageLength: 25,
                    lengthMenu: [[10, 25, 50, 100], [10, 25, 50, 100]],
                    order: [[1, 'asc']],
                    columnDefs: [
                        { targets: [0, 7], orderable: false, searchable: false }
                    ]
                });
                console.log('DataTable initialized successfully');
            } else {
                console.error('DataTable is not available');
            }
        } catch (error) {
            console.error('DataTable initialization failed:', error);
        }

        // Delete Product with SweetAlert
        $(document).on('click', '.delete-product', function(e) {
            console.log('Delete button clicked');
            e.preventDefault();
            
            const productId = $(this).data('id');
            const productName = $(this).data('name');
            
            console.log('Product ID:', productId);
            console.log('Product Name:', productName);
            
            if (!productId || !productName) {
                console.error('Missing product data');
                return;
            }
            
            if (typeof Swal === 'undefined') {
                if (confirm('Are you sure you want to delete ' + productName + '?')) {
                    // Fallback form submission
                    const form = $('<form>', {
                        method: 'POST',
                        action: `/admin/products/${productId}`
                    });
                    
                    form.append($('<input>', {
                        type: 'hidden',
                        name: '_token',
                        value: $('meta[name="csrf-token"]').attr('content')
                    }));
                    
                    form.append($('<input>', {
                        type: 'hidden',
                        name: '_method',
                        value: 'DELETE'
                    }));
                    
                    $('body').append(form);
                    form.submit();
                }
                return;
            }
            
            Swal.fire({
                title: 'Delete Product?',
                html: `Are you sure you want to delete <strong>"${productName}"</strong>?<br><small class="text-muted">This action cannot be undone.</small>`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#FC5F49',
                cancelButtonColor: '#718096',
                confirmButtonText: 'Yes, Delete!',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                console.log('SweetAlert result:', result);
                if (result.isConfirmed) {
                    console.log('User confirmed deletion');
                    
                    // Show loading
                    Swal.fire({
                        title: 'Deleting...',
                        text: 'Please wait while we delete the product.',
                        allowOutsideClick: false,
                        allowEscapeKey: false,
                        showConfirmButton: false,
                        didOpen: () => {
                            Swal.showLoading();
                        }
                    });

                    // Create form and submit
                    const form = $('<form>', {
                        method: 'POST',
                        action: `/admin/products/${productId}`
                    });
                    
                    form.append($('<input>', {
                        type: 'hidden',
                        name: '_token',
                        value: $('meta[name="csrf-token"]').attr('content')
                    }));
                    
                    form.append($('<input>', {
                        type: 'hidden',
                        name: '_method',
                        value: 'DELETE'
                    }));
                    
                    console.log('Form created, submitting...');
                    $('body').append(form);
                    form.submit();
                } else {
                    console.log('User cancelled deletion');
                }
            });
        });
    }, 1000); // Wait 1 second for all scripts to load properly
});
</script>
@endpush