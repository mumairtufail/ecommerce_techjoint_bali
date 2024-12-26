@extends('admin.layout.app')

@section('content')
<div class="container-fluid mt-4">
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header bg-transparent">
                    <h3 class="card-title">Banner Settings</h3>
                    <button type="button" class="btn btn-primary btn-sm float-right" data-toggle="modal" data-target="#addBannerModal">
                        Add New Banner
                    </button>
                </div>
                <div class="card-body">
                    <!-- Home Banners Section -->
                    <h4 class="mb-3">Home Banners</h4>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Image</th>
                                    <th>Title</th>
                                    <th>Status</th>
                                    <th>Sort Order</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($homeBanners as $banner)
                                <tr>
                                    <td><img src="{{ asset('storage/' . $banner->image) }}" height="50"></td>
                                    <td>{{ $banner->title }}</td>
                                    <td>
                                        <span class="badge badge-{{ $banner->is_active ? 'success' : 'danger' }}">
                                            {{ $banner->is_active ? 'Active' : 'Inactive' }}
                                        </span>
                                    </td>
                                    <td>{{ $banner->sort_order }}</td>
                                    <td>
                                        <button class="btn btn-sm btn-info edit-banner" 
                                                data-banner="{{ $banner }}"
                                                data-toggle="modal" 
                                                data-target="#editBannerModal">
                                            Edit
                                        </button>
                                        <form action="{{ route('admin.banners.destroy', $banner) }}" 
                                              method="POST" 
                                              class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" 
                                                    class="btn btn-sm btn-danger" 
                                                    onclick="return confirm('Are you sure?')">
                                                Delete
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- Shop Banners Section -->
                    <h4 class="mt-4 mb-3">Shop Banners</h4>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Image</th>
                                    <th>Title</th>
                                    <th>Status</th>
                                    <th>Sort Order</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($shopBanners as $banner)
                                <tr>
                                    <td><img src="{{ asset('storage/' . $banner->image) }}" height="50"></td>
                                    <td>{{ $banner->title }}</td>
                                    <td>
                                        <span class="badge badge-{{ $banner->is_active ? 'success' : 'danger' }}">
                                            {{ $banner->is_active ? 'Active' : 'Inactive' }}
                                        </span>
                                    </td>
                                    <td>{{ $banner->sort_order }}</td>
                                    <td>
                                        <button class="btn btn-sm btn-info edit-banner" 
                                                data-banner="{{ $banner }}"
                                                data-toggle="modal" 
                                                data-target="#editBannerModal">
                                            Edit
                                        </button>
                                        <form action="{{ route('admin.banners.destroy', $banner) }}" 
                                              method="POST" 
                                              class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" 
                                                    class="btn btn-sm btn-danger" 
                                                    onclick="return confirm('Are you sure?')">
                                                Delete
                                            </button>
                                        </form>
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

<!-- Add Banner Modal -->
<div class="modal fade" id="addBannerModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('admin.banners.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Add New Banner</h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Banner Type</label>
                        <select name="type" class="form-control" required>
                            <option value="home">Home Banner</option>
                            <option value="shop">Shop Banner</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Image</label>
                        <input type="file" name="image" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Title</label>
                        <input type="text" name="title" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Subtitle</label>
                        <input type="text" name="subtitle" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Button Text</label>
                        <input type="text" name="button_text" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Button Link</label>
                        <input type="text" name="button_link" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Sort Order</label>
                        <input type="number" name="sort_order" class="form-control" value="0">
                    </div>
                    <div class="form-group">
                        <label>Status</label>
                        <select name="is_active" class="form-control">
                            <option value="1">Active</option>
                            <option value="0">Inactive</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save Banner</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Banner Modal -->
<div class="modal fade" id="editBannerModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="editBannerForm" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="modal-header">
                    <h5 class="modal-title">Edit Banner</h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Same form fields as Add Banner Modal -->
                    <div class="form-group">
                        <label>Banner Type</label>
                        <select name="type" class="form-control" required>
                            <option value="home">Home Banner</option>
                            <option value="shop">Shop Banner</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Image</label>
                        <input type="file" name="image" class="form-control">
                        <small class="text-muted">Leave empty to keep current image</small>
                    </div>
                    <div class="form-group">
                        <label>Title</label>
                        <input type="text" name="title" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Subtitle</label>
                        <input type="text" name="subtitle" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Button Text</label>
                        <input type="text" name="button_text" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Button Link</label>
                        <input type="text" name="button_link" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Sort Order</label>
                        <input type="number" name="sort_order" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Status</label>
                        <select name="is_active" class="form-control">
                            <option value="1">Active</option>
                            <option value="0">Inactive</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Update Banner</button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script>
    $(document).ready(function() {
        // Handle edit banner button click
        $('.edit-banner').click(function() {
            const banner = $(this).data('banner');
            const form = $('#editBannerForm');
            
            // Set form action URL
            form.attr('action', `/admin/banners/${banner.id}`);
            
            // Populate form fields
            form.find('select[name="type"]').val(banner.type);
            form.find('input[name="title"]').val(banner.title);
            form.find('input[name="subtitle"]').val(banner.subtitle);
            form.find('input[name="button_text"]').val(banner.button_text);
            form.find('input[name="button_link"]').val(banner.button_link);
            form.find('input[name="sort_order"]').val(banner.sort_order);
            form.find('select[name="is_active"]').val(banner.is_active ? '1' : '0');
        });
    });
</script>
@endpush

@endsection