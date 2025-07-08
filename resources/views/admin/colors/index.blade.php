@extends('admin.layout.app')
@section('title', 'Product Colors')

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Product Colors Management</h5>
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addColorModal">
                        <i class="fas fa-plus"></i> Add Color
                    </button>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover" id="colorsTable">
                            <thead>
                                <tr>
                                    <th>Color</th>
                                    <th>Name</th>
                                    <th>Hex Code</th>
                                    <th>Sort Order</th>
                                    <th>Products Count</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($colors as $color)
                                <tr id="color-row-{{ $color->id }}">
                                    <td>
                                        <div style="width: 30px; height: 30px; background-color: {{ $color->hex_code ?: '#cccccc' }}; border: 1px solid #ddd; border-radius: 4px;"></div>
                                    </td>
                                    <td><strong>{{ $color->name }}</strong></td>
                                    <td><code>{{ $color->hex_code ?: '-' }}</code></td>
                                    <td>{{ $color->sort_order }}</td>
                                    <td>
                                        <span class="badge bg-info">{{ $color->products()->count() }} products</span>
                                    </td>
                                    <td>
                                        <span class="badge {{ $color->status ? 'bg-success' : 'bg-secondary' }}">
                                            {{ $color->status ? 'Active' : 'Inactive' }}
                                        </span>
                                    </td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <button class="btn btn-sm btn-warning edit-color" 
                                                    data-id="{{ $color->id }}"
                                                    data-name="{{ $color->name }}"
                                                    data-hex-code="{{ $color->hex_code }}"
                                                    data-sort-order="{{ $color->sort_order }}"
                                                    data-status="{{ $color->status }}">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            @if($color->products()->count() == 0)
                                            <button class="btn btn-sm btn-danger delete-color" 
                                                    data-id="{{ $color->id }}"
                                                    data-name="{{ $color->name }}">
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
        </div>
    </div>
</div>

<!-- Add Color Modal -->
<div class="modal fade" id="addColorModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="addColorForm">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Add New Color</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Color Name *</label>
                        <input type="text" name="name" class="form-control" required placeholder="e.g., Red">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Hex Code</label>
                        <div class="input-group">
                            <input type="color" id="add_color_picker" class="form-control form-control-color" value="#000000">
                            <input type="text" name="hex_code" id="add_hex_code" class="form-control" placeholder="#000000" pattern="^#[0-9A-Fa-f]{6}$">
                        </div>
                        <div class="form-text">Optional: Choose a color or enter hex code like #FF0000</div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Sort Order *</label>
                        <input type="number" name="sort_order" class="form-control" required value="{{ $colors->max('sort_order') + 1 }}">
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
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Add Color</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Color Modal -->
<div class="modal fade" id="editColorModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="editColorForm">
                @csrf
                @method('PUT')
                <div class="modal-header">
                    <h5 class="modal-title">Edit Color</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Color Name *</label>
                        <input type="text" name="name" id="edit_name" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Hex Code</label>
                        <div class="input-group">
                            <input type="color" id="edit_color_picker" class="form-control form-control-color">
                            <input type="text" name="hex_code" id="edit_hex_code" class="form-control" pattern="^#[0-9A-Fa-f]{6}$">
                        </div>
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
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-warning">Update Color</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

<script>
$(document).ready(function() {
    // Initialize DataTable
    $('#colorsTable').DataTable({
        responsive: true,
        pageLength: 25,
        order: [[3, 'asc']] // Sort by sort_order
    });

    // Color picker sync for add modal
    const addColorPicker = document.getElementById('add_color_picker');
    const addHexCode = document.getElementById('add_hex_code');
    
    addColorPicker.addEventListener('change', function() {
        addHexCode.value = this.value.toUpperCase();
    });
    
    addHexCode.addEventListener('input', function() {
        if (this.value.match(/^#[0-9A-Fa-f]{6}$/)) {
            addColorPicker.value = this.value;
        }
    });

    // Color picker sync for edit modal
    const editColorPicker = document.getElementById('edit_color_picker');
    const editHexCode = document.getElementById('edit_hex_code');
    
    editColorPicker.addEventListener('change', function() {
        editHexCode.value = this.value.toUpperCase();
    });
    
    editHexCode.addEventListener('input', function() {
        if (this.value.match(/^#[0-9A-Fa-f]{6}$/)) {
            editColorPicker.value = this.value;
        }
    });

    // Add Color
    $('#addColorForm').on('submit', function(e) {
        e.preventDefault();
        
        $.ajax({
            url: '{{ route("admin.colors.store") }}',
            method: 'POST',
            data: $(this).serialize(),
            success: function(response) {
                $('#addColorModal').modal('hide');
                Swal.fire({
                    icon: 'success',
                    title: 'Success!',
                    text: 'Color added successfully!',
                    timer: 2000
                }).then(() => {
                    location.reload();
                });
            },
            error: function(xhr) {
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: 'Failed to add color. Please try again.'
                });
            }
        });
    });

    // Edit Color
    $('.edit-color').on('click', function() {
        const id = $(this).data('id');
        const name = $(this).data('name');
        const hexCode = $(this).data('hex-code');
        const sortOrder = $(this).data('sort-order');
        const status = $(this).data('status');

        $('#edit_name').val(name);
        $('#edit_hex_code').val(hexCode || '');
        $('#edit_color_picker').val(hexCode || '#000000');
        $('#edit_sort_order').val(sortOrder);
        $('#edit_status').prop('checked', status);
        
        $('#editColorForm').attr('action', `/admin/colors/${id}`);
        $('#editColorModal').modal('show');
    });

    $('#editColorForm').on('submit', function(e) {
        e.preventDefault();
        
        $.ajax({
            url: $(this).attr('action'),
            method: 'PUT',
            data: $(this).serialize(),
            success: function(response) {
                $('#editColorModal').modal('hide');
                Swal.fire({
                    icon: 'success',
                    title: 'Success!',
                    text: 'Color updated successfully!',
                    timer: 2000
                }).then(() => {
                    location.reload();
                });
            },
            error: function(xhr) {
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: 'Failed to update color. Please try again.'
                });
            }
        });
    });

    // Delete Color
    $('.delete-color').on('click', function() {
        const id = $(this).data('id');
        const name = $(this).data('name');

        Swal.fire({
            title: 'Delete Color?',
            text: `Are you sure you want to delete "${name}"?`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: `/admin/colors/${id}`,
                    method: 'DELETE',
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        Swal.fire('Deleted!', 'Color has been deleted.', 'success');
                        $(`#color-row-${id}`).remove();
                    },
                    error: function(xhr) {
                        Swal.fire('Error!', 'Failed to delete color.', 'error');
                    }
                });
            }
        });
    });
});
</script>

@endsection
