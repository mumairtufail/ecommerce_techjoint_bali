# 🛒 ecommmerce Cart System

A standalone, reusable shopping cart system that can be integrated into any website or Laravel application.

## ✨ Features

- **🎨 Independent Styling**: Uses unique class names (`ecommmerce-*`) to avoid conflicts
- **💾 Persistent Storage**: Cart data persists in localStorage between sessions
- **📱 Responsive Design**: Works on desktop, tablet, and mobile devices
- **🔄 Real-time Updates**: Instant cart count and total updates
- **🔔 Toast Notifications**: Beautiful user feedback notifications
- **⚡ Easy Integration**: Simple data attributes for quick setup
- **🌐 Framework Agnostic**: Works with any website, not just Laravel

## 📦 Files

- `public/assets/css/cart.css` - All cart styling
- `public/assets/js/cart.js` - Cart functionality and management
- `public/cart-demo.html` - Live demo and usage examples

## 🚀 Quick Start

### 1. Include the Files

```html
<!-- Include Font Awesome for icons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

<!-- ecommmerce Cart CSS -->
<link rel="stylesheet" href="/assets/css/cart.css">

<!-- ecommmerce Cart JavaScript -->
<script src="/assets/js/cart.js"></script>
```

### 2. Add Cart Sidebar HTML

```html
<div class="ecommmerce-cart-sidebar" id="ecommmerceCartSidebar">
    <div class="ecommmerce-cart-header">
        <h3>Shopping Cart</h3>
        <button class="ecommmerce-cart-close">
            <i class="fas fa-times"></i>
        </button>
    </div>
    <div class="ecommmerce-cart-items">
        <!-- Cart items will be dynamically added here -->
    </div>
    <div class="ecommmerce-cart-footer">
        <div class="ecommmerce-cart-total">
            <span>Total:</span>
            <span class="ecommmerce-cart-total-amount">$0.00</span>
        </div>
        <button class="ecommmerce-checkout-btn">
            Proceed to Checkout
        </button>
        <button class="ecommmerce-clear-cart-btn">
            <i class="fas fa-trash-alt"></i>
            Clear Cart
        </button>
    </div>
</div>
```

### 3. Add "Add to Cart" Buttons

```html
<button class="ecommmerce-add-to-cart-btn"
        data-product-id="unique-product-id"
        data-product-name="Product Name"
        data-product-price="29.99"
        data-product-image="/path/to/product/image.jpg">
    <i class="fas fa-shopping-cart"></i>
    Add to Cart
</button>
```

### 4. That's It!

The cart system will automatically:
- Create a floating cart button
- Handle all cart operations
- Show notifications
- Persist data in localStorage

## 🎯 Data Attributes

| Attribute | Description | Required |
|-----------|-------------|----------|
| `data-product-id` | Unique product identifier | ✅ Yes |
| `data-product-name` | Product display name | ✅ Yes |
| `data-product-price` | Product price (numeric) | ✅ Yes |
| `data-product-image` | Product image URL | ❌ No |

## 🔧 JavaScript API

### Access the Cart Manager

```javascript
const cart = window.ecommmerceCartManager;
```

### Core Methods

```javascript
// Add item to cart
cart.addItem({
    id: 'product123',
    name: 'Product Name',
    price: 29.99,
    image: '/path/to/image.jpg',
    quantity: 1
});

// Remove item from cart
cart.removeItem('product123');

// Update item quantity
cart.updateQuantity('product123', 5);

// Clear entire cart
cart.clearCart();

// Get cart contents
const cartItems = cart.getCart();

// Get total price
const total = cart.getTotal();

// Get item count
const count = cart.getItemCount();

// Open/close cart sidebar
cart.openCart();
cart.closeCart();

// Show notification
cart.showToast('Message', 'success'); // types: success, error, warning
```

### Export Cart Data

```javascript
const cartData = cart.exportCart();
console.log(cartData);
// {
//     items: [...],
//     total: 59.98,
//     count: 2,
//     timestamp: "2025-01-01T12:00:00.000Z"
// }
```

