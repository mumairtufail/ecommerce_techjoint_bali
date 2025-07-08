@extends('admin.layout.app')
@section('title', 'Product Sizes Management')

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

    .sizes-container {
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

    .btn-add-size {
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
        cursor: pointer;
    }

    .btn-add-size:hover {
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

    .size-name {
        font-weight: 600;
        color: var(--text-dark);
        margin-bottom: 2px;
    }

    .size-id {
        color: var(--text-light);
        font-size: 0.8rem;
    }

    .display-name {
        color: var(--text-medium);
        font-size: 0.9rem;
    }

    .products-count {
        background: var(--primary-lightest);
        color: var(--primary-dark);
        padding: 0.25rem 0.75rem;
        border-radius: 12px;
        font-size: 0.8rem;
        font-weight: 500;
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

    /* Modal Styles */
    .modal-content {
        border: none;
        border-radius: 16px;
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
    }

    .modal-header {
        background: var(--primary-lightest);
        border-radius: 16px 16px 0 0;
        border-bottom: 1px solid var(--border-light);
        padding: 1.5rem;
    }

    .modal-title {
        color: var(--text-dark);
        font-weight: 600;
        font-size: 1.25rem;
    }

    .modal-body {
        padding: 2rem;
    }

    .modal-footer {
        border-top: 1px solid var(--border-light);
        padding: 1.5rem 2rem;
        border-radius: 0 0 16px 16px;
    }

    .form-label {
        font-weight: 500;
        color: var(--text-dark);
        margin-bottom: 0.5rem;
    }

    .form-control {
        border: 2px solid var(--border-light);
        border-radius: 8px;
        padding: 0.75rem;
        transition: border-color 0.2s ease;
    }

    .form-control:focus {
        border-color: var(--primary-color);
        box-shadow: 0 0 0 3px rgba(252, 95, 73, 0.1);
        outline: none;
    }

    .btn-primary-custom {
        background: var(--primary-color);
        border: none;
        color: var(--white);
        padding: 0.75rem 1.5rem;
        border-radius: 8px;
        font-weight: 500;
        transition: all 0.2s ease;
    }

    .btn-primary-custom:hover {
        background: var(--primary-dark);
        transform: translateY(-1px);
        color: var(--white);
    }

    .btn-secondary-custom {
        background: transparent;
        border: 2px solid var(--border-light);
        color: var(--text-medium);
        padding: 0.75rem 1.5rem;
        border-radius: 8px;
        font-weight: 500;
        transition: all 0.2s ease;
        text-decoration: none;
    }

    .btn-secondary-custom:hover {
        border-color: var(--text-medium);
        color: var(--text-dark);
        text-decoration: none;
    }
</style>

<div class="sizes-container">
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
                <li class="breadcrumb-item active" aria-current="page">Product Sizes</li>
            </ol>
        </nav>

        <!-- Page Header -->
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col-lg-8">
                    <h1 class="page-title">
                        <i class="fas fa-expand-arrows-alt"></i>
                        Product Sizes Management
                    </h1>
                    <p class="page-subtitle">Manage product sizes for variant system</p>
                </div>
                <div class="col-lg-4 text-lg-end mt-3 mt-lg-0">
                    <button class="btn-add-size" data-bs-toggle="modal" data-bs-target="#addSizeModal">
                        <i class="fas fa-plus"></i>
                        Add New Size
                    </button>
                </div>
            </div>
        </div>

        <!-- Sizes Table -->
        <div class="table-container">
            <table id="sizesTable" class="table table-hover w-100">
                <thead>
                    <tr>
                        <th>Size</th>
                        <th>Display Name</th>
                        <th>Sort Order</th>
                        <th>Products</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($sizes as $size)
                    <tr id="size-row-{{ $size->id }}">
                        <td>
                            <div class="size-name">{{ $size->name }}</div>
                            <div class="size-id">ID: #{{ $size->id }}</div>
                        </td>
                        <td>
                            <div class="display-name">{{ $size->display_name ?: '-' }}</div>
                        </td>
                        <td>
                            <span class="badge bg-light text-dark">{{ $size->sort_order }}</span>
                        </td>
                        <td>
                            <span class="products-count">{{ $size->products()->count() }} products</span>
                        </td>
                        <td>
                            <span class="status-badge {{ $size->status ? 'status-active' : 'status-inactive' }}">
                                {{ $size->status ? 'Active' : 'Inactive' }}
                            </span>
                        </td>
                        <td>
                            <div class="action-buttons">
                                <button class="action-btn btn-edit edit-size" 
                                        data-id="{{ $size->id }}"
                                        data-name="{{ $size->name }}"
                                        data-display-name="{{ $size->display_name }}"
                                        data-sort-order="{{ $size->sort_order }}"
                                        data-status="{{ $size->status }}"
                                        title="Edit Size">
                                    <i class="fas fa-edit"></i>
                                </button>
                                @if($size->products()->count() == 0)
                                <button class="action-btn btn-delete delete-size" 
                                        data-id="{{ $size->id }}"
                                        data-name="{{ $size->name }}"
                                        title="Delete Size">
                                    <i class="fas fa-trash"></i>
                                </button>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Add Size Modal -->
<div class="modal fade" id="addSizeModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="addSizeForm">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Add New Size</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Size Name *</label>
                        <input type="text" name="name" class="form-control" required placeholder="e.g., XL">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Display Name</label>
                        <input type="text" name="display_name" class="form-control" placeholder="e.g., Extra Large">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Sort Order *</label>
                        <input type="number" name="sort_order" class="form-control" required value="{{ $sizes->max('sort_order') + 1 }}">
                    </div>
                    <div class="mb-3">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="status" value="1" id="add_status" checked>
                            <label class="form-check-label" for="add_status">
                                Active Status
                            </label>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn-secondary-custom" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn-primary-custom">Add Size</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Size Modal -->
<div class="modal fade" id="editSizeModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="editSizeForm">
                @csrf
                @method('PUT')
                <input type="hidden" id="edit_size_id" name="size_id">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Size</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Size Name *</label>
                        <input type="text" name="name" id="edit_name" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Display Name</label>
                        <input type="text" name="display_name" id="edit_display_name" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Sort Order *</label>
                        <input type="number" name="sort_order" id="edit_sort_order" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="status" value="1" id="edit_status">
                            <label class="form-check-label" for="edit_status">
                                Active Status
                            </label>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn-secondary-custom" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn-primary-custom">Update Size</button>
                </div>
            </form>
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
console.log('Sizes page script loaded');

$(document).ready(function() {
    console.log('Sizes jQuery ready');
    
    // Wait a bit for all scripts to load
    setTimeout(function() {
        console.log('Sizes page initialization starting...');
        
        // Initialize DataTable
        try {
            if (typeof $.fn.DataTable !== 'undefined') {
                const table = $('#sizesTable').DataTable({
                    responsive: true,
                    pageLength: 25,
                    lengthMenu: [[10, 25, 50, 100], [10, 25, 50, 100]],
                    order: [[2, 'asc']], // Sort by sort_order
                    columnDefs: [
                        { targets: [5], orderable: false, searchable: false }
                    ]
                });
                console.log('DataTable initialized successfully');
            } else {
                console.error('DataTable is not available');
            }
        } catch (error) {
            console.error('DataTable initialization failed:', error);
        }

        // Add Size Form
        $('#addSizeForm').on('submit', function(e) {
            e.preventDefault();
            
            const formData = new FormData(this);
            
            $.ajax({
                url: '{{ route("admin.sizes.store") }}',
                method: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    if (response.success) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Success!',
                            text: response.message,
                            confirmButtonColor: '#FC5F49'
                        }).then(() => {
                            location.reload();
                        });
                    }
                },
                error: function(xhr) {
                    const errors = xhr.responseJSON?.errors;
                    let errorMessage = 'An error occurred';
                    
                    if (errors) {
                        errorMessage = Object.values(errors).flat().join('\n');
                    }
                    
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: errorMessage,
                        confirmButtonColor: '#FC5F49'
                    });
                }
            });
        });

        // Edit Size
        $(document).on('click', '.edit-size', function() {
            const sizeId = $(this).data('id');
            const name = $(this).data('name');
            const displayName = $(this).data('display-name');
            const sortOrder = $(this).data('sort-order');
            const status = $(this).data('status');
            
            $('#edit_size_id').val(sizeId);
            $('#edit_name').val(name);
            $('#edit_display_name').val(displayName);
            $('#edit_sort_order').val(sortOrder);
            $('#edit_status').prop('checked', status == 1);
            
            $('#editSizeModal').modal('show');
        });

        // Edit Size Form
        $('#editSizeForm').on('submit', function(e) {
            e.preventDefault();
            
            const sizeId = $('#edit_size_id').val();
            const formData = new FormData(this);
            
            $.ajax({
                url: `/admin/sizes/${sizeId}`,
                method: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    if (response.success) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Success!',
                            text: response.message,
                            confirmButtonColor: '#FC5F49'
                        }).then(() => {
                            location.reload();
                        });
                    }
                },
                error: function(xhr) {
                    const errors = xhr.responseJSON?.errors;
                    let errorMessage = 'An error occurred';
                    
                    if (errors) {
                        errorMessage = Object.values(errors).flat().join('\n');
                    }
                    
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: errorMessage,
                        confirmButtonColor: '#FC5F49'
                    });
                }
            });
        });

        // Delete Size
        $(document).on('click', '.delete-size', function(e) {
            e.preventDefault();
            
            const sizeId = $(this).data('id');
            const sizeName = $(this).data('name');
            
            if (!sizeId || !sizeName) {
                console.error('Missing size data');
                return;
            }
            
            Swal.fire({
                title: 'Delete Size?',
                html: `Are you sure you want to delete size <strong>"${sizeName}"</strong>?<br><small class="text-muted">This action cannot be undone.</small>`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#FC5F49',
                cancelButtonColor: '#718096',
                confirmButtonText: 'Yes, Delete!',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Show loading
                    Swal.fire({
                        title: 'Deleting...',
                        text: 'Please wait while we delete the size.',
                        allowOutsideClick: false,
                        allowEscapeKey: false,
                        showConfirmButton: false,
                        didOpen: () => {
                            Swal.showLoading();
                        }
                    });

                    $.ajax({
                        url: `/admin/sizes/${sizeId}`,
                        method: 'DELETE',
                        data: {
                            _token: $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(response) {
                            if (response.success) {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Deleted!',
                                    text: response.message,
                                    confirmButtonColor: '#FC5F49'
                                }).then(() => {
                                    location.reload();
                                });
                            }
                        },
                        error: function(xhr) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error!',
                                text: xhr.responseJSON?.message || 'Failed to delete size',
                                confirmButtonColor: '#FC5F49'
                            });
                        }
                    });
                }
            });
        });
    }, 1000); // Wait 1 second for all scripts to load properly
});
</script>
@endpush
