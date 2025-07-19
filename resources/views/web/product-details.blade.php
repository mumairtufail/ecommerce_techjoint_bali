@extends('web.layout.app')

@section('content')
<div class="cs_height_140 cs_height_lg_80"></div>

<!-- Start single product -->
<section>
    <div class="cs_height_35 cs_height_lg_35"></div>
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="cs_single_product_breadcrumb breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('web.view.index') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('web.view.shop') }}">Shop</a></li>
                <li class="breadcrumb-item">
                    <a href="{{ route('web.view.shop') }}?category={{ $product->category_id }}">{{ $product->category->name }}</a>
                </li>
                <li class="breadcrumb-item active">{{ $product->name }}</li>
            </ol>
        </nav>

        <div class="row">
            <div class="col-xl-7">
                <div class="row">
                    <div class="col-3">
                        <div class="cs_single_product_nav slick-slider">
                            @forelse($product->images as $image)
                                <div class="cs_single_product_thumb_mini">
                                    <img src="{{ asset('storage/' . $image->image_path) }}"
                                         alt="{{ $image->alt_text ?: $product->name }}"
                                         class="img-fluid rounded border"
                                         style="width: 100px; height: 100px; object-fit: cover;">
                                </div>
                            @empty
                                <div class="cs_single_product_thumb_mini">
                                    <img src="{{ asset('storage/' . $product->image) }}"
                                         alt="{{ $product->name }}"
                                         class="img-fluid rounded border"
                                         style="width: 100px; height: 100px; object-fit: cover;">
                                </div>
                            @endforelse
                        </div>
                    </div>
                    <div class="col-9">
                        <div class="cs_single_product_thumb slick-slider">
                            @forelse($product->images as $image)
                                <div class="cs_single_product_thumb_item">
                                    <img src="{{ $image->image_path && file_exists(public_path('storage/' . $image->image_path)) 
                                        ? asset('storage/' . $image->image_path) 
                                        : asset('images/default.png') }}"
                                         alt="{{ $image->alt_text ?: $product->name }}"
                                         class="img-fluid rounded border"
                                         style="width: 100%; height: 400px; object-fit: contain;">
                                </div>
                            @empty
                                <div class="cs_single_product_thumb_item">
                                    <img src="{{ asset('storage/' . $product->image) }}"
                                         alt="{{ $product->name }}"
                                         class="img-fluid rounded border"
                                         style="width: 100%; height: 400px; object-fit: contain;">
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-5">
                <div class="cs_single_product_details">
                    <h2 class="cs_fs_37 cs_semibold">{{ $product->name }}</h2>
                    <div class="cs_single_product_review">
                        <div class="cs_rating_container">
                            <div class="cs_rating cs_size_sm" data-rating="{{ $product->rating ?? 5 }}">
                                <div class="cs_rating_percentage"></div>
                            </div>
                        </div>
                        <span>({{ $product->reviews_count ?? 5 }})</span>
                        <span>Stock: <span class="cs_accent_color stock-info">{{ $product->stock }} in stock</span></span>
                    </div>
                    <h4 class="cs_single_product_price cs_fs_21 cs_primary_color cs_semibold">Price: ${{ number_format($product->price, 2) }}</h4>
                    <div class="cs_stock_info cs_fs_14 cs_medium mt-2"></div>
                    <hr>
                    <div class="cs_single_product_details_text">
                        <p class="mb-0">{{ $product->description ?: 'No description available for this product.' }}</p>
                    </div>

                    @if($product->sizes->count() > 0)
                        <div class="cs_single_product_size">
                            <h4 class="cs_fs_16 cs_medium">Size</h4>
                            <ul class="cs_size_filter_list cs_mp0">
                                @foreach($product->sizes as $size)
                                    <li>
                                        <input type="radio" name="size" id="size_{{ $size->id }}" value="{{ $size->id }}" data-size-name="{{ $size->name }}">
                                        <label for="size_{{ $size->id }}">
                                            <span>{{ $size->name }}</span>
                                        </label>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    @if($product->colors->count() > 0)
                        <div class="cs_single_product_color">
                            <h4 class="cs_fs_16 cs_medium">Color</h4>
                            <ul class="cs_color_filter_list cs_type_1 cs_mp0">
                                @foreach($product->colors as $color)
                                    <li>
                                        <div class="cs_color_filter">
                                            <input type="radio" name="color" id="color_{{ $color->id }}" value="{{ $color->id }}" data-color-name="{{ $color->name }}">
                                            <label for="color_{{ $color->id }}">
                                                <span class="cs_color_filter_circle" style="background-color: {{ $color->hex_code ?: '#000000' }};"></span>
                                                <span class="cs_color_text">{{ $color->name }}</span>
                                            </label>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="cs_action_btns">
                        <div class="cs_quantity">
                            <button class="cs_quantity_btn cs_decrement"><i class="fa-solid fa-angle-down"></i></button>
                            <span class="cs_quantity_input">1</span>
                            <button class="cs_quantity_btn cs_increment"><i class="fa-solid fa-angle-up"></i></button>
                        </div>
                        <button 
                            type="button"
                            class="cs_btn cs_style_1 cs_fs_16 cs_medium ecommerce-add-to-cart-btn"
                            data-product-id="{{ $product->id }}"
                            data-product-name="{{ $product->name }}"
                            data-product-price="{{ $product->price }}"
                            data-product-image="{{ asset('storage/' . ($product->images->firstWhere('is_primary', 1)->image_path ?? $product->image)) }}"
                            data-product-quantity="1"
                            data-variant-id=""
                        >
                            Add to Cart
                        </button>
                        <button class="cs_heart_btn"><i class="fa-regular fa-heart"></i></button>
                    </div>
                    <ul class="cs_single_product_info">
                        <li class="cs_fs_16 cs_normal">
                            <b class="cs_medium">SKU: </b>{{ $product->id }}
                        </li>
                        <li class="cs_fs_16 cs_normal">
                            <b class="cs_medium">Categories: </b>{{ $product->category->name }}
                        </li>
                        <li class="cs_fs_16 cs_normal">
                            <b class="cs_medium">Tags: </b>{{ $product->category->name }}, Fashion, Clothing
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="cs_height_70 cs_height_lg_60"></div>
        <hr>
        <div class="cs_product_meta_info">
            <ul class="cs_tab_links cs_style_2 cs_product_tab cs_fs_21 cs_primary_color cs_semibold cs_mp0">
                <li><a href="#tab_1">Description</a></li>
                <li><a href="#tab_2">Additional information</a></li>
                <li><a href="#tab_3">Size Guide</a></li>
                <li class="active"><a href="#tab_4">Review (1)</a></li>
            </ul>
            <div class="cs_tabs">
                <div class="cs_tab" id="tab_1">
                    {{ $product->description ?: 'No detailed description available for this product.' }}
                </div>
                <div class="cs_tab" id="tab_2">
                    <table class="m-0">
                        <tbody>
                            <tr>
                                <td>Color</td>
                                <td>{{ $product->colors->pluck('name')->implode(', ') ?: 'N/A' }}</td>
                            </tr>
                            <tr>
                                <td>Size</td>
                                <td>{{ $product->sizes->pluck('name')->implode(', ') ?: 'N/A' }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="cs_tab" id="tab_3">
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum sagittis orci ac odio dictum
                    tincidunt. Donec ut metus leo. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos
                    himenaeos. Sed luctus, dui eu sagittis sodales, nulla nibh sagittis augue, vel porttitor diam enim non
                    metus. Vestibulum aliquam augue neque. Phasellus tincidunt odio eget ullamcorper efficitur. Cras placerat ut
                    turpis pellentesque vulputate. Nam sed consequat tortor. Curabitur finibus sapien dolor. Ut eleifend tellus nec
                    erat pulvinar dignissim. Nam non arcu purus. Vivamus et massa massa.
                </div>
                <div class="cs_tab active" id="tab_4">
                    <ul class="cs_client_review_list cs_mp0">
                        <li>
                            <div class="cs_client_review">
                                <div class="cs_review_media">
                                    <div class="cs_review_media_thumb"><img src="assets/img/avatar.png" alt="Avatar"></div>
                                    <div class="cs_review_media_right">
                                        <div class="cs_rating_container">
                                            <div class="cs_rating cs_size_sm" data-rating="5">
                                                <div class="cs_rating_percentage"></div>
                                            </div>
                                        </div>
                                        <p class="mb-0 cs_primary_color cs_semibold">Zhon Abony</p>
                                    </div>
                                    <p class="cs_review_posted_by">August 12, 2023</p>
                                </div>
                                <p class="cs_review_text">I recently purchased the Arino T-shirts and I'm thoroughly impressed. The
                                    sound quality is exceptional, the wireless connectivity is seamless, and the noise cancellation
                                    technology is a standout feature. They're a bit pricey, but well worth the investment. Highly
                                    recommend.</p>
                            </div>
                        </li>
                    </ul>
                    <p class="m-0">Your email address will not be published. Required fields are marked *</p>
                    <div class="cs_height_20 cs_height_lg_20"></div>
                    <div class="cs_input_rating_wrap">
                        <p>Your rating  *</p>
                        <div class="cs_input_rating cs_accent_color" data-rating="0">
                            <i class="fa-regular fa-star"></i>
                            <i class="fa-regular fa-star"></i>
                            <i class="fa-regular fa-star"></i>
                            <i class="fa-regular fa-star"></i>
                            <i class="fa-regular fa-star"></i>
                        </div>
                    </div>
                    <div class="cs_height_20 cs_height_lg_22"></div>
                    <form class="row cs_review_form cs_gap_y_24">
                        <div class="col-lg-12">
                            <textarea rows="3" class="cs_form_field" placeholder="Write your review *"></textarea>
                        </div>
                        <div class="col-lg-6">
                            <input type="text" class="cs_form_field" placeholder="Your name *">
                        </div>
                        <div class="col-lg-6">
                            <input type="text" class="cs_form_field" placeholder="Your email *">
                        </div>
                        <div class="col-lg-12">
                            <div class="form_check">
                                <input class="form-check-input" type="checkbox">
                                <label class="form-check-label m-0">
                                    By using this form you agree with the storage and handling of your data by this website. *
                                </label>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <button class="cs_btn cs_style_1 cs_fs_16 cs_medium" type="submit">Submit Now</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End single product -->

<!-- Start related products -->
<section class="cs_slider container-fluid position-relative">
    <div class="cs_height_120 cs_height_lg_70"></div>
    <div class="container">
        <div class="cs_section_heading cs_style_1">
            <div class="cs_section_heading_in">
                <h2 class="cs_section_title cs_fs_50 cs_bold cs_fs_48 cs_semibold mb-0">Related Products</h2>
            </div>
            <div class="cs_slider_arrows cs_style_2">
                <div class="cs_left_arrow cs_slider_arrow cs_accent_color">
                    <i class="fa-solid fa-chevron-left"></i>
                </div>
                <div class="cs_right_arrow cs_slider_arrow cs_accent_color">
                    <i class="fa-solid fa-chevron-right"></i>
                </div>
            </div>
        </div>
        <div class="cs_height_63 cs_height_lg_35"></div>
    </div>
    <div class="cs_slider_container" data-autoplay="0" data-loop="1" data-speed="600" data-center="0"
         data-slides-per-view="responsive" data-xs-slides="1" data-sm-slides="2" data-md-slides="2" data-lg-slides="3"
         data-add-slides="4">
        <div class="cs_slider_wrapper">
            @foreach($relatedProducts as $relatedProduct)
                <div class="slick_slide_in">
                    <div class="cs_product cs_style_1">
                        <div class="cs_product_thumb position-relative">
                            <img src="{{ asset('storage/' . $relatedProduct->image) }}" alt="{{ $relatedProduct->name }}" class="w-100">
                            @if($relatedProduct->flag)
                                <div class="cs_discount_badge cs_white_bg cs_fs_14 cs_primary_color position-absolute">{{ $relatedProduct->flag }}</div>
                            @endif
                            <div class="cs_cart_badge position-absolute">
                                <a href="#" class="cs_cart_icon cs_accent_bg cs_white_color">
                                    <i class="fa-regular fa-heart"></i>
                                </a>
                                <a href="{{ route('web.product.details', $relatedProduct->id) }}" class="cs_cart_icon cs_accent_bg cs_white_color">
                                    <i class="fa-regular fa-eye"></i>
                                </a>
                            </div>
                            <a href="#" class="cs_cart_btn cs_accent_bg cs_fs_16 cs_white_color cs_medium position-absolute ecommerce-add-to-cart-btn"
                               data-product-id="{{ $relatedProduct->id }}"
                               data-product-name="{{ $relatedProduct->name }}"
                               data-product-price="{{ $relatedProduct->price }}"
                               data-product-image="{{ asset('storage/' . $relatedProduct->image) }}"
                               data-product-quantity="1">
                                Add to Cart
                            </a>
                        </div>
                        <div class="cs_product_info text-center">
                            <h3 class="cs_product_title cs_fs_21 cs_medium">
                                <a href="{{ route('web.product.details', $relatedProduct->id) }}">{{ $relatedProduct->name }}</a>
                            </h3>
                            <p class="cs_product_price cs_fs_18 cs_accent_color mb-0 cs_medium">${{ number_format($relatedProduct->price, 2) }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <div class="cs_height_134 cs_height_lg_80"></div>
</section>
<!-- End related products -->

<script>
document.addEventListener('DOMContentLoaded', function() {
    console.log('Product details script loaded');
    
    // Product variants data
    const productVariants = @json($variantsArray || []);
    const basePrice = {{ $product->price }};
    const baseStock = {{ $product->stock }};
    const priceElement = document.querySelector('.cs_single_product_price');
    const stockInfoElement = document.querySelector('.cs_stock_info');
    const addToCartBtn = document.querySelector('.ecommerce-add-to-cart-btn');
    const quantityInput = document.querySelector('.cs_quantity_input');
    const incrementBtn = document.querySelector('.cs_increment');
    const decrementBtn = document.querySelector('.cs_decrement');

    let selectedSize = null;
    let selectedColor = null;
    let currentVariant = null;
    let maxQuantity = baseStock;

    // Debugging: Check if elements are found
    if (!addToCartBtn) {
        console.error('Add to Cart button not found in DOM');
    } else {
        console.log('Add to Cart button found:', addToCartBtn);
    }
    if (!incrementBtn || !decrementBtn || !quantityInput) {
        console.error('Quantity controls not found:', { incrementBtn, decrementBtn, quantityInput });
    }

    // Initialize quantity
    quantityInput.textContent = '1';
    addToCartBtn.dataset.productQuantity = '1';

    // Handle size selection
    document.querySelectorAll('input[name="size"]').forEach(input => {
        input.addEventListener('change', function() {
            if (this.checked) {
                selectedSize = parseInt(this.value);
                updateVariant();
            }
        });
    });

    // Handle color selection
    document.querySelectorAll('input[name="color"]').forEach(input => {
        input.addEventListener('change', function() {
            if (this.checked) {
                selectedColor = parseInt(this.value);
                updateVariant();
            }
        });
    });

    function updateVariant() {
        // Reset quantity to 1
        quantityInput.textContent = '1';
        addToCartBtn.dataset.productQuantity = '1';

        // Find matching variant
        currentVariant = productVariants.find(variant => {
            const sizeMatch = !selectedSize || variant.size_id === selectedSize;
            const colorMatch = !selectedColor || variant.color_id === selectedColor;
            return sizeMatch && colorMatch;
        });

        if (currentVariant) {
            // Update price
            const finalPrice = parseFloat(currentVariant.final_price);
            priceElement.innerHTML = `Price: $${finalPrice.toFixed(2)}`;

            // Update stock info
            maxQuantity = currentVariant.stock;
            if (maxQuantity > 0) {
                stockInfoElement.innerHTML = `<span style="color: #48BB78;"><i class="fa-solid fa-check-circle"></i> ${maxQuantity} in stock</span>`;
                addToCartBtn.style.opacity = '1';
                addToCartBtn.style.pointerEvents = 'auto';
                addToCartBtn.textContent = 'Add to Cart';
                addToCartBtn.dataset.productPrice = finalPrice;
                addToCartBtn.dataset.variantId = currentVariant.id;
            } else {
                stockInfoElement.innerHTML = `<span style="color: #F56565;"><i class="fa-solid fa-times-circle"></i> Out of stock</span>`;
                addToCartBtn.style.opacity = '0.5';
                addToCartBtn.style.pointerEvents = 'none';
                addToCartBtn.textContent = 'Add to Cart';
                addToCartBtn.dataset.productPrice = finalPrice;
                addToCartBtn.dataset.variantId = currentVariant.id;
            }
        } else {
            // Use base product details
            priceElement.innerHTML = `Price: $${basePrice.toFixed(2)}`;
            maxQuantity = baseStock;
            if (maxQuantity > 0) {
                stockInfoElement.innerHTML = `<span style="color: #48BB78;"><i class="fa-solid fa-check-circle"></i> ${maxQuantity} in stock</span>`;
                addToCartBtn.style.opacity = '1';
                addToCartBtn.style.pointerEvents = 'auto';
                addToCartBtn.textContent = 'Add to Cart';
                addToCartBtn.dataset.productPrice = basePrice;
                addToCartBtn.dataset.variantId = '';
            } else {
                stockInfoElement.innerHTML = `<span style="color: #F56565;"><i class="fa-solid fa-times-circle"></i> Out of stock</span>`;
                addToCartBtn.style.opacity = '0.5';
                addToCartBtn.style.pointerEvents = 'none';
                addToCartBtn.textContent = 'Add to Cart';
                addToCartBtn.dataset.productPrice = basePrice;
                addToCartBtn.dataset.variantId = '';
            }
        }
    }

    // Quantity controls
    if (incrementBtn && decrementBtn && quantityInput) {
        incrementBtn.addEventListener('click', function() {
            let currentQty = parseInt(quantityInput.textContent) || 1;
            if (currentQty < maxQuantity) {
                currentQty += 1;
                quantityInput.textContent = currentQty;
                addToCartBtn.dataset.productQuantity = currentQty;
            }
        });

        decrementBtn.addEventListener('click', function() {
            let currentQty = parseInt(quantityInput.textContent) || 1;
            if (currentQty > 1) {
                currentQty -= 1;
                quantityInput.textContent = currentQty;
                addToCartBtn.dataset.productQuantity = currentQty;
            }
        });
    }

    // Add to cart handler
    if (addToCartBtn) {
        addToCartBtn.addEventListener('click', function(e) {
            e.preventDefault();
            if (addToCartBtn.style.pointerEvents === 'none') {
                window.ecommerceCartManager.showToast('Product is out of stock', 'error');
                return;
            }

            const quantity = parseInt(addToCartBtn.dataset.productQuantity) || 1;
            const productData = {
                id: currentVariant ? `${addToCartBtn.dataset.productId}-${currentVariant.id}` : addToCartBtn.dataset.productId,
                name: addToCartBtn.dataset.productName + 
                      (selectedSize ? ` (${document.querySelector(`input[name="size"][value="${selectedSize}"]`)?.dataset.sizeName || ''}` : '') +
                      (selectedColor ? ` ${document.querySelector(`input[name="color"][value="${selectedColor}"]`)?.dataset.colorName || ''})` : ''),
                price: parseFloat(addToCartBtn.dataset.productPrice),
                image: addToCartBtn.dataset.productImage,
                quantity: quantity
            };

            console.log('Adding to cart:', productData);

            if (window.ecommerceCartManager && typeof window.ecommerceCartManager.addItem === 'function') {
                window.ecommerceCartManager.addItem(productData);
                window.ecommerceCartManager.updateFloatingButton();
                quantityInput.textContent = '1';
                addToCartBtn.dataset.productQuantity = '1';
            } else {
                console.error('ecommerceCartManager not initialized');
                window.ecommerceCartManager.showToast('Cart functionality not available', 'error');
            }
        });
    }

    // Ensure button visibility
    if (addToCartBtn) {
        addToCartBtn.style.display = 'inline-block';
        addToCartBtn.style.visibility = 'visible';
    }

    // Initialize
    updateVariant();
});
</script>

<style>
.cs_size_filter_list li label {
    cursor: pointer;
    display: block;
    width: 100%;
    height: 100%;
    padding: 8px 12px;
    border: 1px solid #ddd;
    border-radius: 4px;
    text-align: center;
    transition: all 0.3s ease;
}

.cs_size_filter_list li input[type="radio"]:checked + label span {
    background-color: var(--cs-primary-color, #FC5F49);
    color: white;
    border-radius: 4px;
}

.cs_color_filter label {
    cursor: pointer;
    display: flex;
    align-items: center;
    gap: 8px;
}

.cs_size_filter_list li input[type="radio"],
.cs_color_filter input[type="radio"] {
    display: none;
}

.cs_color_filter input[type="radio"]:checked + label .cs_color_filter_circle {
    border: 3px solid var(--cs-primary-color, #FC5F49);
    box-shadow: 0 0 0 2px white, 0 0 0 4px var(--cs-primary-color, #FC5F49);
}

.cs_stock_info {
    margin-top: 8px;
    padding: 8px 0;
}

.cs_action_btns {
    display: flex;
    align-items: center;
    gap: 15px;
    margin-top: 20px;
}

.cs_quantity {
    display: flex;
    align-items: center;
    gap: 10px;
    border: 1px solid #ddd;
    border-radius: 4px;
    width: fit-content;
    padding: 5px;
}

.cs_quantity_btn {
    background: none;
    border: none;
    padding: 5px 10px;
    cursor: pointer;
    color: var(--cs-primary-color, #FC5F49);
    font-size: 16px;
}

.cs_quantity_input {
    min-width: 30px;
    text-align: center;
    font-size: 16px;
    font-weight: 500;
    line-height: 1.5;
}

.cs_btn.cs_style_1.ecommerce-add-to-cart-btn {
    display: inline-block !important;
    visibility: visible !important;
    opacity: 1 !important;
    background-color: var(--cs-primary-color, #FC5F49);
    color: white;
    padding: 10px 20px;
    border-radius: 4px;
    border: none;
    cursor: pointer;
    transition: opacity 0.3s ease, background-color 0.3s ease;
}

.cs_btn.cs_style_1.ecommerce-add-to-cart-btn:hover {
    background-color: #e04e38;
}

.cs_btn.cs_style_1.ecommerce-add-to-cart-btn[disabled] {
    opacity: 0.5;
    cursor: not-allowed;
    pointer-events: none;
}
</style>
@endsection
