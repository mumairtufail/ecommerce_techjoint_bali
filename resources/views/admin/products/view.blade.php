@extends('admin.layout.app')
@section('title', 'Products Management')

@section('content')
<!-- Container -->
<div class="container-fluid mt-xl-50 mt-sm-30 mt-15">
    <!-- Flash Messages -->
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    
    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Products</li>
        </ol>
    </nav>

    <!-- Title -->
    <div class="hk-pg-header">
        <h4 class="hk-pg-title">
            <span class="pg-title-icon"><i class="fa fa-box"></i></span>
            Products Management
        </h4>
        <div class="d-flex">
            <button class="btn custom-btn-primary" data-bs-toggle="modal" data-bs-target="#productModal">
                <i class="fa fa-plus me-2"></i>Add Product
            </button>
        </div>
    </div>

    <!-- Row -->
    <div class="row">
        <div class="col-xl-12">
            <section class="hk-sec-wrapper">
                <div class="row">
                    <div class="col-sm">
                        <div class="table-wrap">
                            <table id="productsTable" class="table table-hover w-100 display pb-30">
                                <thead>
                                    <tr>
                                        <th style="padding:inherit;">Image</th>
                                        <th style="padding:inherit;">Name</th>
                                        <th style="padding:inherit;">Category</th>
                                        <th style="padding:inherit;">Price</th>
                                        <th style="padding:inherit;">Stock</th>
                                        <th style="padding:inherit;">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($products as $product)
                                    <tr>
                                        <td>
                                            <img src="{{ asset('storage/' . $product->image) }}" 
                                                 alt="{{ $product->name }}" 
                                                 class="img-fluid" 
                                                 style="max-width: 50px;">
                                        </td>
                                        <td>{{ $product->name }}</td>
                                        <td>{{ $product->category->name }}</td>
                                        <td>${{ number_format($product->price, 2) }}</td>
                                        <td>{{ $product->stock }}</td>
                                        <td>
                                            <a href="" class="action-btn view-product">
                                                <i class="fa fa-eye text-primary"></i>
                                            </a>
                                            <button class="action-btn edit-product" 
                                                    data-id="{{ $product->id }}" 
                                                    data-bs-toggle="modal" 
                                                    data-bs-target="#productModal" 
                                                    data-action="{{ route('admin.products.update', $product->id) }}" 
                                                    data-method="PUT">
                                                <i class="fa fa-pencil text-primary"></i>
                                            </button>
                                            <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button class="action-btn" 
                                                        onclick="return confirm('Are you sure you want to delete this product?')">
                                                    <i class="fa fa-trash text-danger"></i>
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
            </section>
        </div>
    </div>
</div>

<style>
@media (max-width: 576px) {
    .pagination {
        margin-left: 70px;
    }
}

.action-btn {
    width: 32px;
    height: 32px;
    padding: 0;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    border-radius: 4px;
    background: transparent;
    border: 1px solid #dee2e6;
    margin: 0 3px;
    color: inherit;
    cursor: pointer;
    text-decoration: none;
}

.action-btn:hover {
    background-color: #f8f9fa;
}

.table-wrap {
    overflow-x: auto;
    -webkit-overflow-scrolling: touch;
    margin: 0 -1px;
    padding: 0 1px;
}

.table-wrap::-webkit-scrollbar {
    height: 6px;
}

.table-wrap::-webkit-scrollbar-track {
    background: #f1f1f1;
}

.table-wrap::-webkit-scrollbar-thumb {
    background: #888;
    border-radius: 3px;
}

.custom-btn-primary {
    background-color: #F53B31 !important;
    border-color: #F53B31 !important;
    color: white !important;
    transition: all 0.3s ease;
}

.custom-btn-primary:hover {
    background-color: #d62f26 !important;
    border-color: #d62f26 !important;
    transform: translateY(-1px);
    box-shadow: 0 2px 5px rgba(245, 59, 49, 0.2);
}

@media (max-width: 768px) {
    .col-sm {
        display: flex;
        justify-content: center;
    }

    .custom-btn-primary {
        margin: 0 auto;
        display: flex;
        align-items: center;
        justify-content: center;
        min-width: 140px;
    }

    .container-fluid {
        padding: 10px;
    }

    .dataTables_length,
    .dataTables_filter {
        width: 100%;
        text-align: left;
    }

    .dataTables_filter input {
        width: 100%;
        margin-left: 0 !important;
    }
}

@media (max-width: 576px) {
    .breadcrumb {
        padding: 0.5rem 0;
        font-size: 0.875rem;
    }

    .hk-sec-wrapper {
        padding: 1rem;
    }

    .table td,
    .table th {
        padding: 0.4rem;
        font-size: 0.875rem;
    }

    .dataTables_filter {
        /* text-align: center !important; */
    }
    
    .dataTables_filter label,
    .dataTables_filter input {
        margin: 0 auto !important;
    }
}
</style>

<script>
$(document).ready(function() {
    // Initialize DataTable
    const table = $('#productsTable').DataTable({
        ordering: true,
        responsive: false,
        scrollX: true,
        autoWidth: true,
        stripe: false,
        stateSave: false,
        bDestroy: true,
        pageLength: 10,
        language: {
            search: "",
            searchPlaceholder: "Search Products...",
            lengthMenu: "_MENU_ per page"
        },
        columnDefs: [
            {
                targets: '_all',
                className: 'no-hover'
            }
        ],
        dom: "<'row'<'col-sm-12'f>>" +
             "<'row'<'col-sm-12'tr>>" +
             "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
        initComplete: function() {
            $(window).on('resize', function() {
                table.columns.adjust();
            });
        }
    });

    // Touch scroll handling for mobile
    if ('ontouchstart' in window) {
        initializeTouchScroll();
    }
});

// Initialize touch scroll functionality
function initializeTouchScroll() {
    $('.table-wrap').css('cursor', 'grab');

    let isDown = false;
    let startX;
    let scrollLeft;

    $('.table-wrap')
        .on('touchstart mousedown', function(e) {
            isDown = true;
            $(this).css('cursor', 'grabbing');
            startX = (e.type === 'mousedown' ? e.pageX : e.touches[0].pageX) - $(this).offset().left;
            scrollLeft = $(this).scrollLeft();
        })
        .on('touchend mouseup', function() {
            isDown = false;
            $(this).css('cursor', 'grab');
        })
        .on('touchmove mousemove', function(e) {
            if (!isDown) return;
            e.preventDefault();
            const x = (e.type === 'mousemove' ? e.pageX : e.touches[0].pageX) - $(this).offset().left;
            const walk = (x - startX);
            $(this).scrollLeft(scrollLeft - walk);
        });
}
</script>
@endsection