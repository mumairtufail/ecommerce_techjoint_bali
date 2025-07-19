@extends('web.layout.app')

@section('content')
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

    .cs_checkout-title {
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
        transition: border-color 0.3s;
        font-size: 16px;
    }

    .cs_shop-input:focus {
        outline: none;
        border-color: var(--primary-color);
    }

    .cs_shop-input::placeholder {
        color: #aaa;
    }

    .cs_checkout-alert {
        font-size: 16px;
        color: var(--text-color);
    }

    .cs_checkout-alert a {
        color: var(--primary-color);
        text-decoration: none;
    }

    .cs_checkout-alert a:hover {
        text-decoration: underline;
    }

    .cs_shop-card {
        background: white;
        padding: 30px;
        border-radius: 12px;
        box-shadow: var(--shadow);
    }

    .cs_shop-card h2 {
        font-size: 21px;
        color: var(--primary-color);
        margin-bottom: 20px;
        font-weight: 600;
    }

    .cs_shop-card table {
        width: 100%;
        border-collapse: collapse;
    }

    .cs_shop-card td {
        padding: 10px 0;
        font-size: 16px;
        color: var(--text-color);
    }

    .cs_shop-card .cs_semi_bold {
        font-weight: 600;
    }

    .cs_shop-card .text-end {
        text-align: right;
    }

    .cs_btn.cs_style_1 {
        display: inline-block;
        width: 100%;
        padding: 12px;
        background: var(--primary-color);
        color: white;
        border: none;
        border-radius: 8px;
        font-size: 16px;
        font-weight: 500;
        text-align: center;
        cursor: pointer;
        transition: opacity 0.3s;
    }

    .cs_btn.cs_style_1:hover {
        opacity: 0.9;
    }

    .cs_btn.cs_style_1[disabled] {
        opacity: 0.5;
        cursor: not-allowed;
    }

    .cs_payment_text {
        font-size: 14px;
        color: #666;
    }

    .cs_payment_text a {
        color: var(--primary-color);
        text-decoration: none;
    }

    .cs_payment_text a:hover {
        text-decoration: underline;
    }

    .form-check {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .form-check-input {
        width: 18px;
        height: 18px;
        margin: 0;
    }

    .form-check-label {
        font-size: 16px;
        font-weight: 600;
        color: var(--text-color);
    }

    .item-controls {
        display: flex;
        gap: 8px;
        align-items: center;
        margin-top: 8px;
    }

    .item-controls button {
        padding: 6px 12px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        background: var(--secondary-color);
        color: white;
        transition: background 0.3s;
    }

    .item-controls button:hover {
        background: var(--primary-color);
    }

    .error-msg {
        text-align: center;
        padding: 20px;
        color: #666;
        font-style: italic;
        font-size: 16px;
    }

    .cs_height_25, .cs_height_lg_25 { height: 25px; }
    .cs_height_30, .cs_height_lg_30 { height: 30px; }
    .cs_height_40, .cs_height_lg_40 { height: 40px; }
    .cs_height_45, .cs_height_lg_45 { height: 45px; }
    .cs_height_50, .cs_height_lg_50 { height: 50px; }
    .cs_height_80, .cs_height_lg_60 { height: 80px; }
    .cs_height_140, .cs_height_lg_80 { height: 140px; }

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

    #emailValidationStatus {
        font-size: 14px;
    }

    #otpSection {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    #otpInput {
        width: 120px;
        display: inline-block;
    }

    #otpTimer {
        font-size: 14px;
        color: var(--primary-color);
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

        .col-xl-7, .col-xl-5 {
            width: 100%;
        }

        .cs_shop-side-spacing {
            margin-top: 40px;
        }

        .cs_height_140, .cs_height_lg_80 { height: 80px; }
        .cs_height_80, .cs_height_lg_60 { height: 60px; }
    }

    @media (max-width: 768px) {
        .cs_checkout-title {
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
            padding: 10px;
            font-size: 14px;
        }

        .cs_fs_50 {
            font-size: 36px;
        }

        .cs_shop_breadcamp {
            font-size: 14px;
        }

        #otpSection {
            flex-direction: column;
            align-items: flex-start;
        }

        #otpInput {
            width: 100%;
        }
    }

    @media (max-width: 480px) {
        .cs_checkout-title {
            font-size: 20px;
        }

        .cs_shop-card h2 {
            font-size: 16px;
        }

        .cs_shop-card td {
            font-size: 14px;
        }

        .item-controls button {
            padding: 4px 8px;
        }

        .cs_btn.cs_style_1 {
            font-size: 13px;
        }

        .cs_shop_breadcamp {
            flex-wrap: wrap;
            gap: 5px;
        }
    }