## 🎨 Customization

### CSS Variables

The cart uses CSS custom properties for easy theming:

```css
:root {
    --ecommmerce-primary: #FC5F49;        /* Brand color */
    --ecommmerce-primary-light: #ff7b65;  /* Hover states */
    --ecommmerce-primary-dark: #d14436;   /* Active states */
    --ecommmerce-white: #ffffff;
    --ecommmerce-black: #070707;
    --ecommmerce-gray: #666666;
    --ecommmerce-light-gray: #f5f5f5;
    --ecommmerce-border-color: #e0e0e0;
    --ecommmerce-shadow: 0 2px 15px rgba(0, 0, 0, 0.08);
    --ecommmerce-shadow-hover: 0 5px 25px rgba(0, 0, 0, 0.15);
}
```

### Override Styles

```css
/* Change primary color */
.ecommmerce-floating-cart-btn {
    background: #your-color !important;
}

/* Customize cart sidebar */
.ecommmerce-cart-sidebar {
    width: 500px; /* Make wider */
}
```

### Custom Checkout Behavior

```javascript
document.addEventListener('DOMContentLoaded', function() {
    // Override default checkout
    window.ecommmerceCartManager.handleCheckout = function() {
        const cart = this.getCart();
        if (cart.length === 0) {
            this.showToast('Your cart is empty', 'warning');
            return;
        }
        
        // Your custom checkout logic
        window.location.href = '/your-checkout-page';
    };
});
```

## 🔧 Laravel Integration

### In Blade Templates

```blade
<!-- Include in your layout -->
<link rel="stylesheet" href="{{ asset('assets/css/cart.css') }}">
<script src="{{ asset('assets/js/cart.js') }}"></script>

<!-- Cart sidebar component -->
@include('partials.cart-sidebar')

<!-- Product loop -->
@foreach($products as $product)
    <button class="ecommmerce-add-to-cart-btn"
            data-product-id="{{ $product->id }}"
            data-product-name="{{ $product->name }}"
            data-product-price="{{ $product->price }}"
            data-product-image="{{ asset('storage/' . $product->image) }}">
        Add to Cart
    </button>
@endforeach
```

### Handle Checkout in Controller

```php
// In your routes/web.php
Route::post('/checkout', [CheckoutController::class, 'process']);

// In your CheckoutController
public function process(Request $request)
{
    $cartData = $request->input('cart_data');
    // Process the cart data
    // Create order, handle payment, etc.
}
```

## 📱 Responsive Breakpoints

- **Desktop**: Full-width sidebar (400px)
- **Tablet**: Reduced sidebar width (350px)
- **Mobile**: Full-screen sidebar (100% width)

## 🛠️ Troubleshooting

### Cart Not Working?

1. **Check Console**: Look for JavaScript errors
2. **Font Awesome**: Ensure Font Awesome is loaded for icons
3. **File Paths**: Verify CSS/JS file paths are correct
4. **Data Attributes**: Ensure all required attributes are present

### Items Not Adding?

1. **Required Data**: Check all required data attributes are set
2. **Unique IDs**: Ensure product IDs are unique
3. **Price Format**: Use numeric values for prices (no currency symbols)

### Styling Issues?

1. **CSS Conflicts**: Our classes use `ecommmerce-` prefix to avoid conflicts
2. **Load Order**: Load cart.css after other stylesheets
3. **Specificity**: Use `!important` if needed to override existing styles

## 🎭 Demo

Open `public/cart-demo.html` in your browser to see a live demo with usage examples.

## 📄 License

This cart system is part of the ecommmerce project and follows the same licensing terms.

## 🤝 Contributing

To contribute improvements:

1. Modify the source files in `public/assets/css/cart.css` and `public/assets/js/cart.js`
2. Update the demo file if needed
3. Test thoroughly across different browsers and devices
4. Update this README with any new features

## 🆘 Support

For issues or questions, please check:

1. The demo file for usage examples
2. Browser developer console for errors
3. This README for troubleshooting steps

---

**Happy Shopping! 🛍️**
