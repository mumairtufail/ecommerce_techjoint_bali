@extends('admin.layout.app')
@section('title', 'Categories Management')

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

    .categories-container {
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

    .btn-add-category {
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

    .btn-add-category:hover {
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

    .category-name {
        font-weight: 600;
        color: var(--text-dark);
        margin-bottom: 2px;
    }

    .category-id {
        color: var(--text-light);
        font-size: 0.8rem;
    }

    .category-description {
        color: var(--text-medium);
        font-size: 0.9rem;
        max-width: 300px;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
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
        background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-light) 100%);
        color: var(--white);
        border-radius: 16px 16px 0 0;
        border: none;
        padding: 1.5rem 2rem;
    }

    .modal-title {
        font-weight: 600;
        font-size: 1.25rem;
    }

    .btn-close {
        background: rgba(255, 255, 255, 0.2);
        border-radius: 50%;
        opacity: 1;
        filter: invert(1);
    }

    .modal-body {
        padding: 2rem;
    }

    .modal-footer {
        border: none;
        padding: 0 2rem 2rem;
        justify-content: flex-end;
        gap: 1rem;
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
    }

    .btn-primary-custom:hover {
        background: var(--primary-dark);
        border-color: var(--primary-dark);
        color: var(--white);
        transform: translateY(-1px);
    }

    .btn-secondary-custom {
        background: var(--background);
        border: 1px solid var(--border-light);
        color: var(--text-medium);
        padding: 0.75rem 1.5rem;
        border-radius: 10px;
        font-weight: 500;
        transition: all 0.2s ease;
    }

    .btn-secondary-custom:hover {
        background: var(--border-light);
        color: var(--text-dark);
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .categories-container {
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
        
        .table-container {
            padding: 1rem;
        }
        
        .modal-body {
            padding: 1.5rem;
        }
        
        .modal-footer {
            padding: 0 1.5rem 1.5rem;
            flex-direction: column;
        }
    }
</style>

<div class="categories-container">
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
                <li class="breadcrumb-item active" aria-current="page">Categories</li>
            </ol>
        </nav>

        <!-- Page Header -->
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col-lg-8">
                    <h1 class="page-title">
                        <i class="fas fa-tags"></i>
                        Categories Management
                    </h1>
                    <p class="page-subtitle">Manage product categories and organize your inventory</p>
                </div>
                <div class="col-lg-4 text-lg-end mt-3 mt-lg-0">
                    <button type="button" class="btn-add-category" id="addCategoryBtn">
                        <i class="fas fa-plus"></i>
                        Add New Category
                    </button>
                </div>
            </div>
        </div>

        <!-- Categories Table -->
        <div class="table-container">
            <table id="categoriesTable" class="table table-hover w-100">
                <thead>
                    <tr>
                        <th>Category</th>
                        <th>Description</th>
                        <th>Products Count</th>
                        <th>Status</th>
                        <th>Created Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($categories as $category)
                    <tr id="category-row-{{ $category->id }}">
                        <td>
                            <div class="category-name">{{ $category->name }}</div>
                            <div class="category-id">ID: #{{ $category->id }}</div>
                        </td>
                        <td>
                            <div class="category-description" title="{{ $category->description }}">
                                {{ $category->description ?: 'No description' }}
                            </div>
                        </td>
                        <td>
                            <span class="products-count">{{ $category->products_count ?? 0 }} products</span>
                        </td>
                        <td>
                            <span class="status-badge {{ $category->status ? 'status-active' : 'status-inactive' }}">
                                {{ $category->status ? 'Active' : 'Inactive' }}
                            </span>
                        </td>
                        <td>
                            <div class="text-medium">{{ $category->created_at->format('M d, Y') }}</div>
                            <div class="text-muted" style="font-size: 0.8rem;">{{ $category->created_at->format('h:i A') }}</div>
                        </td>
                        <td>
                            <div class="action-buttons">
                                <button class="action-btn btn-edit edit-category" 
                                        data-id="{{ $category->id }}"
                                        data-name="{{ $category->name }}"
                                        data-description="{{ $category->description }}"
                                        data-status="{{ $category->status }}"
                                        title="Edit Category">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button class="action-btn btn-delete delete-category" 
                                        data-id="{{ $category->id }}"
                                        data-name="{{ $category->name }}"
                                        title="Delete Category">
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

<!-- Create Category Modal -->
<div class="modal fade" id="createCategoryModal" tabindex="-1" aria-labelledby="createCategoryModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createCategoryModalLabel">
                    <i class="fas fa-plus-circle me-2"></i>Add New Category
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="createCategoryForm" action="{{ route('admin.categories.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="create_name" class="form-label">Category Name <span class="text-danger">*</span></label>
                        <input type="text" 
                               class="form-control" 
                               id="create_name" 
                               name="name" 
                               required 
                               placeholder="Enter category name">
                        <div class="invalid-feedback"></div>
                    </div>

                    <div class="mb-3">
                        <label for="create_description" class="form-label">Description</label>
                        <textarea class="form-control" 
                                  id="create_description" 
                                  name="description" 
                                  rows="3" 
                                  placeholder="Enter category description (optional)"></textarea>
                        <div class="invalid-feedback"></div>
                    </div>

                    <div class="mb-3">
                        <div class="form-check form-switch">
                            <input class="form-check-input" 
                                   type="checkbox" 
                                   id="create_status" 
                                   name="status" 
                                   value="1"
                                   checked>
                            <label class="form-check-label" for="create_status">
                                Active Status
                            </label>
                        </div>
                        <small class="text-muted">Toggle to activate/deactivate the category</small>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn-secondary-custom" data-bs-dismiss="modal">
                        <i class="fas fa-times"></i>
                        Cancel
                    </button>
                    <button type="submit" class="btn-primary-custom" id="createSubmitBtn">
                        <span id="createSubmitText">
                            <i class="fas fa-save"></i>
                            Create Category
                        </span>
                        <span id="createSubmitSpinner" style="display: none;">
                            <i class="fas fa-spinner fa-spin"></i>
                            Creating...
                        </span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Category Modal -->
<div class="modal fade" id="editCategoryModal" tabindex="-1" aria-labelledby="editCategoryModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editCategoryModalLabel">
                    <i class="fas fa-edit me-2"></i>Edit Category
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="editCategoryForm" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="edit_name" class="form-label">Category Name <span class="text-danger">*</span></label>
                        <input type="text" 
                               class="form-control" 
                               id="edit_name" 
                               name="name" 
                               required 
                               placeholder="Enter category name">
                        <div class="invalid-feedback"></div>
                    </div>

                    <div class="mb-3">
                        <label for="edit_description" class="form-label">Description</label>
                        <textarea class="form-control" 
                                  id="edit_description" 
                                  name="description" 
                                  rows="3" 
                                  placeholder="Enter category description (optional)"></textarea>
                        <div class="invalid-feedback"></div>
                    </div>

                    <div class="mb-3">
                        <div class="form-check form-switch">
                            <input class="form-check-input" 
                                   type="checkbox" 
                                   id="edit_status" 
                                   name="status" 
                                   value="1">
                            <label class="form-check-label" for="edit_status">
                                Active Status
                            </label>
                        </div>
                        <small class="text-muted">Toggle to activate/deactivate the category</small>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn-secondary-custom" data-bs-dismiss="modal">
                        <i class="fas fa-times"></i>
                        Cancel
                    </button>
                    <button type="submit" class="btn-primary-custom" id="editSubmitBtn">
                        <span id="editSubmitText">
                            <i class="fas fa-save"></i>
                            Update Category
                        </span>
                        <span id="editSubmitSpinner" style="display: none;">
                            <i class="fas fa-spinner fa-spin"></i>
                            Updating...
                        </span>
                    </button>
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

<!-- Bootstrap 5 JS for modals -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

<!-- DataTables JS -->
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

<script>
console.log('Categories page script loaded');

$(document).ready(function() {
    console.log('Categories jQuery ready');
    
    // Initialize Bootstrap modals
    let createModal, editModal;
    
    // Wait for all scripts to load
    setTimeout(function() {
        console.log('Categories page initialization starting...');
        
        // Initialize Bootstrap modals manually
        try {
            createModal = new bootstrap.Modal(document.getElementById('createCategoryModal'));
            editModal = new bootstrap.Modal(document.getElementById('editCategoryModal'));
            console.log('Bootstrap modals initialized');
        } catch (e) {
            console.error('Bootstrap modal initialization failed:', e);
            // Fallback to jQuery if Bootstrap 5 fails
            createModal = $('#createCategoryModal');
            editModal = $('#editCategoryModal');
        }
        
        // Initialize DataTable
        try {
            if (typeof $.fn.DataTable !== 'undefined') {
                const table = $('#categoriesTable').DataTable({
                    responsive: true,
                    pageLength: 25,
                    lengthMenu: [[10, 25, 50, 100], [10, 25, 50, 100]],
                    order: [[0, 'asc']],
                    columnDefs: [
                        { targets: [5], orderable: false, searchable: false }
                    ]
                });
                console.log('DataTable initialized successfully');
            }
        } catch (error) {
            console.error('DataTable initialization failed:', error);
        }

        // Add Category Button Click
        $('#addCategoryBtn').on('click', function() {
            console.log('Add category button clicked');
            
            // Clear form
            $('#createCategoryForm')[0].reset();
            $('.form-control').removeClass('is-invalid');
            $('.invalid-feedback').text('');
            
            // Show modal
            try {
                if (createModal.show) {
                    createModal.show();
                } else {
                    createModal.modal('show');
                }
            } catch (e) {
                console.error('Error showing create modal:', e);
                // Fallback
                $('#createCategoryModal').show();
            }
        });

        // Edit Category Modal
        $(document).on('click', '.edit-category', function() {
            const categoryId = $(this).data('id');
            const categoryName = $(this).data('name');
            const categoryDescription = $(this).data('description') || '';
            const categoryStatus = $(this).data('status');
            
            console.log('Edit category clicked:', categoryId, categoryName);
            
            // Set form action
            $('#editCategoryForm').attr('action', `/admin/categories/${categoryId}`);
            
            // Fill form fields
            $('#edit_name').val(categoryName);
            $('#edit_description').val(categoryDescription);
            $('#edit_status').prop('checked', categoryStatus == 1);
            
            // Clear previous errors
            $('.form-control').removeClass('is-invalid');
            $('.invalid-feedback').text('');
            
            // Show modal
            try {
                if (editModal.show) {
                    editModal.show();
                } else {
                    editModal.modal('show');
                }
            } catch (e) {
                console.error('Error showing edit modal:', e);
                // Fallback
                $('#editCategoryModal').show();
            }
        });

        // Create Category Form Submission
        $('#createCategoryForm').on('submit', function(e) {
            e.preventDefault();
            
            const submitBtn = $('#createSubmitBtn');
            const submitText = $('#createSubmitText');
            const submitSpinner = $('#createSubmitSpinner');
            
            submitBtn.prop('disabled', true);
            submitText.hide();
            submitSpinner.show();
            
            // Clear previous errors
            $('.form-control').removeClass('is-invalid');
            $('.invalid-feedback').text('');
            
            $.ajax({
                url: $(this).attr('action'),
                method: 'POST',
                data: $(this).serialize(),
                success: function(response) {
                    try {
                        if (createModal.hide) {
                            createModal.hide();
                        } else {
                            createModal.modal('hide');
                        }
                    } catch (e) {
                        $('#createCategoryModal').hide();
                    }
                    
                    Swal.fire({
                        icon: 'success',
                        title: 'Success!',
                        text: 'Category created successfully!',
                        confirmButtonColor: '#FC5F49'
                    }).then(() => {
                        location.reload();
                    });
                },
                error: function(xhr) {
                    if (xhr.status === 422) {
                        const errors = xhr.responseJSON.errors;
                        Object.keys(errors).forEach(key => {
                            const field = key === 'name' ? 'create_name' : 
                                         key === 'description' ? 'create_description' : key;
                            $(`#${field}`).addClass('is-invalid');
                            $(`#${field}`).siblings('.invalid-feedback').text(errors[key][0]);
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error!',
                            text: 'Failed to create category. Please try again.',
                            confirmButtonColor: '#FC5F49'
                        });
                    }
                },
                complete: function() {
                    submitBtn.prop('disabled', false);
                    submitText.show();
                    submitSpinner.hide();
                }
            });
        });

        // Edit Category Form Submission
        $('#editCategoryForm').on('submit', function(e) {
            e.preventDefault();
            
            const submitBtn = $('#editSubmitBtn');
            const submitText = $('#editSubmitText');
            const submitSpinner = $('#editSubmitSpinner');
            
            submitBtn.prop('disabled', true);
            submitText.hide();
            submitSpinner.show();
            
            // Clear previous errors
            $('.form-control').removeClass('is-invalid');
            $('.invalid-feedback').text('');
            
            $.ajax({
                url: $(this).attr('action'),
                method: 'POST',
                data: $(this).serialize(),
                success: function(response) {
                    try {
                        if (editModal.hide) {
                            editModal.hide();
                        } else {
                            editModal.modal('hide');
                        }
                    } catch (e) {
                        $('#editCategoryModal').hide();
                    }
                    
                    Swal.fire({
                        icon: 'success',
                        title: 'Success!',
                        text: 'Category updated successfully!',
                        confirmButtonColor: '#FC5F49'
                    }).then(() => {
                        location.reload();
                    });
                },
                error: function(xhr) {
                    if (xhr.status === 422) {
                        const errors = xhr.responseJSON.errors;
                        Object.keys(errors).forEach(key => {
                            const field = key === 'name' ? 'edit_name' : 
                                         key === 'description' ? 'edit_description' : key;
                            $(`#${field}`).addClass('is-invalid');
                            $(`#${field}`).siblings('.invalid-feedback').text(errors[key][0]);
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error!',
                            text: 'Failed to update category. Please try again.',
                            confirmButtonColor: '#FC5F49'
                        });
                    }
                },
                complete: function() {
                    submitBtn.prop('disabled', false);
                    submitText.show();
                    submitSpinner.hide();
                }
            });
        });

        // Delete Category
        $(document).on('click', '.delete-category', function(e) {
            e.preventDefault();
            
            const categoryId = $(this).data('id');
            const categoryName = $(this).data('name');
            
            console.log('Delete category clicked:', categoryId, categoryName);
            
            if (typeof Swal === 'undefined') {
                if (confirm('Are you sure you want to delete ' + categoryName + '?')) {
                    deleteCategory(categoryId);
                }
                return;
            }
            
            Swal.fire({
                title: 'Delete Category?',
                html: `Are you sure you want to delete <strong>"${categoryName}"</strong>?<br><small class="text-muted">This action cannot be undone and will affect all products in this category.</small>`,
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
                        text: 'Please wait while we delete the category.',
                        allowOutsideClick: false,
                        allowEscapeKey: false,
                        showConfirmButton: false,
                        didOpen: () => {
                            Swal.showLoading();
                        }
                    });

                    deleteCategory(categoryId);
                }
            });
        });

        function deleteCategory(categoryId) {
            $.ajax({
                url: `/admin/categories/${categoryId}`,
                method: 'DELETE',
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Deleted!',
                        text: 'Category deleted successfully!',
                        confirmButtonColor: '#FC5F49'
                    }).then(() => {
                        location.reload();
                    });
                },
                error: function(xhr) {
                    let errorMessage = 'Failed to delete category. Please try again.';
                    if (xhr.responseJSON && xhr.responseJSON.message) {
                        errorMessage = xhr.responseJSON.message;
                    }
                    
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: errorMessage,
                        confirmButtonColor: '#FC5F49'
                    });
                }
            });
        }

        // Reset forms when modals are hidden
        $('#createCategoryModal').on('hidden.bs.modal', function() {
            $('#createCategoryForm')[0].reset();
            $('.form-control').removeClass('is-invalid');
            $('.invalid-feedback').text('');
        });

        $('#editCategoryModal').on('hidden.bs.modal', function() {
            $('#editCategoryForm')[0].reset();
            $('.form-control').removeClass('is-invalid');
            $('.invalid-feedback').text('');
        });

        // Manual close buttons for modals
        $('.btn-close, [data-bs-dismiss="modal"]').on('click', function() {
            const modal = $(this).closest('.modal');
            try {
                if (modal.attr('id') === 'createCategoryModal') {
                    if (createModal.hide) {
                        createModal.hide();
                    } else {
                        createModal.modal('hide');
                    }
                } else if (modal.attr('id') === 'editCategoryModal') {
                    if (editModal.hide) {
                        editModal.hide();
                    } else {
                        editModal.modal('hide');
                    }
                }
            } catch (e) {
                modal.hide();
            }
        });

    }, 1000); // Wait for scripts to load
});
</script>
@endpush