</style>

<div class="cs_height_140 cs_height_lg_80"></div>
<!-- Start Cart Page Heading -->
<section>
    <div class="container">
        <div class="cs_height_80 cs_height_lg_60"></div>
        <div class="cs_shop_page_heading text-center">
            <h1 class="cs_fs_50 cs_bold">Checkout</h1>
            <div class="cs_shop_breadcamp cs_medium">
                <a href="{{ route('web.view.index') }}">Home</a>
                <svg width="17" height="8" viewBox="0 0 17 8" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M16.3536 4.35355C16.5488 4.15829 16.5488 3.84171 16.3536 3.64645L13.1716 0.464467C12.9763 0.269205 12.6597 0.269205 12.4645 0.464467C12.2692 0.659729 12.2692 0.976312 12.4645 1.17157L15.2929 4L12.4645 6.82843C12.2692 7.02369 12.2692 7.34027 12.4645 7.53553C12.6597 7.7308 12.9763 7.7308 13.1716 7.53554L16.3536 4.35355ZM-4.37114e-08 4.5L16 4.5L16 3.5L4.37114e-08 3.5L-4.37114e-08 4.5Z" fill="#5E5E5E"/>
                </svg>
                <span>Checkout</span>
            </div>
        </div>
        <div class="cs_height_80 cs_height_lg_60"></div>
    </div>
