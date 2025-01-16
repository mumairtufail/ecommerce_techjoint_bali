<div class="modal fade" id="quickViewModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog ts-modal-dialog">
        <div class="modal-content ts-modal-content">
            <!-- Modal Header -->
            <div class="modal-header ts-modal-header">
                <h5 class="modal-title ts-modal-title">Quick View</h5>
                <button type="button" class="btn-close ts-modal-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            
            <!-- Modal Body -->
            <div class="modal-body ts-modal-body">
                <div class="row g-4">
                    <!-- Product Image -->
                    <div class="col-md-6">
                        <div class="ts-modal-image-wrapper">
                            <img src="" alt="Product" class="ts-modal-product-img">
                        </div>
                    </div>
                    
                    <!-- Product Details -->
                    <div class="col-md-6">
                        <h2 class="ts-modal-product-title"></h2>
                        <span class="ts-modal-price"></span>
                        <p class="ts-modal-description"></p>
                        
                        <!-- Quantity Control -->
                        <div class="ts-quantity-control">
                            <button class="ts-quantity-btn" data-action="decrease">
                                <i class="fas fa-minus"></i>
                            </button>
                            <span class="ts-quantity-display">1</span>
                            <button class="ts-quantity-btn" data-action="increase">
                                <i class="fas fa-plus"></i>
                            </button>
                        </div>
                        
                        <!-- Add to Cart Button -->
                        <button class="ts-modal-add-to-cart" data-id="" data-name="" data-price="" data-image="">
                            <i class="fas fa-shopping-cart"></i>
                            Add to Cart
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>