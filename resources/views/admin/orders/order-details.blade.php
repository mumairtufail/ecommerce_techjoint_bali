@extends('admin.layout.app')
@section('content')

<div class="container-fluid mt-xl-50 mt-sm-30 mt-15">
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.orders.index') }}">Orders</a></li>
            <li class="breadcrumb-item active" aria-current="page">Order #{{ $order->id }}</li>
        </ol>
    </nav>
    <!-- Page Header -->
    <div class="hk-pg-header">
        <h4 class="hk-pg-title">
            <span class="pg-title-icon"><i class="fa fa-shopping-cart"></i></span>
            Order Details #{{ $order->id }}
        </h4>
    </div>

    <!-- Content Section -->
    <div class="row">
        <div class="col-xl-12">
            <section class="hk-sec-wrapper">
                <div class="row mb-4">
                    <div class="col-md-6">
                        <h6 class="text-muted mb-3">Customer Information</h6>
                        <table class="table table-sm table-borderless">
                            <tr>
                                <td width="35%"><strong>Name:</strong></td>
                                <td>{{ $order->first_name }} {{ $order->last_name }}</td>
                            </tr>
                            <tr>
                                <td><strong>Email:</strong></td>
                                <td>{{ $order->email }}</td>
                            </tr>
                            <tr>
                                <td><strong>Phone:</strong></td>
                                <td>{{ $order->phone }}</td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-md-6">
                        <h6 class="text-muted mb-3">Shipping Information</h6>
                        <table class="table table-sm table-borderless">
                            <tr>
                                <td width="35%"><strong>City:</strong></td>
                                <td>{{ $order->city }}</td>
                            </tr>
                            <tr>
                                <td><strong>Country:</strong></td>
                                <td>{{ $order->country }}</td>
                            </tr>
                            <tr>
                                <td><strong>Postal Code:</strong></td>
                                <td>{{ $order->postal_code ?? 'N/A' }}</td>
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
                        <tbody>
                            @php
                                $items = json_decode($order->order_items, true) ?: [];
                            @endphp
                            @foreach($items as $item)
                            <tr>
                                <td>{{ $item['name'] }}</td>
                                <td>
                                    <img src="{{ $item['image'] }}" alt="{{ $item['name'] }}" class="img-thumbnail" style="height: 50px;">
                                </td>
                                <td>${{ number_format($item['price'], 2) }}</td>
                                <td>{{ $item['quantity'] }}</td>
                                <td class="text-right">${{ number_format($item['price'] * $item['quantity'], 2) }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="4" class="text-right"><strong>Total Amount:</strong></td>
                                <td class="text-right">${{ number_format($order->total, 2) }}</td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
                <div class="mt-3">
                    <a href="{{ route('admin.orders.index') }}" class="btn btn-secondary">Back to Orders</a>
                </div>
            </section>
        </div>
    </div>
</div>

@endsection