/**
 * E-commerce Cart - Dedicated Cart Functionality JavaScript
 * Version: 1.0
 * Date: 2025
 * 
 * This script provides complete cart functionality with localStorage persistence
 * and can be used independently across different pages.
 */

class EcommerceCartManager {
    constructor() {
        this.cartKey = 'ecommerce-cart';
        this.cart = this.loadCart();
        this.init();
    }

    init() {
        this.createCartStructure();
        this.bindEvents();
        this.updateCartDisplay();
        this.updateFloatingButton();
    }

    // Create cart DOM structure if it doesn't exist
    createCartStructure() {
        // Create backdrop if it doesn't exist
        if (!document.querySelector('.ecommerce-cart-backdrop')) {
            const backdrop = document.createElement('div');
            backdrop.className = 'ecommerce-cart-backdrop';
            backdrop.id = 'ecommerceCartBackdrop';
            document.body.appendChild(backdrop);
        }

        // Create floating cart button if it doesn't exist
        if (!document.querySelector('.ecommerce-floating-cart-btn')) {
            const floatingBtn = document.createElement('button');
            floatingBtn.className = 'ecommerce-floating-cart-btn';
            floatingBtn.id = 'ecommerceFloatingCartBtn';
            floatingBtn.innerHTML = `
                <i class="fas fa-shopping-cart"></i>
                <span class="ecommerce-cart-count">0</span>
            `;
            document.body.appendChild(floatingBtn);
        }
    }

    // Load cart from localStorage
    loadCart() {
        try {
            const savedCart = localStorage.getItem(this.cartKey);
            return savedCart ? JSON.parse(savedCart) : [];
        } catch (error) {
            console.error('Error loading cart:', error);
            return [];
        }
    }

    // Save cart to localStorage
    saveCart() {
        try {
            localStorage.setItem(this.cartKey, JSON.stringify(this.cart));
        } catch (error) {
            console.error('Error saving cart:', error);
        }
    }

    // Add item to cart
    addItem(product) {
        try {
            const existingItem = this.cart.find(item => item.id === product.id);
            
            if (existingItem) {
                existingItem.quantity += product.quantity || 1;
            } else {
                this.cart.push({
                    id: product.id,
                    name: product.name,
                    price: parseFloat(product.price),
                    image: product.image || '',
                    quantity: product.quantity || 1
                });
            }
            
            this.saveCart();
            this.updateCartDisplay();
            this.updateFloatingButton();
            this.showToast(`${product.name} added to cart!`, 'success');
            
            return true;
        } catch (error) {
            console.error('Error adding item to cart:', error);
            this.showToast('Failed to add item to cart', 'error');
            return false;
        }
    }

    // Remove item from cart
    removeItem(productId) {
        try {
            const itemIndex = this.cart.findIndex(item => item.id === productId);
            if (itemIndex > -1) {
                const removedItem = this.cart[itemIndex];
                this.cart.splice(itemIndex, 1);
                this.saveCart();
                this.updateCartDisplay();
                this.updateFloatingButton();
                this.showToast(`${removedItem.name} removed from cart`, 'warning');
                return true;
            }
            return false;
        } catch (error) {
            console.error('Error removing item from cart:', error);
            return false;
        }
    }

    // Update item quantity
    updateQuantity(productId, quantity) {
        try {
            const item = this.cart.find(item => item.id === productId);
            if (item) {
                if (quantity <= 0) {
                    this.removeItem(productId);
                } else {
                    item.quantity = parseInt(quantity);
                    this.saveCart();
                    this.updateCartDisplay();
                    this.updateFloatingButton();
                }
                return true;
            }
            return false;
        } catch (error) {
            console.error('Error updating quantity:', error);
            return false;
        }
    }

    // Clear entire cart
    clearCart() {
        try {
            this.cart = [];
            this.saveCart();
            this.updateCartDisplay();
            this.updateFloatingButton();
            this.showToast('Cart cleared', 'warning');
            return true;
        } catch (error) {
            console.error('Error clearing cart:', error);
            return false;
        }
    }

    // Get cart total
    getTotal() {
        return this.cart.reduce((total, item) => total + (item.price * item.quantity), 0);
    }

    // Get cart item count
    getItemCount() {
        return this.cart.reduce((count, item) => count + item.quantity, 0);
    }

