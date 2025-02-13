@extends('admin.layout.app')
@section('content')

<!-- Main Content -->
<div class="card">
    <div class="card-body">
        <div class="row mb-3">
            <div class="col-md-6">
                <h5 class="card-title">Orders List</h5>
            </div>
            <div class="col-md-6 text-right">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#createOrderModal">
                    <i class="fa fa-plus"></i> Create New Order
                </button>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table table-centered table-striped" id="orders-table">
                <thead>
                    <tr>
                        <th>Order ID</th>
                        <th>Customer</th>
                        <th>Contact</th>
                        <th>Location</th>
                        <th>Items</th>
                        <th>Total Amount</th>
                        <th>Order Date</th>
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
                                $items = json_decode($order->order_items, true) ?: [];
                                $itemCount = collect($items)->sum('quantity');
                            @endphp
                            <span class="badge badge-soft-info">{{ $itemCount }} items</span>
                        </td>
                        <td>
                            <span class="text-success font-weight-bold">${{ number_format($order->total, 2) }}</span>
                        </td>
                        <td>{{ \Carbon\Carbon::parse($order->created_at)->format('M d, Y') }}</td>
                        <td>
                            <button class="btn btn-sm btn-info view-order-detail" 
                                    data-toggle="modal" 
                                    data-target="#viewOrderModal" 
                                    data-order="@json($order)">
                                <i class="fas fa-eye"></i> View
                            </button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- View Order Detail Modal -->
<div class="modal fade" id="viewOrderModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Order Details</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row mb-4">
                    <div class="col-md-6">
                        <h6 class="text-muted mb-3">Customer Information</h6>
                        <table class="table table-sm table-borderless">
                            <tr>
                                <td width="35%"><strong>Name:</strong></td>
                                <td id="customer-name"></td>
                            </tr>
                            <tr>
                                <td><strong>Email:</strong></td>
                                <td id="customer-email"></td>
                            </tr>
                            <tr>
                                <td><strong>Phone:</strong></td>
                                <td id="customer-phone"></td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-md-6">
                        <h6 class="text-muted mb-3">Shipping Information</h6>
                        <table class="table table-sm table-borderless">
                            <tr>
                                <td width="35%"><strong>City:</strong></td>
                                <td id="shipping-city"></td>
                            </tr>
                            <tr>
                                <td><strong>Country:</strong></td>
                                <td id="shipping-country"></td>
                            </tr>
                            <tr>
                                <td><strong>Postal Code:</strong></td>
                                <td id="shipping-postal"></td>
                            </tr>
                        </table>
                    </div>
                </div>

                <h6 class="text-muted mb-3">Order Items</h6>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Product</th>
                                <th>Image</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th class="text-right">Total</th>
                            </tr>
                        </thead>
                        <tbody id="order-items">
                            <!-- Items will be inserted here -->
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="4" class="text-right"><strong>Total Amount:</strong></td>
                                <td class="text-right" id="order-total"></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
$(document).ready(function() {
    // Initialize DataTable
    $('#orders-table').DataTable({
        pageLength: 10,
        ordering: true,
        responsive: true,
        language: {
            search: "",
            searchPlaceholder: "Search orders..."
        }
    });

    // Handle View Order Details
    $('.view-order-detail').on('click', function() {
        const orderData = $(this).data('order');
        console.log(orderData);
        
        // Update Customer Information
        $('#customer-name').text(`${orderData.first_name} ${orderData.last_name}`);
        $('#customer-email').text(orderData.email);
        $('#customer-phone').text(orderData.phone);
        
        // Update Shipping Information
        $('#shipping-city').text(orderData.city);
        $('#shipping-country').text(orderData.country);
        $('#shipping-postal').text(orderData.postal_code);
        
        // Parse and display order items
        const items = JSON.parse(orderData.order_items);
        let itemsHtml = '';
        
        items.forEach(item => {
            const itemTotal = (item.price * item.quantity).toFixed(2);
            itemsHtml += `
                <tr>
                    <td>${item.name}</td>
                    <td>
                        <img src="${item.image}" alt="${item.name}" class="img-thumbnail" style="height: 50px;">
                    </td>
                    <td>$${item.price.toFixed(2)}</td>
                    <td>${item.quantity}</td>
                    <td class="text-right">$${itemTotal}</td>
                </tr>
            `;
        });
        
        $('#order-items').html(itemsHtml);
        $('#order-total').text(`$${parseFloat(orderData.total).toFixed(2)}`);
    });
});
</script>
@endpush