</section>
<!-- Start Checkout -->
<div class="container">
    <div class="row">
        <div class="col-xl-7">
            <p class="cs_checkout-alert m-0">Have a coupon? <a href="#">Click here to enter your code</a></p>
            <div class="cs_height_40 cs_height_lg_40"></div>
            <h2 class="cs_checkout-title cs_fs_28">Billing Details</h2>
            <div class="cs_height_45 cs_height_lg_40"></div>
            <form id="orderForm" method="POST" action="{{ route('web.orders.store') }}">
                @csrf
                <div class="row">
                    <!-- EMAIL & PHONE AT TOP -->
                    <div class="col-lg-6">
                        <label class="cs_shop-label">Email address *</label>
                        <div style="display:flex;gap:10px;align-items:center;">
                            <input type="email" class="cs_shop-input" name="email" id="email" required>
                            <button type="button" class="cs_btn cs_style_1" id="validateEmailBtn" style="width:auto;">Validate</button>
                        </div>
                        <div id="emailValidationStatus" style="margin-top:7px;font-size:14px;"></div>
                        <div id="otpSection" style="display:none;margin-top:7px;">
                            <input type="text" maxlength="4" class="cs_shop-input" id="otpInput" placeholder="Enter OTP" style="width:120px;display:inline-block;">
                            <span id="otpTimer" style="margin-left:10px;font-size:14px;color:var(--primary-color);"></span>
                            <button type="button" id="verifyOtpBtn" class="cs_btn cs_style_1" style="width:auto;margin-left:10px;">Verify</button>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <label class="cs_shop-label">Phone *</label>
                        <input type="tel" class="cs_shop-input" name="phone" id="phone" required>
                    </div>
                    <!-- REST OF FIELDS -->
                    <div class="col-lg-6">
                        <label class="cs_shop-label">First Name *</label>
                        <input type="text" class="cs_shop-input" name="firstName" required>
                        <div data-lastpass-icon-root="true" style="position: relative !important; height: 0px !important; width: 0px !important; float: left !important;"></div>
                    </div>
                    <div class="col-lg-6">
                        <label class="cs_shop-label">Last Name *</label>
                        <input type="text" class="cs_shop-input" name="lastName" required>
                    </div>
                    <div class="col-lg-12">
                        <label class="cs_shop-label">Country / Region *</label>
                        <select class="cs_shop-input" name="country" required>
                            <option value="">Select Country</option>
                            <option value="States">United States (US)</option>
                            <option value="Kingdom">United Kingdom</option>
                            <option value="Kanada">Canada</option>
                        </select>
                    </div>
                    <div class="col-lg-12">
                        <label class="cs_shop-label">Street address *</label>
                        <input type="text" class="cs_shop-input" name="address" placeholder="House number and street name" required>
                        <input type="text" class="cs_shop-input" name="address2" placeholder="Apartment, suite, unit, etc (optional)">
                    </div>
                    <div class="col-lg-12">
                        <label class="cs_shop-label">Town / City *</label>
                        <input type="text" class="cs_shop-input" name="city" required>
                    </div>
                    <div class="col-lg-12">
                        <label class="cs_shop-label">State *</label>
                        <select class="cs_shop-input" name="state" required>
                            <option value="">Select State</option>
                            <option value="California">California</option>
                            <option value="Gercy">New Jersey</option>
                            <option value="Daiking">Texas</option>
                        </select>
                    </div>
                    <div class="col-lg-12">
                        <label class="cs_shop-label">ZIP Code *</label>
                        <input type="text" class="cs_shop-input" name="postalCode" required>
                    </div>
                    <div class="cs_height_45 cs_height_lg_45"></div>
                    <h2 class="cs_checkout-title">Additional information</h2>
                    <div class="cs_height_25 cs_height_lg_25"></div>
                    <label class="cs_shop-label">Order notes (optional)</label>
                    <textarea cols="30" rows="6" class="cs_shop-input" name="orderNotes"></textarea>
                    <div class="cs_height_30 cs_height_lg_30"></div>
                    <!-- Hidden inputs for order details -->
                    <input type="hidden" name="order_items" id="orderItemsInput">
                    <input type="hidden" name="total" id="orderTotalInput">
                </div>
            </form>
        </div>
        <div class="col-xl-5">
            <div class="cs_shop-side-spacing">
                <div class="cs_shop-card">
                    <h2 class="cs_fs_21">Your order</h2>
                    <table>
                        <tbody>
                            <tr class="cs_semi_bold">
                                <td>Products</td>
                                <td class="text-end">Amount</td>
                            </tr>
                            <tbody id="orderItems">
                                <!-- Cart items will be rendered here -->
                            </tbody>
                            <tr class="cs_semi_bold">
                                <td>Subtotal</td>
                                <td class="text-end" id="orderSubtotal">$0.00</td>
                            </tr>
                            <tr class="cs_semi_bold">
                                <td>Total</td>
                                <td class="text-end" id="orderTotal">$0.00</td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="cs_height_30 cs_height_lg_30"></div>
                    <button type="submit" form="orderForm" class="cs_btn cs_style_1 cs_fs_16 cs_medium w-100" id="placeOrderBtn">Place Order</button>
                </div>
                <div class="cs_height_50 cs_height_lg_30"></div>
                <div class="cs_shop-card">
                    <h2 class="cs_fs_21">Payment</h2>
                    <table>
                        <tbody>
                            <tr>
                                <td>
                                    <div class="form-check cs_fs_16">
                                        <input class="form-check-input" type="checkbox" name="paymentMethod" id="flexCheckDefault" value="cash_on_delivery" checked>
                                        <label class="form-check-label m-0 cs_semi_bold" for="flexCheckDefault">
                                            Cash on delivery
                                        </label>
                                    </div>
                                    <p class="m-0 cs_payment_text">Pay with cash upon delivery.</p>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="cs_height_20 cs_height_lg_20"></div>
                    <p class="m-0 cs_payment_text">Your personal data will be used to process your order, support your experience throughout this website, and for other purposes described in our <a href="#">privacy policy</a>.</p>
                    <div class="cs_height_20 cs_height_lg_20"></div>
                    <button type="submit" form="orderForm" class="cs_btn cs_style_1 cs_fs_16 cs_medium w-100">Pay Now</button>
                </div>
                <div class="cs_height_30 cs_height_lg_30"></div>
            </div>
        </div>
    </div>