    // Update cart display in sidebar
    updateCartDisplay() {
        const cartItems = document.querySelector('.ecommerce-cart-items');
        const cartTotal = document.querySelector('.ecommerce-cart-total-amount');
        
        if (!cartItems) return;

        if (this.cart.length === 0) {
            cartItems.innerHTML = `
                <div class="ecommerce-cart-empty">
                    <i class="fas fa-shopping-cart"></i>
                    <h4>Your cart is empty</h4>
                    <p>Add some products to get started</p>
                </div>
            `;
        } else {
            cartItems.innerHTML = this.cart.map(item => `
                <div class="ecommerce-cart-item ecommerce-fade-in" data-product-id="${item.id}">
                    <img src="${item.image || '/assets/images/default-product.jpg'}" 
                         alt="${item.name}" 
                         class="ecommerce-cart-item-image"
                         onerror="this.src='/assets/images/default-product.jpg'">
                    <div class="ecommerce-cart-item-details">
                        <div class="ecommerce-cart-item-title">${item.name}</div>
                        <div class="ecommerce-cart-item-price">$${item.price.toFixed(2)}</div>
                        <div class="ecommerce-quantity-control">
                            <button class="ecommerce-quantity-btn ecommerce-decrease-qty" data-product-id="${item.id}">
                                <i class="fas fa-minus"></i>
                            </button>
                            <span class="ecommerce-quantity-display">${item.quantity}</span>
                            <button class="ecommerce-quantity-btn ecommerce-increase-qty" data-product-id="${item.id}">
                                <i class="fas fa-plus"></i>
                            </button>
                        </div>
                    </div>
                    <button class="ecommerce-cart-item-remove" data-product-id="${item.id}">
                        <i class="fas fa-trash"></i>
                    </button>
                </div>
            `).join('');
        }

        // Update total
        if (cartTotal) {
            cartTotal.textContent = `$${this.getTotal().toFixed(2)}`;
        }

        // Re-bind quantity control events
        this.bindQuantityControls();
    }

    // Update floating cart button
    updateFloatingButton() {
        const countElement = document.querySelector('.ecommerce-cart-count');
        if (countElement) {
            const count = this.getItemCount();
            countElement.textContent = count;
            countElement.style.display = count > 0 ? 'flex' : 'none';
        }
    }

