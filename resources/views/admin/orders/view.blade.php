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
                        {{-- <button id="openOrderModal" class="btn custom-btn-primary" data-bs-toggle="modal" data-bs-target="#createOrderModal">
                            <i class="fa fa-plus me-2"></i>Create New Order
                        </button> --}}
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
                                            <a href="{{ route('admin.orders.show', $order->id) }}" class="action-btn view-order">
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

@endsection