@extends('web.layout.app')

@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}">
<style>
    :root {
        --primary-color: #371502;
        --secondary-color: #9C7541;
        --text-color: #333;
        --border-color: #ddd;
        --shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        --background-color: #f9f9f9;
    }

    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, sans-serif;
        line-height: 1.6;
        background: var(--background-color);
        color: var(--text-color);
    }

    .container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 15px;
    }

    .cs_payment-title {
        font-size: 28px;
        color: var(--primary-color);
        font-weight: 600;
        margin-bottom: 25px;
    }

    .cs_shop-label {
        display: block;
        margin-bottom: 8px;
        font-weight: 500;
        color: var(--text-color);
    }

    .cs_shop-input {
        width: 100%;
        padding: 12px;
        border: 1px solid var(--border-color);
        border-radius: 8px;
        transition: border-color 0.3s, box-shadow 0.3s;
        font-size: 16px;
    }

    .cs_shop-input:focus {
        outline: none;
        border-color: var(--primary-color);
        box-shadow: 0 0 0 2px rgba(55, 21, 2, 0.1);
    }

    .cs_shop-input::placeholder {
        color: #aaa;
    }

    .cs_shop-card {
        background: white;
        padding: 30px;
        border-radius: 12px;
        box-shadow: var(--shadow);
        margin-bottom: 30px;
    }

    .cs_shop-card h2 {
        font-size: 21px;
        color: var(--primary-color);
        margin-bottom: 20px;
        font-weight: 600;
    }

    .cs_btn.cs_style_1 {
        display: inline-block;
        width: 100%;
        padding: 15px;
        background: var(--primary-color);
        color: white;
        border: none;
        border-radius: 8px;
        font-size: 16px;
        font-weight: 500;
        text-align: center;
        cursor: pointer;
        transition: opacity 0.3s;
        text-decoration: none;
    }

    .cs_btn.cs_style_1:hover {
        opacity: 0.9;
    }

    .cs_btn.cs_style_1:disabled {
        opacity: 0.5;
        cursor: not-allowed;
    }

    .cs_btn.cs_style_2 {
        background: white;
        color: var(--primary-color);
        border: 2px solid var(--primary-color);
    }

    .cs_btn.cs_style_2:hover {
        background: var(--primary-color);
        color: white;
    }

    .order-summary-item {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 15px 0;
        border-bottom: 1px solid #eee;
    }

    .order-summary-item:last-child {
        border-bottom: none;
    }

    .item-details {
        display: flex;
        align-items: center;
        gap: 15px;
    }

    .item-image {
        width: 60px;
        height: 60px;
        object-fit: cover;
        border-radius: 8px;
        border: 1px solid var(--border-color);
    }

    .item-info h4 {
        color: var(--primary-color);
        font-size: 16px;
        margin-bottom: 4px;
    }

    .item-info span {
        color: #666;
        font-size: 14px;
    }

    .item-price {
        font-weight: 600;
        color: var(--primary-color);
        font-size: 16px;
    }

    .total-section {
        border-top: 2px solid var(--primary-color);
        padding-top: 20px;
        margin-top: 20px;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .total-label {
        font-size: 24px;
        font-weight: 700;
        color: var(--primary-color);
    }

    .total-amount {
        font-size: 28px;
        font-weight: 700;
        color: var(--primary-color);
    }

    .info-section {
        background: #f8f9fa;
        padding: 20px;
        border-radius: 8px;
        border-left: 4px solid var(--primary-color);
        margin-bottom: 20px;
    }

    .info-section h3 {
        color: var(--primary-color);
        font-size: 18px;
        margin-bottom: 15px;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .info-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 15px;
    }

    .info-item strong {
        color: var(--primary-color);
        display: block;
        margin-bottom: 4px;
    }

    .security-notice {
        background: #e8f5e8;
        border: 1px solid #4caf50;
        border-radius: 8px;
        padding: 15px;
        margin-top: 20px;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .security-notice i {
        color: #4caf50;
        font-size: 20px;
    }

    .security-notice div strong {
        color: #2e7d32;
    }

    .security-notice div p {
        margin: 0;
        font-size: 14px;
        color: #2e7d32;
    }

    .accepted-cards {
        display: flex;
        gap: 10px;
        align-items: center;
        flex-wrap: wrap;
        margin-top: 15px;
    }

    .accepted-cards img {
        width: 40px;
        height: 25px;
        filter: grayscale(100%);
        transition: filter 0.3s;
    }

    .accepted-cards img:hover {
        filter: grayscale(0%);
    }

    /* Height Classes */
    .cs_height_25, .cs_height_lg_25 { height: 25px; }
    .cs_height_30, .cs_height_lg_30 { height: 30px; }
    .cs_height_40, .cs_height_lg_40 { height: 40px; }
    .cs_height_45, .cs_height_lg_45 { height: 45px; }
    .cs_height_50, .cs_height_lg_50 { height: 50px; }
    .cs_height_80, .cs_height_lg_60 { height: 80px; }
    .cs_height_140, .cs_height_lg_80 { height: 140px; }

    /* Page Header */
    .cs_shop_page_heading {
        text-align: center;
    }

    .cs_fs_50 {
        font-size: 50px;
        font-weight: 700;
        color: var(--primary-color);
        margin-bottom: 15px;
    }

    .cs_shop_breadcamp {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        font-size: 16px;
        color: #5E5E5E;
    }

    .cs_shop_breadcamp a {
        color: #5E5E5E;
        text-decoration: none;
    }

    .cs_shop_breadcamp a:hover {
        color: var(--primary-color);
    }

    .cs_shop_breadcamp svg {
        width: 17px;
        height: 8px;
    }

    .cs_medium {
        font-weight: 500;
    }

    /* Loading Animation */
    @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }

    .loading-spinner {
        width: 20px;
        height: 20px;
        border: 2px solid #ffffff40;
        border-top: 2px solid white;
        border-radius: 50%;
        animation: spin 1s linear infinite;
    }

    /* Responsive Design */
    @media (max-width: 1200px) {
        .container {
            padding: 0 20px;
        }
    }

    @media (max-width: 992px) {
        .row {
            flex-direction: column;
        }

        .col-xl-8, .col-xl-4 {
            width: 100%;
        }

        .cs_shop-side-spacing {
            margin-top: 40px;
        }

        .cs_height_140, .cs_height_lg_80 { height: 80px; }
        .cs_height_80, .cs_height_lg_60 { height: 60px; }
    }

    @media (max-width: 768px) {
        .cs_payment-title {
            font-size: 24px;
        }

        .cs_shop-card h2 {
            font-size: 18px;
        }

        .cs_shop-card {
            padding: 20px;
        }

        .cs_shop-input {
            padding: 10px;
            font-size: 14px;
        }

        .cs_btn.cs_style_1 {
            padding: 12px;
            font-size: 14px;
        }

        .cs_fs_50 {
            font-size: 36px;
        }

        .cs_shop_breadcamp {
            font-size: 14px;
        }

        .item-details {
            gap: 10px;
        }

        .item-image {
            width: 50px;
            height: 50px;
        }

        .total-section {
            flex-direction: column;
            align-items: flex-start;
            gap: 10px;
        }

        .info-grid {
            grid-template-columns: 1fr;
        }
    }

    @media (max-width: 480px) {
        .cs_payment-title {
            font-size: 20px;
        }

        .cs_shop-card h2 {
            font-size: 16px;
        }

        .cs_shop-card {
            padding: 15px;
        }

        .cs_btn.cs_style_1 {
            font-size: 13px;
        }

        .order-summary-item {
            flex-direction: column;
            align-items: flex-start;
            gap: 10px;
        }

        .item-details {
            width: 100%;
        }

        .accepted-cards {
            justify-content: center;
        }
    }
</style>

<div class="cs_height_140 cs_height_lg_80"></div>
<!-- Start Page Heading -->
<section>
    <div class="container">
        <div class="cs_height_80 cs_height_lg_60"></div>
        <div class="cs_shop_page_heading text-center">
            <h1 class="cs_fs_50 cs_bold">Payment</h1>
            <div class="cs_shop_breadcamp cs_medium">
                <a href="{{ route('web.view.index') }}">Home</a>
                <svg width="17" height="8" viewBox="0 0 17 8" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M16.3536 4.35355C16.5488 4.15829 16.5488 3.84171 16.3536 3.64645L13.1716 0.464467C12.9763 0.269205 12.6597 0.269205 12.4645 0.464467C12.2692 0.659729 12.2692 0.976312 12.4645 1.17157L15.2929 4L12.4645 6.82843C12.2692 7.02369 12.2692 7.34027 12.4645 7.53553C12.6597 7.7308 12.9763 7.7308 13.1716 7.53554L16.3536 4.35355ZM-4.37114e-08 4.5L16 4.5L16 3.5L4.37114e-08 3.5L-4.37114e-08 4.5Z" fill="#5E5E5E"/>
                </svg>
                <a href="{{ route('web.orders.view') }}">Checkout</a>
                <svg width="17" height="8" viewBox="0 0 17 8" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M16.3536 4.35355C16.5488 4.15829 16.5488 3.84171 16.3536 3.64645L13.1716 0.464467C12.9763 0.269205 12.6597 0.269205 12.4645 0.464467C12.2692 0.659729 12.2692 0.976312 12.4645 1.17157L15.2929 4L12.4645 6.82843C12.2692 7.02369 12.2692 7.34027 12.4645 7.53553C12.6597 7.7308 12.9763 7.7308 13.1716 7.53554L16.3536 4.35355ZM-4.37114e-08 4.5L16 4.5L16 3.5L4.37114e-08 3.5L-4.37114e-08 4.5Z" fill="#5E5E5E"/>
                </svg>
                <span>Payment</span>
            </div>
        </div>
        <div class="cs_height_80 cs_height_lg_60"></div>
    </div>
</section>

<!-- Start Payment -->
<div class="container">
    <div class="row">
        <div class="col-xl-8">
            <!-- Order Summary -->
            {{-- <div class="cs_shop-card">
                <h2><i class="fas fa-shopping-bag" style="margin-right: 8px;"></i>Order Summary</h2>
                <div id="orderSummaryItems">
                    <div style="text-align: center; padding: 20px; color: #666;">Loading order details...</div>
                </div>
                <div class="total-section">
                    <span class="total-label">Total:</span>
                    <span class="total-amount" id="finalTotal">$0.00</span>
                </div>
            </div> --}}

            <!-- Customer Information -->
            {{-- <div class="cs_shop-card">
                <h2><i class="fas fa-user" style="margin-right: 8px;"></i>Shipping Information</h2>
                <div class="info-section">
                    <div class="info-grid" id="customerInfo">
                        <div style="text-align: center; padding: 20px; color: #666;">Loading customer details...</div>
                    </div>
                </div>
            </div> --}}

            <!-- Payment Form -->
            <div class="cs_shop-card">
                <h2><i class="fas fa-lock" style="margin-right: 8px;"></i>Payment Details</h2>
                <form id="paymentForm" method="POST" action="{{ route('web.orders.store') }}">
                    @csrf
                    
                    <!-- Hidden fields -->
                    <input type="hidden" name="firstName" id="hiddenFirstName">
                    <input type="hidden" name="lastName" id="hiddenLastName">
                    <input type="hidden" name="email" id="hiddenEmail">
                    <input type="hidden" name="phone" id="hiddenPhone">
                    <input type="hidden" name="city" id="hiddenCity">
                    <input type="hidden" name="state" id="hiddenState">
                    <input type="hidden" name="address" id="hiddenAddress">
                    <input type="hidden" name="order_items" id="hiddenOrderItems">
                    <input type="hidden" name="total" id="hiddenTotal">
                    <input type="hidden" name="payment_method" value="stripe">

                    <div class="row">
                        <div class="col-lg-12">
                            <label class="cs_shop-label">Cardholder Name *</label>
                            <input type="text" class="cs_shop-input" name="cardholder_name" id="cardholderName" required 
                                   placeholder="Enter the full name as it appears on your card" autocomplete="cc-name">
                        </div>
                        <div class="col-lg-12">
                            <div class="cs_height_20 cs_height_lg_20"></div>
                            <label class="cs_shop-label">Card Number *</label>
                            <input type="text" class="cs_shop-input" name="card_number" id="cardNumber" required 
                                   placeholder="1234 5678 9012 3456" maxlength="19" autocomplete="cc-number">
                        </div>
                        <div class="col-lg-6">
                            <div class="cs_height_20 cs_height_lg_20"></div>
                            <label class="cs_shop-label">Expiry Date *</label>
                            <input type="text" class="cs_shop-input" name="card_expiry" id="cardExpiry" required 
                                   placeholder="MM/YY" maxlength="5" autocomplete="cc-exp">
                        </div>
                        <div class="col-lg-6">
                            <div class="cs_height_20 cs_height_lg_20"></div>
                            <label class="cs_shop-label">CVC *</label>
                            <input type="text" class="cs_shop-input" name="card_cvc" id="cardCvc" required 
                                   placeholder="123" maxlength="4" autocomplete="cc-csc">
                        </div>
                    </div>

                    <div class="security-notice">
                        <i class="fas fa-shield-alt"></i>
                        <div>
                            <strong>Your payment is secure</strong>
                            <p>We use industry-standard encryption to protect your payment information.</p>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="col-xl-4">
            <div class="cs_shop-side-spacing">
                <!-- Action Buttons -->
                <div class="cs_shop-card" style="text-align: center;">
                    <h2>Complete Order</h2>
                    
                    <button type="button" id="backToCheckoutBtn" class="cs_btn cs_style_2 cs_fs_16 cs_medium w-100" 
                            style="margin-bottom: 15px;">
                        <i class="fas fa-arrow-left" style="margin-right: 8px;"></i>
                        Back to Checkout
                    </button>

                    <button type="submit" form="paymentForm" id="payNowBtn" 
                            class="cs_btn cs_style_1 cs_fs_16 cs_medium w-100">
                        <span id="payNowBtnText">
                            <i class="fas fa-lock" style="margin-right: 8px;"></i>
                            Complete Payment (<span id="payButtonTotal">$0.00</span>)
                        </span>
                    </button>

                    <div style="margin-top: 15px;">
                        <small style="color: #666; display: block;">
                            <i class="fas fa-info-circle" style="margin-right: 4px;"></i>
                            You will be charged immediately
                        </small>
                    </div>
                </div>

                <!-- Accepted Cards -->
                <div class="cs_shop-card">
                    <h2>We Accept</h2>
                    <div class="accepted-cards">
                        <img src="https://cdn.jsdelivr.net/npm/simple-icons@v9/icons/visa.svg" alt="Visa">
                        <img src="https://cdn.jsdelivr.net/npm/simple-icons@v9/icons/mastercard.svg" alt="Mastercard">
                        <img src="https://cdn.jsdelivr.net/npm/simple-icons@v9/icons/americanexpress.svg" alt="American Express">
                        <img src="https://cdn.jsdelivr.net/npm/simple-icons@v9/icons/discover.svg" alt="Discover">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Payment -->
<div class="cs_height_90 cs_height_lg_50"></div>

<!-- SweetAlert2 CDN -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    console.log('💳 Payment page loaded');

    // Get order data from URL or localStorage
    function getOrderData() {
        const urlParams = new URLSearchParams(window.location.search);
        
        if (urlParams.has('data')) {
            try {
                return JSON.parse(atob(urlParams.get('data')));
            } catch (e) {
                console.error('Error parsing URL data:', e);
            }
        }

        const storedData = localStorage.getItem('orderData');
        if (storedData) {
            try {
                return JSON.parse(storedData);
            } catch (e) {
                console.error('Error parsing localStorage data:', e);
            }
        }

        return null;
    }

    // Populate page with order data
    function populateOrderData(orderData) {
        if (!orderData) return;

        // Fill hidden form fields
        document.getElementById('hiddenFirstName').value = orderData.firstName || '';
        document.getElementById('hiddenLastName').value = orderData.lastName || '';
        document.getElementById('hiddenEmail').value = orderData.email || '';
        document.getElementById('hiddenPhone').value = orderData.phone || '';
        document.getElementById('hiddenCity').value = orderData.city || '';
        document.getElementById('hiddenState').value = orderData.state || '';
        document.getElementById('hiddenAddress').value = orderData.address || '';
        document.getElementById('hiddenOrderItems').value = JSON.stringify(orderData.cart || []);
        document.getElementById('hiddenTotal').value = orderData.total || '0';

        // Populate order summary
        const summaryContainer = document.getElementById('orderSummaryItems');
        const cart = orderData.cart || [];
        
        if (cart.length > 0) {
            summaryContainer.innerHTML = '';
            cart.forEach(item => {
                const itemDiv = document.createElement('div');
                itemDiv.className = 'order-summary-item';
                itemDiv.innerHTML = `
                    <div class="item-details">
                        <img src="${item.image || '/placeholder.jpg'}" alt="${item.name}" class="item-image">
                        <div class="item-info">
                            <h4>${item.name}</h4>
                            <span>Quantity: ${item.quantity} × $${item.price.toFixed(2)}</span>
                        </div>
                    </div>
                    <div class="item-price">$${(item.price * item.quantity).toFixed(2)}</div>
                `;
                summaryContainer.appendChild(itemDiv);
            });
        } else {
            summaryContainer.innerHTML = '<div style="text-align: center; padding: 20px; color: #666;">No items found</div>';
        }

        // Update totals
        const total = parseFloat(orderData.total || 0);
        document.getElementById('finalTotal').textContent = '$' + total.toFixed(2);
        document.getElementById('payButtonTotal').textContent = '$' + total.toFixed(2);

        // Populate customer information
        const customerContainer = document.getElementById('customerInfo');
        customerContainer.innerHTML = `
            <div class="info-item">
                <strong>Name:</strong>
                <span>${orderData.firstName} ${orderData.lastName}</span>
            </div>
            <div class="info-item">
                <strong>Email:</strong>
                <span>${orderData.email}</span>
            </div>
            <div class="info-item">
                <strong>Phone:</strong>
                <span>${orderData.phone}</span>
            </div>
            <div class="info-item">
                <strong>Address:</strong>
                <span>${orderData.address}</span>
            </div>
            <div class="info-item">
                <strong>City:</strong>
                <span>${orderData.city}</span>
            </div>
            <div class="info-item">
                <strong>State:</strong>
                <span>${orderData.state}</span>
            </div>
        `;
    }

    // Card formatting functions
    function formatCardNumber(value) {
        const v = value.replace(/\s+/g, '').replace(/[^0-9]/gi, '');
        const matches = v.match(/\d{4,16}/g);
        const match = matches && matches[0] || '';
        const parts = [];
        for (let i = 0, len = match.length; i < len; i += 4) {
            parts.push(match.substring(i, i + 4));
        }
        return parts.length ? parts.join(' ') : v;
    }

    function formatExpiry(value) {
        const v = value.replace(/\s+/g, '').replace(/[^0-9]/gi, '');
        return v.length >= 2 ? v.substring(0, 2) + '/' + v.substring(2, 4) : v;
    }

    // Add input formatting
    document.getElementById('cardNumber').addEventListener('input', function(e) {
        e.target.value = formatCardNumber(e.target.value);
    });

    document.getElementById('cardExpiry').addEventListener('input', function(e) {
        e.target.value = formatExpiry(e.target.value);
    });

    document.getElementById('cardCvc').addEventListener('input', function(e) {
        e.target.value = e.target.value.replace(/[^0-9]/gi, '');
    });

    // Back button
    document.getElementById('backToCheckoutBtn').addEventListener('click', function() {
        window.history.back();
    });

    // Form submission
    document.getElementById('paymentForm').addEventListener('submit', function(e) {
        e.preventDefault();
        
        const payNowBtn = document.getElementById('payNowBtn');
        const payNowBtnText = document.getElementById('payNowBtnText');
        
        // Show loading state
        payNowBtn.disabled = true;
        payNowBtnText.innerHTML = `
            <div style="display: flex; align-items: center; justify-content: center; gap: 10px;">
                <div class="loading-spinner"></div>
                Processing Payment...
            </div>
        `;

        Swal.fire({
            title: 'Processing Payment...',
            text: 'Please wait while we securely process your payment.',
            icon: 'info',
            allowOutsideClick: false,
            allowEscapeKey: false,
            showConfirmButton: false,
            willOpen: () => {
                Swal.showLoading();
            }
        });

        // Submit form
        const formData = new FormData(this);
        
        fetch(this.action, {
            method: 'POST',
            body: formData,
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        })
        .then(response => response.json())
        .then(data => {
            Swal.close();
            
            if (data.success) {
                // Clear stored data
                localStorage.removeItem('orderData');
                localStorage.removeItem('ecommerce-cart'); // Updated to match cart.js
                localStorage.removeItem('ts-cart'); // Keep for backward compatibility
                
                // Clear cart using cart manager if available
                if (window.ecommerceCartManager && typeof window.ecommerceCartManager.clearCartAfterOrder === 'function') {
                    window.ecommerceCartManager.clearCartAfterOrder();
                }
                
                Swal.fire({
                    icon: 'success',
                    title: 'Payment Successful!',
                    html: `
                        <div style="text-align: center; padding: 20px;">
                            <div style="font-size: 48px; color: #4caf50; margin-bottom: 20px;">
                                <i class="fas fa-check-circle"></i>
                            </div>
                            <h3 style="color: var(--primary-color); margin-bottom: 15px;">Order Confirmed!</h3>
                            <p style="margin-bottom: 10px;"><strong>Order ID:</strong> #${data.order_id}</p>
                            <p style="margin-bottom: 10px;"><strong>Payment ID:</strong> ${data.payment_id}</p>
                            <p style="color: #666;">Thank you for your purchase! You will receive an email confirmation shortly.</p>
                        </div>
                    `,
                    confirmButtonText: 'Continue Shopping',
                    allowOutsideClick: false
                }).then(() => {
                    window.location.href = data.redirect_url || '{{ route("web.view.index") }}';
                });
            } else {
                throw new Error(data.message || 'Payment processing failed');
            }
        })
        .catch(error => {
            console.error('Payment error:', error);
            Swal.close();
            
            Swal.fire({
                icon: 'error',
                title: 'Payment Failed',
                text: error.message || 'There was an error processing your payment. Please try again.',
                confirmButtonText: 'Try Again'
            });
            
            // Reset button state
            payNowBtn.disabled = false;
            const total = document.getElementById('hiddenTotal').value;
            payNowBtnText.innerHTML = `
                <i class="fas fa-lock" style="margin-right: 8px;"></i>
                Complete Payment (<span>${parseFloat(total).toFixed(2)}</span>)
            `;
        });
    });

    // Initialize the page
    const orderData = getOrderData();
    
    if (!orderData) {
        Swal.fire({
            icon: 'error',
            title: 'No Order Data',
            text: 'No order information found. Please start from the checkout page.',
            confirmButtonText: 'Go to Checkout'
        }).then(() => {
            window.location.href = '{{ route("web.orders.view") }}';
        });
        return;
    }
    
    populateOrderData(orderData);
    console.log('✅ Payment page initialized successfully');
});
</script>

@endsection