    // Bind all event listeners
    bindEvents() {
        // Floating cart button
        document.addEventListener('click', (e) => {
            if (e.target.closest('.ecommerce-floating-cart-btn')) {
                this.openCart();
            }
        });

        // Cart sidebar close
        document.addEventListener('click', (e) => {
            if (e.target.closest('.ecommerce-cart-close')) {
                this.closeCart();
            }
        });

        // Backdrop click
        document.addEventListener('click', (e) => {
            if (e.target.classList.contains('ecommerce-cart-backdrop')) {
                this.closeCart();
            }
        });

        // Add to cart buttons
        document.addEventListener('click', (e) => {
            if (e.target.closest('.ecommerce-add-to-cart-btn')) {
                e.preventDefault();
                const button = e.target.closest('.ecommerce-add-to-cart-btn');
                this.handleAddToCart(button);
            }
        });

        // Checkout button
        document.addEventListener('click', (e) => {
            if (e.target.closest('.ecommerce-checkout-btn')) {
                this.handleCheckout();
            }
        });

        // Clear cart button
        document.addEventListener('click', (e) => {
            if (e.target.closest('.ecommerce-clear-cart-btn')) {
                this.handleClearCart();
            }
        });

        // ESC key to close cart
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape') {
                this.closeCart();
            }
        });
    }

    // Bind quantity control events
    bindQuantityControls() {
        // Decrease quantity
        document.querySelectorAll('.ecommerce-decrease-qty').forEach(btn => {
            btn.addEventListener('click', (e) => {
                const productId = e.target.closest('.ecommerce-decrease-qty').dataset.productId;
                const item = this.cart.find(item => item.id === productId);
                if (item) {
                    this.updateQuantity(productId, item.quantity - 1);
                }
            });
        });

        // Increase quantity
        document.querySelectorAll('.ecommerce-increase-qty').forEach(btn => {
            btn.addEventListener('click', (e) => {
                const productId = e.target.closest('.ecommerce-increase-qty').dataset.productId;
                const item = this.cart.find(item => item.id === productId);
                if (item) {
                    this.updateQuantity(productId, item.quantity + 1);
                }
            });
        });

        // Remove item
        document.querySelectorAll('.ecommerce-cart-item-remove').forEach(btn => {
            btn.addEventListener('click', (e) => {
                const productId = e.target.closest('.ecommerce-cart-item-remove').dataset.productId;
                this.removeItem(productId);
            });
        });
    }

    // Handle add to cart button click
    handleAddToCart(button) {
        try {
            // Get product data from button attributes or closest product element
            const productData = {
                id: button.dataset.productId || button.getAttribute('data-product-id'),
                name: button.dataset.productName || button.getAttribute('data-product-name'),
                price: button.dataset.productPrice || button.getAttribute('data-product-price'),
                image: button.dataset.productImage || button.getAttribute('data-product-image'),
                quantity: 1
            };

            // Validate required data
            if (!productData.id || !productData.name || !productData.price) {
                throw new Error('Missing required product data');
            }

            // Add loading state
            button.classList.add('ecommerce-loading');
            button.disabled = true;

            // Simulate network delay for better UX
            setTimeout(() => {
                this.addItem(productData);
                button.classList.remove('ecommerce-loading');
                button.disabled = false;
            }, 300);

        } catch (error) {
            console.error('Error handling add to cart:', error);
            this.showToast('Failed to add item to cart', 'error');
            button.classList.remove('ecommerce-loading');
            button.disabled = false;
        }
    }

    // Handle checkout
    handleCheckout() {
        if (this.cart.length === 0) {
            this.showToast('Your cart is empty', 'warning');
            return;
        }

        // Redirect to checkout page
        window.location.href = '/orders-web';
    }

    // Handle clear cart
    handleClearCart() {
        if (this.cart.length === 0) {
            this.showToast('Cart is already empty', 'warning');
            return;
        }

        if (confirm('Are you sure you want to clear your cart?')) {
            this.clearCart();
        }
    }

    // Open cart sidebar
    openCart() {
        const sidebar = document.querySelector('.ecommerce-cart-sidebar');
        const backdrop = document.querySelector('.ecommerce-cart-backdrop');
        
        if (sidebar) {
            sidebar.classList.add('active');
            document.body.style.overflow = 'hidden';
        }
        
        if (backdrop) {
            backdrop.classList.add('active');
        }
    }

    // Close cart sidebar
    closeCart() {
        const sidebar = document.querySelector('.ecommerce-cart-sidebar');
        const backdrop = document.querySelector('.ecommerce-cart-backdrop');
        
        if (sidebar) {
            sidebar.classList.remove('active');
            document.body.style.overflow = '';
        }
        
        if (backdrop) {
            backdrop.classList.remove('active');
        }
    }

    // Show toast notification
    showToast(message, type = 'success') {
        // Remove existing toasts
        document.querySelectorAll('.ecommerce-toast').forEach(toast => toast.remove());

        const toast = document.createElement('div');
        toast.className = `ecommerce-toast ${type}`;
        toast.textContent = message;
        
        document.body.appendChild(toast);
        
        // Show toast
        setTimeout(() => toast.classList.add('show'), 100);
        
        // Hide toast after 3 seconds
        setTimeout(() => {
            toast.classList.remove('show');
            setTimeout(() => toast.remove(), 300);
        }, 3000);
    }

    // Get cart data (for external access)
    getCart() {
        return [...this.cart];
    }

    // Set cart data (for external manipulation)
    setCart(cartData) {
        try {
            this.cart = Array.isArray(cartData) ? cartData : [];
            this.saveCart();
            this.updateCartDisplay();
            this.updateFloatingButton();
            return true;
        } catch (error) {
            console.error('Error setting cart data:', error);
            return false;
        }
    }

    // Export cart data
    exportCart() {
        return {
            items: this.getCart(),
            total: this.getTotal(),
            count: this.getItemCount(),
            timestamp: new Date().toISOString()
        };
    }
}

// Initialize cart manager when DOM is loaded
document.addEventListener('DOMContentLoaded', function() {
    // Create global cart manager instance
    if (!window.ecommerceCartManager) {
        window.ecommerceCartManager = new EcommerceCartManager();
        
        // For backward compatibility
        window.shopManager = window.ecommerceCartManager;
    }
});

// Export for module usage
if (typeof module !== 'undefined' && module.exports) {
    module.exports = EcommerceCartManager;
}
