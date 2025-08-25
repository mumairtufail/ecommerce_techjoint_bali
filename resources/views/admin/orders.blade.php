@extends('admin.layout.app')
@section('content')

<div class="container-fluid mt-xl-50 mt-sm-30 mt-15">
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Orders</li>
        </ol>
    </nav>
    <!-- Page Header -->
    <div class="hk-pg-header">
        <h4 class="hk-pg-title">
            <span class="pg-title-icon"><i class="fa fa-shopping-cart"></i></span>
            Orders
        </h4>
    </div>

    <!-- Content Section -->
    <div class="row">
        <div class="col-xl-12">
            <section class="hk-sec-wrapper">
                <!-- Add Button -->
                <div class="row mb-3">
                    <div class="col-sm">
                        <div class="d-flex justify-content-between align-items-center">
                            <h5 class="mb-0">All Orders</h5>
                            <small class="text-muted">Click on the eye icon to view order details</small>
                        </div>
                    </div>
                </div>

                <!-- Table -->
                <div class="row">
                    <div class="col-sm">
                        <div class="table-wrap">
                            <table id="ordersTable" class="table table-hover w-100 display pb-30">
                                <thead>
                                    <tr>
                                        <th style="padding:inherit;">Order ID</th>
                                        <th style="padding:inherit;">Customer</th>
                                        <th style="padding:inherit;">Contact</th>
                                        <th style="padding:inherit;">Location</th>
                                        <th style="padding:inherit;">Items</th>
                                        <th style="padding:inherit;">Total Amount</th>
                                        <th style="padding:inherit;">Order Date</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($orders as $order)
                                    <tr>
                                        <td>#{{ $order->id }}</td>
                                        <td>{{ $order->first_name }} {{ $order->last_name }}</td>
                                        <td>
                                            <div>{{ $order->email }}</div>
                                            <small class="text-muted">{{ $order->phone }}</small>
                                        </td>
                                        <td>
                                            <div>{{ $order->city }}</div>
                                            <small class="text-muted">{{ $order->country }}</small>
                                        </td>
                                        <td>
                                            @php
                                                $itemCount = $order->orderItems->sum('quantity');
                                            @endphp
                                            <span class="badge badge-soft-info">{{ $itemCount }} items</span>
                                        </td>
                                        <td>
                                            <span class="text-success font-weight-bold">${{ number_format($order->total, 2) }}</span>
                                        </td>
                                        <td>{{ \Carbon\Carbon::parse($order->created_at)->format('M d, Y') }}</td>
                                        <td>
                                            <a href="{{ route('admin.orders.show', $order->id) }}" 
                                               class="action-btn"
                                               title="View Order Details">
                                                <i class="fa fa-eye text-primary"></i>
                                            </a>
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
}

.action-btn:hover {
    background-color: #f8f9fa;
}

.modal-header {
    background-color: #f8f9fa;
    border-bottom: 1px solid #dee2e6;
    padding: 1rem;
}

.modal-body {
    padding: 1rem;
}

.modal-footer {
    background-color: #f8f9fa;
    border-top: 1px solid #dee2e6;
    padding: 1rem;
}

.form-group {
    margin-bottom: 1rem;
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

.gap-2 {
    gap: 0.5rem;
}

.d-flex {
    display: flex;
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
    const table = $('#ordersTable').DataTable({
        ordering: true, // Enable ordering
        responsive: false,  // Disable responsive behavior
        scrollX: true,     // Enable horizontal scrolling
        autoWidth: true,
        stripe: false,
        stateSave: false,
        bDestroy: true,
        pageLength: 10,
        language: {
            search: "",
            searchPlaceholder: "Search Orders...",
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