</div>
<!-- End Checkout -->
<div class="cs_height_90 cs_height_lg_50"></div>
<hr>

<!-- SweetAlert2 CDN -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    console.log('Checkout script loaded');

    let otpTimerInterval = null;
    let otpSecondsLeft = 60;
    let emailVerified = false;

    // Helper: Validate email format
    function isValidEmail(email) {
        return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email);
    }

    // Enable/disable submit buttons
    function setSubmitEnabled(state) {
        document.querySelectorAll('button[type="submit"]').forEach(btn => {
            btn.disabled = !state;
        });
    }

    // Load cart from EcommerceCartManager or localStorage
    function loadCart() {
        try {
            if (window.ecommerceCartManager && typeof window.ecommerceCartManager.getCart === 'function') {
                const cart = window.ecommerceCartManager.getCart();
                console.log('Cart loaded from EcommerceCartManager:', cart);
                return cart || [];
            }
            const cart = localStorage.getItem('ts-cart');
            const parsedCart = cart ? JSON.parse(cart) : [];
            console.log('Cart loaded from localStorage:', parsedCart);
            return parsedCart;
        } catch (e) {
            console.error('Error loading cart:', e);
            return [];
        }
    }

    // Save cart to localStorage and EcommerceCartManager
    function saveCart(cart) {
        try {
            localStorage.setItem('ts-cart', JSON.stringify(cart));
            if (window.ecommerceCartManager && typeof window.ecommerceCartManager.setCart === 'function') {
                window.ecommerceCartManager.setCart(cart);
            }
            console.log('Cart saved:', cart);
        } catch (e) {
            console.error('Error saving cart:', e);
        }
    }

    // Render cart items
    function renderCart() {
        const cart = loadCart();
        const orderItems = document.getElementById('orderItems');
        const orderSubtotalEl = document.getElementById('orderSubtotal');
        const orderTotalEl = document.getElementById('orderTotal');
        const orderForm = document.getElementById('orderForm');

        console.log('Rendering cart with items:', cart);

        if (!cart || cart.length === 0) {
            orderItems.innerHTML = '<tr><td colspan="2" class="error-msg">Your cart is empty. Please add items to your cart first.</td></tr>';
            orderSubtotalEl.textContent = '$0.00';
            orderTotalEl.textContent = '$0.00';
            setSubmitEnabled(false);
            return;
        }

        orderItems.innerHTML = '';
        let total = 0;

        cart.forEach(item => {
            if (!item.id || !item.name || typeof item.price !== 'number' || typeof item.quantity !== 'number') {
                console.warn('Invalid cart item:', item);
                return;
            }
            total += item.price * item.quantity;
            const itemRow = document.createElement('tr');
            itemRow.innerHTML = `
                <td>
                    ${item.name} x ${item.quantity}
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
                </td>
                <td class="text-end">$${(item.price * item.quantity).toFixed(2)}</td>
            `;
            orderItems.appendChild(itemRow);
        });

        orderSubtotalEl.textContent = '$' + total.toFixed(2);
        orderTotalEl.textContent = '$' + total.toFixed(2);

        // Update hidden inputs for backend submission
        document.getElementById('orderItemsInput').value = JSON.stringify(cart);
        document.getElementById('orderTotalInput').value = total.toFixed(2);

        setSubmitEnabled(emailVerified && cart.length > 0);
    }

    // Update cart item quantity
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

    // Remove cart item
    function removeCartItem(productId) {
        let cart = loadCart();
        cart = cart.filter(item => item.id != productId);
        saveCart(cart);
        renderCart();
    }

    // Handle cart item controls
    document.getElementById('orderItems').addEventListener('click', function(e) {
        if (e.target.closest('button')) {
            const button = e.target.closest('button');
            const action = button.getAttribute('data-action');
            const productId = button.getAttribute('data-id');
            console.log(`Button clicked: action=${action}, productId=${productId}`);

            if (action === 'increase' || action === 'decrease') {
                updateCartItem(productId, action);
            } else if (action === 'remove') {
                removeCartItem(productId);
            }
        }
    });

    // OTP timer logic
    function startOtpTimer() {
        otpSecondsLeft = 60;
        document.getElementById('otpTimer').textContent = "01:00";
        if (otpTimerInterval) clearInterval(otpTimerInterval);
        otpTimerInterval = setInterval(function() {
            otpSecondsLeft--;
            let m = String(Math.floor(otpSecondsLeft / 60)).padStart(2, '0');
            let s = String(otpSecondsLeft % 60).padStart(2, '0');
            document.getElementById('otpTimer').textContent = m + ":" + s;
            if (otpSecondsLeft <= 0) {
                clearInterval(otpTimerInterval);
                document.getElementById('otpTimer').textContent = "Expired";
                document.getElementById('emailValidationStatus').innerHTML = "<span style='color:red'>OTP expired. Click Validate again.</span>";
                document.getElementById('otpSection').style.display = 'none';
                emailVerified = false;
                setSubmitEnabled(false);
                Swal.fire({
                    icon: 'error',
                    title: 'OTP Expired',
                    text: 'The OTP has expired. Please request a new one.',
                    confirmButtonText: 'OK'
                });
            }
        }, 1000);
    }

    // Handle "Validate" button (send OTP)
    document.getElementById('validateEmailBtn').addEventListener('click', function() {
        let email = document.getElementById('email').value.trim();
        if (!isValidEmail(email)) {
            document.getElementById('emailValidationStatus').innerHTML = "<span style='color:red'>Enter a valid email.</span>";
            Swal.fire({
                icon: 'warning',
                title: 'Invalid Email',
                text: 'Please enter a valid email address.',
                confirmButtonText: 'OK'
            });
            return;
        }
        setSubmitEnabled(false);
        document.getElementById('emailValidationStatus').innerHTML = "Sending OTP...";
        fetch("{{ route('customer.send-otp') }}", {
            method: "POST",
            headers: {'Content-Type': 'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}'},
            body: JSON.stringify({email})
        })
        .then(res => res.json())
        .then(res => {
            if (res.success) {
                document.getElementById('emailValidationStatus').innerHTML = "<span style='color:green'>OTP sent to your email!</span>";
                document.getElementById('otpSection').style.display = 'flex';
                emailVerified = false;
                startOtpTimer();
                Swal.fire({
                    icon: 'success',
                    title: 'OTP Sent',
                    text: 'Check your email for the OTP code!',
                    confirmButtonText: 'OK'
                });
            } else {
                document.getElementById('emailValidationStatus').innerHTML = "<span style='color:red'>Failed to send OTP.</span>";
                Swal.fire({
                    icon: 'error',
                    title: 'Failed',
                    text: 'Could not send OTP. Try again.',
                    confirmButtonText: 'OK'
                });
            }
        })
        .catch(() => {
            document.getElementById('emailValidationStatus').innerHTML = "<span style='color:red'>Failed to send OTP.</span>";
            Swal.fire({
                icon: 'error',
                title: 'Failed',
                text: 'Could not send OTP. Try again.',
                confirmButtonText: 'OK'
            });
        })
        .finally(() => setSubmitEnabled(emailVerified && loadCart().length > 0));
    });

    // Handle "Verify" OTP button
    document.getElementById('verifyOtpBtn').addEventListener('click', function() {
        let email = document.getElementById('email').value.trim();
        let otp = document.getElementById('otpInput').value.trim();
        if (otp.length !== 4) {
            document.getElementById('emailValidationStatus').innerHTML = "<span style='color:red'>OTP must be 4 digits.</span>";
            Swal.fire({
                icon: 'warning',
                title: 'Invalid OTP',
                text: 'OTP must be exactly 4 digits.',
                confirmButtonText: 'OK'
            });
            return;
        }
        setSubmitEnabled(false);
        fetch("{{ route('customer.verify-otp') }}", {
            method: "POST",
            headers: {'Content-Type': 'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}'},
            body: JSON.stringify({email, otp})
        })
        .then(res => res.json())
        .then(res => {
            if (res.success) {
                emailVerified = true;
                document.getElementById('emailValidationStatus').innerHTML = "<span style='color:green'>Email verified!</span>";
                clearInterval(otpTimerInterval);
                document.getElementById('otpSection').style.display = 'none';
                Swal.fire({
                    icon: 'success',
                    title: 'Email Verified!',
                    text: 'Your email is now verified.',
                    confirmButtonText: 'OK'
                });
            } else {
                document.getElementById('emailValidationStatus').innerHTML = "<span style='color:red'>" + (res.msg || "Incorrect OTP.") + "</span>";
                Swal.fire({
                    icon: 'error',
                    title: 'Verification Failed',
                    text: res.msg || 'Incorrect OTP.',
                    confirmButtonText: 'OK'
                });
            }
        })
        .catch(() => {
            document.getElementById('emailValidationStatus').innerHTML = "<span style='color:red'>Failed to verify OTP.</span>";
            Swal.fire({
                icon: 'error',
                title: 'Verification Failed',
                text: 'Could not verify OTP. Try again.',
                confirmButtonText: 'OK'
            });
        })
        .finally(() => setSubmitEnabled(emailVerified && loadCart().length > 0));
    });

    // Client-side form validation
    document.getElementById('orderForm').addEventListener('submit', function(e) {
        const cart = loadCart();
        if (!cart || cart.length === 0) {
            e.preventDefault();
            Swal.fire({
                icon: 'warning',
                title: 'Empty Cart',
                text: 'Your cart is empty. Please add items to your cart first.',
                confirmButtonText: 'OK'
            });
            return;
        }

        let requiredFields = this.querySelectorAll('[required]');
        for (let field of requiredFields) {
            if (!field.value.trim()) {
                e.preventDefault();
                field.focus();
                Swal.fire({
                    icon: 'warning',
                    title: 'Missing Field',
                    text: 'Please fill out all required fields.',
                    confirmButtonText: 'OK'
                });
                return;
            }
        }

        let email = document.getElementById('email').value.trim();
        if (!isValidEmail(email)) {
            e.preventDefault();
            document.getElementById('email').focus();
            Swal.fire({
                icon: 'warning',
                title: 'Invalid Email',
                text: 'Enter a valid email address.',
                confirmButtonText: 'OK'
            });
            return;
        }

        if (!emailVerified) {
            e.preventDefault();
            document.getElementById('email').focus();
            Swal.fire({
                icon: 'warning',
                title: 'Email Not Verified',
                text: 'Please validate your email first!',
                confirmButtonText: 'OK'
            });
            return;
        }

        let phone = document.getElementById('phone').value.trim();
        if (!phone) {
            e.preventDefault();
            document.getElementById('phone').focus();
            Swal.fire({
                icon: 'warning',
                title: 'Missing Phone',
                text: 'Enter your phone number.',
                confirmButtonText: 'OK'
            });
            return;
        }
    });

    // Initialize cart
    renderCart();
});
</script>
@endsection