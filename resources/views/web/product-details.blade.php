@extends('web.layout.app')

@section('content')

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

        .cs_size_filter_list li input[type="radio"]:checked+label span {
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

        /* Compact Color Filter Styling */
        .cs_color_filter_compact {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
            margin: 8px 0;
        }

        /* Compact Size Filter Styling */
        .cs_size_filter_compact {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
            margin: 8px 0;
        }

        .cs_size_option {
            position: relative;
        }

        .cs_size_option input[type="radio"] {
            display: none;
        }

        .cs_size_option label {
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 8px 12px;
            border: 2px solid #e0e0e0;
            border-radius: 6px;
            background: #ffffff;
            cursor: pointer;
            transition: all 0.2s ease;
            font-size: 13px;
            font-weight: 500;
            color: #555;
            min-width: 40px;
            text-align: center;
        }

        .cs_size_option label:hover {
            border-color: #FC5F49;
            box-shadow: 0 2px 6px rgba(252, 95, 73, 0.2);
            transform: translateY(-1px);
        }

        .cs_size_option input[type="radio"]:checked + label {
            border-color: #FC5F49;
            background: #FC5F49;
            color: white;
            box-shadow: 0 0 0 1px #FC5F49, 0 2px 8px rgba(252, 95, 73, 0.25);
        }

        .cs_size_name {
            font-size: 13px;
            font-weight: 500;
        }

        .cs_color_option {
            position: relative;
        }

        .cs_color_option input[type="radio"] {
            display: none;
        }

        .cs_color_option label {
            display: flex;
            align-items: center;
            gap: 6px;
            padding: 6px 10px;
            border: 2px solid #e0e0e0;
            border-radius: 20px;
            background: #ffffff;
            cursor: pointer;
            transition: all 0.2s ease;
            font-size: 13px;
            font-weight: 500;
            color: #555;
            white-space: nowrap;
        }

        .cs_color_option label:hover {
            border-color: #FC5F49;
            box-shadow: 0 2px 6px rgba(252, 95, 73, 0.2);
            transform: translateY(-1px);
        }

        .cs_color_circle {
            width: 18px;
            height: 18px;
            border-radius: 50%;
            border: 2px solid #fff;
            box-shadow: 0 0 0 1px #ddd;
            display: block;
            flex-shrink: 0;
        }

        .cs_color_name {
            font-size: 12px;
            font-weight: 500;
            color: #555;
        }

        .cs_color_option input[type="radio"]:checked+label {
            border-color: #FC5F49;
            background: #fff8f7;
            box-shadow: 0 0 0 1px #FC5F49, 0 2px 8px rgba(252, 95, 73, 0.25);
        }

        .cs_color_option input[type="radio"]:checked+label .cs_color_circle {
            box-shadow: 0 0 0 2px #FC5F49;
            transform: scale(1.1);
        }

        .cs_color_option input[type="radio"]:checked+label .cs_color_name {
            color: #FC5F49;
            font-weight: 600;
        }

        /* Legacy color filter styles - keeping for backward compatibility but hiding */
        .cs_color_filter_list {
            display: none;
        }

        .cs_color_filter label {
            cursor: pointer;
            display: flex;
            align-items: center;
            padding: 8px 12px;
            border: 1px solid #e0e0e0;
            border-radius: 8px;
            transition: all 0.3s ease;
            background: #f9f9f9;
        }

        .cs_color_filter label:hover {
            border-color: var(--cs-primary-color, #FC5F49);
            background: #fff;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        .cs_color_filter .cs_color_text {
            font-size: 14px;
            color: #333;
            font-weight: 500;
        }

        /* Size filter styling */
        .cs_size_filter_list {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .cs_size_filter_list li {
            margin: 0;
        }

        .cs_size_filter_list li label {
            cursor: pointer;
            display: block;
            width: 100%;
            height: 100%;
            padding: 12px 16px;
            border: 2px solid #ddd;
            border-radius: 8px;
            text-align: center;
            transition: all 0.3s ease;
            background: #f9f9f9;
            font-weight: 500;
            min-width: 50px;
        }

        .cs_size_filter_list li label:hover {
            border-color: var(--cs-primary-color, #FC5F49);
            background: #fff;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        .cs_size_filter_list li input[type="radio"]:checked+label {
            background-color: var(--cs-primary-color, #FC5F49);
            border-color: var(--cs-primary-color, #FC5F49);
            color: white;
            box-shadow: 0 4px 12px rgba(252, 95, 73, 0.3);
        }

        .cs_single_product_color,
        .cs_single_product_size {
            margin-bottom: 25px;
            padding: 20px;
            background: #f8f9fa;
            border-radius: 10px;
            border-left: 4px solid var(--cs-primary-color, #FC5F49);
        }

        .cs_single_product_color h4,
        .cs_single_product_size h4 {
            margin-bottom: 15px;
            color: #333;
            font-size: 16px;
        }

        .color-selection-message,
        .size-selection-message {
            font-style: italic;
            color: #666 !important;
            padding: 10px;
            background: #e8f4fd;
            border-radius: 6px;
            border-left: 3px solid #2196f3;
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

        /* Rich Text Description Styling */
        .product-description-content {
            line-height: 1.6;
            color: #4a5568;
        }

        .product-description-content h1,
        .product-description-content h2,
        .product-description-content h3,
        .product-description-content h4,
        .product-description-content h5,
        .product-description-content h6 {
            margin-top: 1.5em;
            margin-bottom: 0.5em;
            font-weight: 600;
            color: #2d3748;
        }

        .product-description-content h1 {
            font-size: 2em;
        }

        .product-description-content h2 {
            font-size: 1.5em;
        }

        .product-description-content h3 {
            font-size: 1.25em;
        }

        .product-description-content p {
            margin-bottom: 1em;
        }

        .product-description-content ul,
        .product-description-content ol {
            margin: 1em 0;
            padding-left: 2em;
        }

        .product-description-content li {
            margin-bottom: 0.5em;
        }

        .product-description-content strong,
        .product-description-content b {
            font-weight: 600;
            color: #2d3748;
        }

        .product-description-content em,
        .product-description-content i {
            font-style: italic;
        }

        .product-description-content u {
            text-decoration: underline;
        }

        .product-description-content s {
            text-decoration: line-through;
        }

        .product-description-content blockquote {
            border-left: 4px solid #FC5F49;
            padding-left: 1em;
            margin: 1em 0;
            font-style: italic;
            background: #f7fafc;
            padding: 1em;
            border-radius: 4px;
        }

        .product-description-content a {
            color: #FC5F49;
            text-decoration: underline;
        }

        .product-description-content a:hover {
            color: #e04e38;
        }

        .product-description-content code {
            background: #f1f5f9;
            padding: 2px 4px;
            border-radius: 3px;
            font-family: 'Courier New', monospace;
            font-size: 0.9em;
        }

        .product-description-content pre {
            background: #f1f5f9;
            padding: 1em;
            border-radius: 4px;
            overflow-x: auto;
            font-family: 'Courier New', monospace;
        }
    </style>
    
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
                        <a
                            href="{{ route('web.view.shop') }}?category={{ $product->category_id }}">{{ $product->category->name }}</a>
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
                                            alt="{{ $image->alt_text ?: $product->name }}" class="img-fluid rounded border"
                                            style="width: 100px; height: 100px; object-fit: cover;">
                                    </div>
                                @empty
                                    <div class="cs_single_product_thumb_mini">
                                        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}"
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
                                            alt="{{ $image->alt_text ?: $product->name }}" class="img-fluid rounded border"
                                            style="width: 100%; height: 400px; object-fit: contain;">
                                    </div>
                                @empty
                                    <div class="cs_single_product_thumb_item">
                                        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}"
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
                            <span>Stock: <span class="cs_accent_color stock-info">{{ $product->stock }} in
                                    stock</span></span>
                        </div>
                        <h4 class="cs_single_product_price cs_fs_21 cs_primary_color cs_semibold">Price:
                            ${{ number_format($product->price, 2) }}</h4>
                        <div class="cs_stock_info cs_fs_14 cs_medium mt-2"></div>
                        <hr>



                        <!--<div class="cs_single_product_details_text">-->
                        <!--    <div class="mb-0">{!! $product->description ?: '<p>No description available for this product.</p>' !!}</div>-->
                        <!--</div>-->

                        @if ($product->getAvailableColors()->count() > 0)
                            <div class="cs_single_product_color">
                                <h4 class="cs_fs_16 cs_medium" style="margin-bottom: 12px;">Choose Color <span
                                        class="text-danger">*</span></h4>
                                <div class="cs_color_filter_compact">
                                    @foreach ($product->getAvailableColors() as $color)
                                        <div class="cs_color_option">
                                            <input type="radio" name="color" id="color_{{ $color->id }}"
                                                value="{{ $color->id }}" data-color-name="{{ $color->name }}">
                                            <label for="color_{{ $color->id }}" title="Select {{ $color->name }}">
                                                <span class="cs_color_circle"
                                                    style="background-color: {{ $color->hex_code ?: '#000000' }};"></span>
                                                <span class="cs_color_name">{{ $color->name }}</span>
                                            </label>
                                        </div>
                                    @endforeach
                                </div>
                                <div class="color-selection-message" style="margin-top: 8px; font-size: 13px; color: #666;">
                                    Please select a color to see pricing and stock information.
                                </div>
                            </div>
                        @else
                            <!-- No colors available -->
                            <div
                                style="background: #fff3cd; padding: 10px; border: 1px solid #ffeaa7; border-radius: 5px; margin: 10px 0;">
                                <small>No color options available for this product</small>
                            </div>
                        @endif

                        {{-- Size Selection - Commented out for now
                        @if($product->getAvailableSizes()->count() > 0)
                            <div class="cs_single_product_size">
                                <h4 class="cs_fs_16 cs_medium" style="margin-bottom: 12px;">Choose Size <span class="text-danger">*</span></h4>
                                <div class="cs_size_filter_compact">
                                    @foreach($product->getAvailableSizes() as $size)
                                        <div class="cs_size_option">
                                            <input type="radio" name="size" id="size_{{ $size->id }}" value="{{ $size->id }}" data-size-name="{{ $size->name }}">
                                            <label for="size_{{ $size->id }}" title="Select {{ $size->name }}">
                                                <span class="cs_size_name">{{ $size->name }}</span>
                                            </label>
                                        </div>
                                    @endforeach
                                </div>
                                <div class="size-selection-message" style="margin-top: 8px; font-size: 13px; color: #666;">
                                    Please select a size to see pricing and stock information.
                                </div>
                            </div>
                        @endif
                        --}}

                        <div class="cs_action_btns">
                            <div class="cs_quantity">
                                <button class="cs_quantity_btn cs_decrement"><i class="fa-solid fa-angle-down"></i></button>
                                <span class="cs_quantity_input">1</span>
                                <button class="cs_quantity_btn cs_increment"><i class="fa-solid fa-angle-up"></i></button>
                            </div>
                            <button type="button" class="cs_btn cs_style_1 cs_fs_16 cs_medium ecommerce-add-to-cart-btn"
                                data-product-id="{{ $product->id }}" data-product-name="{{ $product->name }}"
                                data-product-price="{{ $product->price }}"
                                data-product-image="{{ asset('storage/' . ($product->images->firstWhere('is_primary', 1)->image_path ?? $product->image)) }}"
                                data-product-quantity="1" data-variant-id="">
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
                                <b class="cs_medium">Tags: </b>{{ $product->category->name }}
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="cs_height_70 cs_height_lg_60"></div>
            <hr>
            <div class="cs_product_meta_info">
                <ul class="cs_tab_links cs_style_2 cs_product_tab cs_fs_21 cs_primary_color cs_semibold cs_mp0">
                    <li class="active"><a href="#tab_1">Description</a></li>
                    <li><a href="#tab_2">Additional information</a></li>
                    <li><a href="#tab_3">Size Guide</a></li>
                    <li><a href="#tab_4">Review (1)</a></li>
                </ul>
                <div class="cs_tabs">
                    <div class="cs_tab active" id="tab_1">
                        <div class="product-description-content">
                            {!! $product->description ?: '<p>No detailed description available for this product.</p>' !!}
                        </div>
                    </div>
                    <div class="cs_tab" id="tab_2">
                        <table class="m-0">
                            <tbody>
                                <tr>
                                    <td>Color</td>
                                    <td>{{ $product->getAvailableColors()->pluck('name')->implode(', ') ?: 'N/A' }}</td>
                                </tr>
                                {{-- Size info disabled
                                <tr>
                                    <td>Size</td>
                                    <td>{{ $product->getAvailableSizes()->pluck('name')->implode(', ') ?: 'N/A' }}</td>
                                </tr>
                                --}}
                            </tbody>
                        </table>
                    </div>
                    <div class="cs_tab" id="tab_3">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum sagittis orci ac odio dictum
                        tincidunt. Donec ut metus leo. Class aptent taciti sociosqu ad litora torquent per conubia nostra,
                        per inceptos
                        himenaeos. Sed luctus, dui eu sagittis sodales, nulla nibh sagittis augue, vel porttitor diam enim
                        non
                        metus. Vestibulum aliquam augue neque. Phasellus tincidunt odio eget ullamcorper efficitur. Cras
                        placerat ut
                        turpis pellentesque vulputate. Nam sed consequat tortor. Curabitur finibus sapien dolor. Ut eleifend
                        tellus nec
                        erat pulvinar dignissim. Nam non arcu purus. Vivamus et massa massa.
                    </div>
                    <div class="cs_tab" id="tab_4">
                        <ul class="cs_client_review_list cs_mp0">
                            <li>
                                <div class="cs_client_review">
                                    <div class="cs_review_media">
                                        <div class="cs_review_media_thumb"><img src="assets/img/avatar.png"
                                                alt="Avatar"></div>
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
                                    <p class="cs_review_text">I recently purchased the Arino T-shirts and I'm thoroughly
                                        impressed. The
                                        sound quality is exceptional, the wireless connectivity is seamless, and the noise
                                        cancellation
                                        technology is a standout feature. They're a bit pricey, but well worth the
                                        investment. Highly
                                        recommend.</p>
                                </div>
                            </li>
                        </ul>
                        <p class="m-0">Your email address will not be published. Required fields are marked *</p>
                        <div class="cs_height_20 cs_height_lg_20"></div>
                        <div class="cs_input_rating_wrap">
                            <p>Your rating *</p>
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
                                        By using this form you agree with the storage and handling of your data by this
                                        website. *
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
            data-slides-per-view="responsive" data-xs-slides="1" data-sm-slides="2" data-md-slides="2"
            data-lg-slides="3" data-add-slides="4">
            <div class="cs_slider_wrapper">
                @foreach ($relatedProducts as $relatedProduct)
                    <div class="slick_slide_in">
                        <div class="cs_product cs_style_1">
                            <div class="cs_product_thumb position-relative">
                                <img src="{{ asset('storage/' . $relatedProduct->image) }}"
                                    alt="{{ $relatedProduct->name }}" class="w-100">
                                @if ($relatedProduct->flag)
                                    <div class="cs_discount_badge cs_white_bg cs_fs_14 cs_primary_color position-absolute">
                                        {{ $relatedProduct->flag }}</div>
                                @endif
                                <div class="cs_cart_badge position-absolute">
                                    <a href="#" class="cs_cart_icon cs_accent_bg cs_white_color">
                                        <i class="fa-regular fa-heart"></i>
                                    </a>
                                    <a href="{{ route('web.product.details', $relatedProduct->id) }}"
                                        class="cs_cart_icon cs_accent_bg cs_white_color">
                                        <i class="fa-regular fa-eye"></i>
                                    </a>
                                </div>
                                <a href="#"
                                    class="cs_cart_btn cs_accent_bg cs_fs_16 cs_white_color cs_medium position-absolute ecommerce-add-to-cart-btn"
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
                                    <a
                                        href="{{ route('web.product.details', $relatedProduct->id) }}">{{ $relatedProduct->name }}</a>
                                </h3>
                                <p class="cs_product_price cs_fs_18 cs_accent_color mb-0 cs_medium">
                                    ${{ number_format($relatedProduct->price, 2) }}</p>
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
            // Product variants data - Use pre-prepared data from controller
            const productVariants = @json($variantsArray ?? []);

            const basePrice = {{ $product->price }};
            const baseStock = {{ $product->stock }};

            const priceElement = document.querySelector('.cs_single_product_price');
            const stockInfoElement = document.querySelector('.cs_stock_info');
            const addToCartBtn = document.querySelector('.ecommerce-add-to-cart-btn');
            const quantityInput = document.querySelector('.cs_quantity_input');
            const incrementBtn = document.querySelector('.cs_increment');
            const decrementBtn = document.querySelector('.cs_decrement');

            let selectedColor = null;
            // let selectedSize = null; // Commented out - size selection disabled
            let currentVariant = null;
            let maxQuantity = baseStock;

            // Initialize quantity
            quantityInput.textContent = '1';
            addToCartBtn.dataset.productQuantity = '1';

            // Handle color selection
            document.querySelectorAll('input[name="color"]').forEach(input => {
                input.addEventListener('change', function() {
                    if (this.checked) {
                        selectedColor = parseInt(this.value);
                        updateVariant();
                    }
                });
            });

            // Also handle clicking on labels for better UX
            document.querySelectorAll('.cs_color_option label').forEach(label => {
                label.addEventListener('click', function() {
                    const input = this.parentElement.querySelector('input[type="radio"]');
                    if (input && !input.checked) {
                        input.checked = true;
                        selectedColor = parseInt(input.value);
                        updateVariant();
                    }
                });
            });

            // Handle size selection - COMMENTED OUT
            /*
            document.querySelectorAll('input[name="size"]').forEach(input => {
                input.addEventListener('change', function() {
                    if (this.checked) {
                        selectedSize = parseInt(this.value);
                        updateVariant();
                    }
                });
            });

            // Also handle clicking on size labels for better UX
            document.querySelectorAll('.cs_size_option label').forEach(label => {
                label.addEventListener('click', function() {
                    const input = this.parentElement.querySelector('input[type="radio"]');
                    if (input && !input.checked) {
                        input.checked = true;
                        selectedSize = parseInt(input.value);
                        updateVariant();
                    }
                });
            });
            */

            function updateVariant() {
                // Reset quantity to 1
                quantityInput.textContent = '1';
                addToCartBtn.dataset.productQuantity = '1';

                // Hide color selection message if color is selected
                const colorMessage = document.querySelector('.color-selection-message');
                if (selectedColor && colorMessage) {
                    colorMessage.style.display = 'none';
                } else if (colorMessage) {
                    colorMessage.style.display = 'block';
                }

                // Hide size selection message if size is selected - COMMENTED OUT
                /*
                const sizeMessage = document.querySelector('.size-selection-message');
                if (selectedSize && sizeMessage) {
                    sizeMessage.style.display = 'none';
                } else if (sizeMessage) {
                    sizeMessage.style.display = 'block';
                }
                */

                // Find matching variant - simplified to handle only color variants
                currentVariant = null;
                const hasColors = @json($product->getAvailableColors()->count() > 0);
                // const hasSizes = @json($product->getAvailableSizes()->count() > 0); // Commented out

                console.log('updateVariant called:', {
                    selectedColor,
                    // selectedSize, // Commented out
                    hasColors,
                    // hasSizes, // Commented out
                    variantsCount: productVariants ? productVariants.length : 0
                });

                if (productVariants && productVariants.length > 0) {
                    // Find matching variant by color_id only (size matching disabled)
                    currentVariant = productVariants.find(variant => {
                        let colorMatch = !hasColors || !selectedColor || parseInt(variant.color_id) === parseInt(selectedColor);
                        // let sizeMatch = !hasSizes || !selectedSize || parseInt(variant.size_id) === parseInt(selectedSize); // Commented out
                        return colorMatch; // && sizeMatch; // Size matching disabled
                    });

                    console.log('Exact match variant:', currentVariant);

                    // Fallback matching logic simplified (no size requirements)
                    if (!currentVariant && hasColors && selectedColor) {
                        // Try matching just by color
                        currentVariant = productVariants.find(variant => {
                            return parseInt(variant.color_id) === parseInt(selectedColor);
                        });
                        
                        console.log('Fallback color matching:', { currentVariant });
                    }
                }

                console.log('Final selected variant:', currentVariant);

                if (currentVariant) {
                    // Update price with variant pricing
                    const finalPrice = parseFloat(currentVariant.final_price || currentVariant.price);
                    
                    // Build variant info display (color only)
                    let variantInfo = '';
                    if (currentVariant.color_name) {
                        variantInfo += currentVariant.color_name;
                    }
                    // Size info disabled: if (currentVariant.size_name) { variantInfo += (variantInfo ? ', ' : '') + currentVariant.size_name; }
                    
                    priceElement.innerHTML =
                        `Price: <span style="color: #FC5F49; font-weight: 600;">$${finalPrice.toFixed(2)}</span> ${variantInfo ? `<small class="text-success" style="font-weight: 500;">(${variantInfo})</small>` : ''}`;

                    // Update stock info
                    maxQuantity = parseInt(currentVariant.stock) || 0;
                    if (maxQuantity > 0) {
                        stockInfoElement.innerHTML =
                            `<span style="color: #48BB78;"><i class="fa-solid fa-check-circle"></i> ${maxQuantity} in stock</span>`;
                        addToCartBtn.style.opacity = '1';
                        addToCartBtn.style.pointerEvents = 'auto';
                        addToCartBtn.textContent = 'Add to Cart';
                        addToCartBtn.disabled = false;
                        addToCartBtn.dataset.productPrice = finalPrice;
                        addToCartBtn.dataset.variantId = currentVariant.id || '';
                        addToCartBtn.dataset.variantColorId = currentVariant.color_id || '';
                        addToCartBtn.dataset.variantColorName = currentVariant.color_name || '';
                        // Size data disabled:
                        // addToCartBtn.dataset.variantSizeId = currentVariant.size_id || '';
                        // addToCartBtn.dataset.variantSizeName = currentVariant.size_name || '';
                    } else {
                        stockInfoElement.innerHTML =
                            `<span style="color: #F56565;"><i class="fa-solid fa-times-circle"></i> Out of stock</span>`;
                        addToCartBtn.style.opacity = '0.5';
                        addToCartBtn.style.pointerEvents = 'none';
                        addToCartBtn.textContent = 'Out of Stock';
                        addToCartBtn.disabled = true;
                        addToCartBtn.dataset.productPrice = finalPrice;
                        addToCartBtn.dataset.variantId = currentVariant.id || '';
                        addToCartBtn.dataset.variantColorId = currentVariant.color_id || '';
                        addToCartBtn.dataset.variantColorName = currentVariant.color_name || '';
                        // Size data disabled:
                        // addToCartBtn.dataset.variantSizeId = currentVariant.size_id || '';
                        // addToCartBtn.dataset.variantSizeName = currentVariant.size_name || '';
                    }
                } else {
                    // Use base product details when no variant is selected or found
                    priceElement.innerHTML =
                        `Price: <span style="color: #FC5F49; font-weight: 600;">$${basePrice.toFixed(2)}</span> <small style="color: #999;">(Select options for variant pricing)</small>`;
                    maxQuantity = baseStock;

                    // Check if we have colors available (size checking disabled)
                    const hasColors = @json($product->getAvailableColors()->count() > 0);
                    // const hasSizes = @json($product->getAvailableSizes()->count() > 0); // Commented out

                    // Determine what selections are needed (only color)
                    const needsColor = hasColors && !selectedColor;
                    // const needsSize = hasSizes && !selectedSize; // Commented out
                    
                    if (needsColor) {
                        let message = 'Please select a color';
                        
                        stockInfoElement.innerHTML =
                            `<span style="color: #FFA500;"><i class="fa-solid fa-exclamation-circle"></i> ${message}</span>`;
                        addToCartBtn.style.opacity = '0.6';
                        addToCartBtn.style.pointerEvents = 'none';
                        addToCartBtn.textContent = 'Select Color First';
                        addToCartBtn.disabled = true;
                    } else if (hasColors && selectedColor) {
                        // Options selected but no variant found - this might be an issue
                        stockInfoElement.innerHTML =
                            `<span style="color: #FFA500;"><i class="fa-solid fa-exclamation-triangle"></i> Variant not found for selected options</span>`;
                        addToCartBtn.style.opacity = '0.6';
                        addToCartBtn.style.pointerEvents = 'none';
                        addToCartBtn.textContent = 'Variant Not Available';
                        addToCartBtn.disabled = true;
                    } else if (maxQuantity > 0) {
                        // No options required or no options available - use base product
                        stockInfoElement.innerHTML =
                            `<span style="color: #48BB78;"><i class="fa-solid fa-check-circle"></i> ${maxQuantity} in stock</span>`;
                        addToCartBtn.style.opacity = '1';
                        addToCartBtn.style.pointerEvents = 'auto';
                        addToCartBtn.textContent = 'Add to Cart';
                        addToCartBtn.disabled = false;
                    } else {
                        // Base product out of stock
                        stockInfoElement.innerHTML =
                            `<span style="color: #F56565;"><i class="fa-solid fa-times-circle"></i> Out of stock</span>`;
                        addToCartBtn.style.opacity = '0.5';
                        addToCartBtn.style.pointerEvents = 'none';
                        addToCartBtn.textContent = 'Out of Stock';
                        addToCartBtn.disabled = true;
                    }

                    // Reset variant data
                    addToCartBtn.dataset.productPrice = basePrice;
                    addToCartBtn.dataset.variantId = '';
                    addToCartBtn.dataset.variantColorId = '';
                    addToCartBtn.dataset.variantColorName = '';
                    // Size data disabled:
                    // addToCartBtn.dataset.variantSizeId = '';
                    // addToCartBtn.dataset.variantSizeName = '';
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
                        
                        // Update cart if item already exists
                        updateCartQuantityIfExists(currentQty);
                    }
                });

                decrementBtn.addEventListener('click', function() {
                    let currentQty = parseInt(quantityInput.textContent) || 1;
                    if (currentQty > 1) {
                        currentQty -= 1;
                        quantityInput.textContent = currentQty;
                        addToCartBtn.dataset.productQuantity = currentQty;
                        
                        // Update cart if item already exists
                        updateCartQuantityIfExists(currentQty);
                    }
                });
            }

            // Function to update cart quantity if item already exists
            function updateCartQuantityIfExists(newQuantity) {
                if (window.ecommerceCartManager) {
                    const variantId = addToCartBtn.dataset.variantId;
                    const uniqueId = variantId ? 
                        `${addToCartBtn.dataset.productId}-variant-${variantId}` : 
                        addToCartBtn.dataset.productId;
                    
                    // Check if item exists in cart
                    const cart = window.ecommerceCartManager.getCart();
                    const existingItem = cart.find(item => item.unique_id === uniqueId);
                    
                    if (existingItem) {
                        window.ecommerceCartManager.updateQuantity(uniqueId, newQuantity);
                    }
                }
            }

            // Add to cart handler
            if (addToCartBtn) {
                addToCartBtn.addEventListener('click', function(e) {
                    // Prevent global handlers (in cart.js) from also processing this click
                    e.preventDefault();
                    if (e.stopImmediatePropagation) e.stopImmediatePropagation();
                    if (e.stopPropagation) e.stopPropagation();

                    if (addToCartBtn.style.pointerEvents === 'none') {
                        if (typeof Swal !== 'undefined') {
                            Swal.fire({
                                icon: 'error',
                                title: 'Out of Stock',
                                text: 'This product is currently out of stock.',
                                confirmButtonText: 'OK'
                            });
                        } else {
                            window.ecommerceCartManager.showToast('Product is out of stock', 'error');
                        }
                        return;
                    }

                    // Check if color selection is required but not selected
                    const hasColors = @json($product->getAvailableColors()->count() > 0);
                    // const hasSizes = @json($product->getAvailableSizes()->count() > 0); // Commented out

                    // Check for required selections (only color)
                    const needsColor = hasColors && !selectedColor;
                    // const needsSize = hasSizes && !selectedSize; // Commented out

                    if (needsColor) {
                        let message = 'Please select a color before adding this product to your cart.';

                        // Use SweetAlert for better UX
                        if (typeof Swal !== 'undefined') {
                            Swal.fire({
                                icon: 'warning',
                                title: 'Color Required',
                                text: message,
                                confirmButtonText: 'OK',
                                confirmButtonColor: '#FC5F49'
                            });
                        } else {
                            window.ecommerceCartManager.showToast(message, 'error');
                        }
                        return;
                    }

                    const quantity = parseInt(addToCartBtn.dataset.productQuantity) || 1;
                    const variantId = addToCartBtn.dataset.variantId && addToCartBtn.dataset.variantId !==
                        '' ? addToCartBtn.dataset.variantId : null;
                    const variantColorId = addToCartBtn.dataset.variantColorId && addToCartBtn.dataset
                        .variantColorId !== '' ? addToCartBtn.dataset.variantColorId : null;
                    const variantColorName = addToCartBtn.dataset.variantColorName && addToCartBtn.dataset
                        .variantColorName !== '' ? addToCartBtn.dataset.variantColorName : null;
                    // Size data disabled:
                    // const variantSizeId = addToCartBtn.dataset.variantSizeId && addToCartBtn.dataset.variantSizeId !== '' ? addToCartBtn.dataset.variantSizeId : null;
                    // const variantSizeName = addToCartBtn.dataset.variantSizeName && addToCartBtn.dataset.variantSizeName !== '' ? addToCartBtn.dataset.variantSizeName : null;

                    // Create product name with variant info (color only)
                    let productName = addToCartBtn.dataset.productName;
                    let variantInfo = [];
                    if (variantColorName) variantInfo.push(variantColorName);
                    // Size info disabled: if (variantSizeName) variantInfo.push(variantSizeName);
                    if (variantInfo.length > 0) {
                        productName += ` (${variantInfo.join(', ')})`;
                    }

                    const productData = {
                        id: variantId ? `${addToCartBtn.dataset.productId}-variant-${variantId}` :
                            addToCartBtn.dataset.productId,
                        name: productName,
                        price: parseFloat(addToCartBtn.dataset.productPrice),
                        image: addToCartBtn.dataset.productImage,
                        quantity: quantity,
                        variant_id: variantId,
                        variant_color_id: variantColorId,
                        variant_color_name: variantColorName,
                        // Size data disabled:
                        // variant_size_id: variantSizeId,
                        // variant_size_name: variantSizeName,
                        base_product_id: addToCartBtn.dataset.productId,
                        unique_id: variantId ? `${addToCartBtn.dataset.productId}-variant-${variantId}` : addToCartBtn.dataset.productId,
                        max_stock: maxQuantity
                    };

                    if (window.ecommerceCartManager && typeof window.ecommerceCartManager.addItem ===
                        'function') {
                        const addResult = window.ecommerceCartManager.addItem(productData);
                        if (addResult) {
                            window.ecommerceCartManager.updateFloatingButton();
                            quantityInput.textContent = '1';
                            addToCartBtn.dataset.productQuantity = '1';

                            // Show success message with variant info
                            const successMessage = variantColorName ?
                                `${productName} added to cart!` :
                                `${addToCartBtn.dataset.productName} added to cart!`;
                            
                            // Use SweetAlert for success if available
                            if (typeof Swal !== 'undefined') {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Added to Cart!',
                                    text: successMessage,
                                    showConfirmButton: false,
                                    timer: 2000,
                                    toast: true,
                                    position: 'top-end'
                                });
                            } else {
                                window.ecommerceCartManager.showToast(successMessage, 'success');
                            }
                        } else {
                            // Handle add to cart failure
                            if (typeof Swal !== 'undefined') {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Error',
                                    text: 'Failed to add item to cart. Please try again.',
                                    confirmButtonText: 'OK',
                                    confirmButtonColor: '#FC5F49'
                                });
                            } else {
                                window.ecommerceCartManager.showToast('Failed to add item to cart', 'error');
                            }
                        }
                    } else {
                        // Cart manager not available
                        if (typeof Swal !== 'undefined') {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: 'Cart functionality is not available. Please refresh the page and try again.',
                                confirmButtonText: 'OK',
                                confirmButtonColor: '#FC5F49'
                            });
                        } else {
                            alert('Cart functionality not available. Please refresh the page.');
                        }
                    }
                });
            }

            // Initialize
            updateVariant();

        }); // Close DOMContentLoaded event listener
    </script>

@endsection
