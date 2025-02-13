@extends('web.layout.app')
@section('content')
    <style>
        :root {
            --primary-color: #8D68AD;
            --secondary-color: #f8f0ff;
            --text-color: #333;
            --border-color: #ddd;
            --shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, sans-serif;
            line-height: 1.6;
            background: #f9f9f9;
            color: var(--text-color);
        }

        /* Banner Styles */
        .shop-page-banner {
            position: relative;
            padding: 80px 0;
            background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('/api/placeholder/1920/400') center/cover;
            color: white;
            text-align: center;
            margin-bottom: 40px;
        }

        .shop-banner-title {
            font-size: 2.5rem;
            margin-bottom: 15px;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
        }

        .shop-banner-breadcrumb {
            display: flex;
            justify-content: center;
            gap: 10px;
            list-style: none;
        }

        /* Main Container */
        .order-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
            display: grid;
            grid-template-columns: 1fr 1.5fr;
            gap: 30px;
        }

        /* Form Styles */
        .order-form {
            background: white;
            padding: 30px;
            border-radius: 12px;
            box-shadow: var(--shadow);
        }

        .form-title {
            color: var(--primary-color);
            margin-bottom: 25px;
            font-size: 1.5rem;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
            color: #555;
        }

        .form-control {
            width: 100%;
            padding: 12px;
            border: 1px solid var(--border-color);
            border-radius: 8px;
            transition: border-color 0.3s;
        }

        .form-control:focus {
            outline: none;
            border-color: var(--primary-color);
        }

        .btn-primary {
            background: var(--primary-color);
            color: white;
            padding: 12px 24px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            width: 100%;
            font-size: 1rem;
            transition: opacity 0.3s;
        }

        .btn-primary:hover {
            opacity: 0.9;
        }

        /* Cart Styles */
        .order-cart {
            background: white;
            padding: 30px;
            border-radius: 12px;
            box-shadow: var(--shadow);
        }

        .cart-title {
            color: var(--primary-color);
            margin-bottom: 25px;
            font-size: 1.5rem;
        }

        .order-cart-item {
            display: grid;
            grid-template-columns: auto 1fr auto;
            gap: 20px;
            padding: 15px 0;
            border-bottom: 1px solid var(--border-color);
        }

        .order-cart-item img {
            width: 80px;
            height: 80px;
            object-fit: cover;
            border-radius: 8px;
        }

        .item-details h4 {
            margin-bottom: 8px;
            color: var(--text-color);
        }

        .item-controls {
            display: flex;
            gap: 8px;
            align-items: center;
        }

        .item-controls button {
            padding: 6px 12px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            background: var(--secondary-color);
            color: var(--primary-color);
            transition: background 0.3s;
        }

        .item-controls button:hover {
            background: var(--primary-color);
            color: white;
        }

        .order-total {
            margin-top: 20px;
            text-align: right;
            font-size: 1.2rem;
            font-weight: bold;
            color: var(--primary-color);
        }

        /* Responsive Design */
        @media (max-width: 992px) {
            .order-container {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 768px) {
            .shop-banner-title {
                font-size: 2rem;
            }
            
            .order-cart-item {
                grid-template-columns: 1fr;
                text-align: center;
            }
            
            .item-controls {
                justify-content: center;
            }
            
            .order-cart-item img {
                margin: 0 auto;
            }
        }

        @media (max-width: 480px) {
            .shop-banner-title {
                font-size: 1.5rem;
            }
            
            .order-form, .order-cart {
                padding: 20px;
            }
        }

        .error-msg {
            text-align: center;
            padding: 20px;
            color: #666;
            font-style: italic;
        }
    </style>
</head>
<body>
<!-- start shop-page-banner -->
@if(isset($shopBanner) && $shopBanner->image)
<section class="shop-page-banner" style="background: url('{{ asset('storage/'.$shopBanner->image) }}') no-repeat center center/cover;">
    <div class="container">
        <div class="row">
            <div class="col col-xs-12">
                <div class="shop-banner-content">
                    <h2 class="shop-banner-title">Orders</h2>
                    <ol class="shop-banner-breadcrumb">
                        <!-- <li><a href="{{ url('/') }}">{{ $shopBanner->subtitle ?? 'Home' }}</a></li> -->
                        <!-- <li>about</li> -->
                    </ol>
                </div>
            </div>
        </div>
    </div>
</section>
@else
<section class="shop-page-banner">
    <div class="container">
        <div class="row">
            <div class="col col-xs-12">
                <div class="shop-banner-content">
                    <h2 class="shop-banner-title">about us</h2>
                    <ol class="shop-banner-breadcrumb">
                        <li><a href="index.html">Home</a></li>
                        <li>about</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
</section>
@endif

<style>
.shop-page-banner {
    position: relative;
    padding: 120px 0 80px; /* Increased top padding to account for navbar */
    background-color: #f5f5f5;
    margin-top: 0; /* Remove any top margin */
    z-index: 1; /* Ensure banner is above default elements */
    min-height: 300px; /* Minimum height for the banner */
    display: flex;
    align-items: center;
}

.shop-banner-content {
    text-align: center;
    max-width: 800px;
    margin: 0 auto;
    padding: 0 15px;
    position: relative; /* Ensure content stays above background */
    z-index: 2;
}

.shop-banner-title {
    font-size: 48px;
    color: #fff;
    margin-bottom: 15px;
    font-weight: 700;
    text-transform: capitalize;
    text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
}

.shop-banner-breadcrumb {
    list-style: none;
    padding: 0;
    margin: 0;
    display: flex;
    justify-content: center;
    align-items: center;
    gap: 10px;
}

.shop-banner-breadcrumb li {
    color: #fff;
    font-size: 16px;
    position: relative;
}

.shop-banner-breadcrumb li a {
    color: #fff;
    text-decoration: none;
}

.shop-banner-breadcrumb li:not(:last-child)::after {
    content: "/";
    margin-left: 10px;
    color: #fff;
}

/* Tablet Responsive */
@media (max-width: 768px) {
    .shop-page-banner {
        padding: 100px 0 60px; /* Adjusted padding for mobile */
        min-height: 250px;
    }
    
    .shop-banner-title {
        font-size: 36px;
    }
    
    .shop-banner-breadcrumb li {
        font-size: 14px;
    }
}

/* Mobile Responsive */
@media (max-width: 480px) {
    .shop-page-banner {
        padding: 80px 0 40px;
        min-height: 200px;
    }
    
    .shop-banner-title {
        font-size: 28px;
    }
    
    .shop-banner-breadcrumb li {
        font-size: 13px;
    }
}
</style>

<!-- Added desktop banner margin fix -->
<style>
@media (min-width: 992px) {
    .shop-page-banner {
        margin-top: 130px !important;
    }
}
</style>

    <!-- Main Order Container -->
    <div class="order-container">
        <!-- Left: Order Form -->
        <aside class="order-form">
            <h2 class="form-title">Customer Information</h2>
            <!-- Updated to use a normal POST request -->
            <form id="orderForm" method="POST" action="{{ route('web.orders.store') }}">
                @csrf
                <div class="form-group">
                    <label for="firstName">First Name</label>
                    <input type="text" class="form-control" id="firstName" name="firstName" required>
                </div>
                <div class="form-group">
                    <label for="lastName">Last Name</label>
                    <input type="text" class="form-control" id="lastName" name="lastName" required>
                </div>
                <div class="form-group">
                    <label for="email">Email Address</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>
                <div class="form-group">
                    <label for="phone">Phone Number</label>
                    <input type="tel" class="form-control" id="phone" name="phone" required>
                </div>
                <div class="form-group">
                    <label for="address">Street Address</label>
                    <textarea class="form-control" id="address" name="address" rows="3" required></textarea>
                </div>
                <div class="form-group">
                    <label for="postalCode">Postal Code</label>
                    <input type="text" class="form-control" id="postalCode" name="postalCode" required>
                </div>
                <div class="form-group">
                    <label for="city">City</label>
                    <input type="text" class="form-control" id="city" name="city" required>
                </div>
                <div class="form-group">
                    <label for="country">Country</label>
                    <select class="form-control" id="country" name="country" required>
                        <option value="">Select Country</option>
                        <option value="USA">United States</option>
                        <option value="Canada">Canada</option>
                        <option value="UK">United Kingdom</option>
                    </select>
                </div>

                <!-- Hidden inputs to send order details -->
                <input type="hidden" name="order_items" id="orderItemsInput">
                <input type="hidden" name="total" id="orderTotalInput">

                <button type="submit" class="btn-primary">
                    <i class="fas fa-shopping-cart"></i> Place Order
                </button>
            </form>
        </aside>

        <!-- Right: Order Cart Items -->
        <section class="order-cart">
            <h2 class="cart-title">Order Summary</h2>
            <div id="orderItems">
                <!-- Cart items will be rendered here -->
            </div>
            <div class="order-total">
                Total: <span id="orderTotal">$0.00</span>
            </div>
        </section>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            function loadCart() {
                const cart = localStorage.getItem('ts-cart');
                return cart ? JSON.parse(cart) : [];
            }

            function saveCart(cart) {
                localStorage.setItem('ts-cart', JSON.stringify(cart));
            }

            function renderCart() {
                const cart = loadCart();
                const orderItems = document.getElementById('orderItems');
                const orderTotalEl = document.getElementById('orderTotal');
                const orderForm = document.getElementById('orderForm');
                
                if (cart.length === 0) {
                    orderItems.innerHTML = '<div class="error-msg">Your cart is empty. Please add items to your cart first.</div>';
                    orderTotalEl.textContent = '$0.00';
                    orderForm.style.display = 'none';
                    return;
                }
                
                orderItems.innerHTML = '';
                let total = 0;
                
                cart.forEach(item => {
                    total += item.price * item.quantity;
                    const itemDiv = document.createElement('div');
                    itemDiv.className = 'order-cart-item';
                    itemDiv.innerHTML = `
                        <img src="${item.image || '/api/placeholder/80/80'}" alt="${item.name}">
                        <div class="item-details">
                            <h4>${item.name}</h4>
                            <p>$${item.price.toFixed(2)} x ${item.quantity}</p>
                        </div>
                        <div class="item-controls">
                            <button data-action="decrease" data-id="${item.id}">
                                <i class="fas fa-minus"></i>
                            </button>
                            <button data-action="increase" data-id="${item.id}">
                                <i class="fas fa-plus"></i>
                            </button>
                            <button data-action="remove" data-id="${item.id}">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                    `;
                    orderItems.appendChild(itemDiv);
                });
                
                orderTotalEl.textContent = '$' + total.toFixed(2);

                // Assign hidden inputs for backend submission
                document.getElementById('orderItemsInput').value = JSON.stringify(cart);
                document.getElementById('orderTotalInput').value = total.toFixed(2);
            }

            function updateCartItem(productId, action) {
                let cart = loadCart();
                cart = cart.map(item => {
                    if (item.id == productId) {
                        if (action === 'increase' && item.quantity < 99) {
                            item.quantity++;
                        } else if (action === 'decrease' && item.quantity > 1) {
                            item.quantity--;
                        }
                    }
                    return item;
                }).filter(item => item.quantity > 0);
                saveCart(cart);
                renderCart();
            }

            function removeCartItem(productId) {
                let cart = loadCart();
                cart = cart.filter(item => item.id != productId);
                saveCart(cart);
                renderCart();
            }

            document.getElementById('orderItems').addEventListener('click', function(e) {
                if (e.target.closest('button')) {
                    const button = e.target.closest('button');
                    const action = button.getAttribute('data-action');
                    const productId = button.getAttribute('data-id');
                    
                    if (action === 'increase' || action === 'decrease') {
                        updateCartItem(productId, action);
                    } else if (action === 'remove') {
                        removeCartItem(productId);
                    }
                }
            });

            document.getElementById('orderForm').addEventListener('submit', function() {
                // Just let the form submit normally
            });

            renderCart();
        });
    </script>

@endsection