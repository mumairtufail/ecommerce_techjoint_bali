@extends('admin.layout.app')
@section('content')

<!-- Breadcrumbs -->
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                        <li class="breadcrumb-item active">Orders</li>
                    </ol>
                </div>
                <h4 class="page-title">Orders Management</h4>
            </div>
        </div>
    </div>
</div>

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
                        <th>Products</th>
                        <th>Total Amount</th>
                        <th>Payment Status</th>
                        <th>Order Status</th>
                        <th>Order Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>ORDER101</td>
                        <td>John Doe</td>
                        <td>3 items</td>
                        <td>$50.00</td>
                        <td><span class="badge badge-soft-warning">Pending</span></td>
                        <td><span class="badge badge-soft-info">Processing</span></td>
                        <td>June 12, 2023</td>
                        <td>
                            <button class="btn btn-sm btn-info" title="Edit">
                                <i class="fa fa-edit"></i>
                            </button>
                            <button class="btn btn-sm btn-danger" title="Delete">
                                <i class="fa fa-trash"></i>
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Create Order Modal -->
<div class="modal fade" id="createOrderModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Create New Order</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="createOrderForm" action="#" method="POST">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Customer Name</label>
                                <input type="text" class="form-control" name="customer_name" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Email</label>
                                <input type="email" class="form-control" name="email" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Phone</label>
                                <input type="text" class="form-control" name="phone" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Payment Status</label>
                                <select class="form-control" name="payment_status" required>
                                    <option value="pending">Pending</option>
                                    <option value="paid">Paid</option>
                                    <option value="failed">Failed</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Shipping Address</label>
                        <textarea class="form-control" name="shipping_address" rows="3" required></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Create Order</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Order Modal -->
<div class="modal fade" id="editOrderModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Order</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="editOrderForm" method="POST">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Customer Name</label>
                                <input type="text" class="form-control" name="customer_name" id="edit_customer_name" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Email</label>
                                <input type="email" class="form-control" name="email" id="edit_email" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Phone</label>
                                <input type="text" class="form-control" name="phone" id="edit_phone" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Order Status</label>
                                <select class="form-control" name="status" id="edit_status" required>
                                    <option value="processing">Processing</option>
                                    <option value="shipped">Shipped</option>
                                    <option value="delivered">Delivered</option>
                                    <option value="cancelled">Cancelled</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Shipping Address</label>
                        <textarea class="form-control" name="shipping_address" id="edit_shipping_address" rows="3" required></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Update Order</button>
                </div>
            </form>
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
        responsive: true
    });

    // Comment out or remove AJAX since there's no backend
    // Edit Order
    // $('.edit-btn').on('click', function() {
    //     var orderId = $(this).data('id');
        
    //     // Fetch order data
    //     $.get(`/admin/orders/${orderId}/edit`, function(data) {
    //         $('#editOrderForm').attr('action', `/admin/orders/${orderId}`);
    //         $('#edit_customer_name').val(data.customer_name);
    //         $('#edit_email').val(data.email);
    //         $('#edit_phone').val(data.phone);
    //         $('#edit_status').val(data.status);
    //         $('#edit_shipping_address').val(data.shipping_address);
    //         $('#editOrderModal').modal('show');
    //     });
    // });

    // Delete Order
    // $('.delete-btn').on('click', function() {
    //     var orderId = $(this).data('id');
        
    //     Swal.fire({
    //         title: 'Are you sure?',
    //         text: "You won't be able to revert this!",
    //         icon: 'warning',
    //         showCancelButton: true,
    //         confirmButtonColor: '#3085d6',
    //         cancelButtonColor: '#d33',
    //         confirmButtonText: 'Yes, delete it!'
    //     }).then((result) => {
    //         if (result.isConfirmed) {
    //             $.ajax({
    //                 url: `/admin/orders/${orderId}`,
    //                 type: 'DELETE',
    //                 data: {
    //                     _token: '{{ csrf_token() }}'
    //                 },
    //                 success: function(response) {
    //                     Swal.fire(
    //                         'Deleted!',
    //                         'Order has been deleted.',
    //                         'success'
    //                     ).then(() => {
    //                         location.reload();
    //                     });
    //                 },
    //                 error: function(xhr) {
    //                     Swal.fire(
    //                         'Error!',
    //                         'Something went wrong.',
    //                         'error'
    //                     );
    //                 }
    //             });
    //         }
    //     });
    // });

    // Form Validation
    // $('#createOrderForm, #editOrderForm').on('submit', function(e) {
    //     e.preventDefault();
    //     var form = $(this);
        
    //     $.ajax({
    //         url: form.attr('action'),
    //         type: form.attr('method'),
    //         data: form.serialize(),
    //         success: function(response) {
    //             Swal.fire({
    //                 icon: 'success',
    //                 title: 'Success',
    //                 text: response.message
    //             }).then(() => {
    //                 location.reload();
    //             });
    //         },
    //         error: function(xhr) {
    //             Swal.fire({
    //                 icon: 'error',
    //                 title: 'Error',
    //                 text: 'Please check all required fields'
    //             });
    //         }
    //     });
    // });
});
</script>
@endpush