@extends('web.layout.app')

@section('content')

<style>
/* Enhanced Shop Product Card Styling */
.cs_product {
  transition: all 0.3s ease;
  background: #ffffff;
  border-radius: 16px;
  box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
  overflow: hidden;
  height: 100%;
  display: flex;
  flex-direction: column;
  border: 1px solid rgba(0, 0, 0, 0.04);
}

.cs_product:hover {
  transform: translateY(-8px);
  box-shadow: 0 15px 40px rgba(0, 0, 0, 0.15);
  border-color: #FC5F49;
}

.cs_product_thumb {
  position: relative;
  overflow: hidden;
  height: 280px;
  background: #f8f9fa;
}

.cs_product_thumb img {
  width: 100%;
  height: 100%;
  object-fit: cover;
  transition: transform 0.3s ease;
}

.cs_product:hover .cs_product_thumb img {
  transform: scale(1.05);
}

.cs_discount_badge {
  top: 12px;
  left: 12px;
  padding: 6px 12px;
  border-radius: 20px;
  font-size: 11px;
  font-weight: 600;
  text-transform: uppercase;
  letter-spacing: 0.5px;
  backdrop-filter: blur(10px);
  z-index: 2;
  box-shadow: 0 2px 8px rgba(252, 95, 73, 0.3);
}

.cs_cart_badge {
  top: 12px;
  right: 12px;
  display: flex;
  flex-direction: column;
  gap: 8px;
  opacity: 0;
  transition: all 0.3s ease;
  z-index: 3;
}

.cs_product:hover .cs_cart_badge {
  opacity: 1;
}

.cs_cart_icon {
  width: 40px;
  height: 40px;
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  text-decoration: none;
  transition: all 0.3s ease;
  backdrop-filter: blur(10px);
  box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
}

.cs_cart_icon:hover {
  transform: scale(1.1);
  color: #ffffff !important;
}

.cs_cart_btn {
  position: absolute;
  bottom: 15px;
  left: 15px;
  right: 15px;
  padding: 12px 20px;
  border: none;
  border-radius: 25px;
  font-weight: 600;
  text-transform: uppercase;
  letter-spacing: 0.5px;
  font-size: 13px;
  transform: translateY(50px);
  opacity: 0;
  transition: all 0.3s ease;
  backdrop-filter: blur(10px);
  box-shadow: 0 4px 15px rgba(252, 95, 73, 0.4);
  z-index: 2;
}

.cs_product:hover .cs_cart_btn {
  transform: translateY(0);
  opacity: 1;
}

.cs_cart_btn:hover {
  transform: translateY(-2px);
  box-shadow: 0 6px 20px rgba(252, 95, 73, 0.6);
}

.cs_product_info {
  padding: 20px;
  flex-grow: 1;
  display: flex;
  flex-direction: column;
  justify-content: space-between;
}

.cs_product_title {
  margin-bottom: 8px;
  line-height: 1.4;
  height: 2.8em;
  overflow: hidden;
  display: -webkit-box;
  -webkit-line-clamp: 2;
  -webkit-box-orient: vertical;
}

.cs_product_title a {
  color: #2d3748;
  text-decoration: none;
  transition: color 0.3s ease;
}

.cs_product_title a:hover {
  color: #FC5F49;
}

.cs_single_product_review {
  margin-bottom: 12px;
  display: flex;
  align-items: center;
  gap: 8px;
  font-size: 12px;
  color: #718096;
}

.cs_rating_container {
  display: flex;
  align-items: center;
}

.cs_rating {
  width: 80px;
  height: 14px;
  background: #e2e8f0;
  border-radius: 7px;
  position: relative;
  overflow: hidden;
}

.cs_rating_percentage {
  height: 100%;
  background: linear-gradient(90deg, #ffd700, #ffed4e);
  border-radius: 7px;
  transition: width 0.3s ease;
}

.cs_product_price_wrap {
  margin-bottom: 12px;
  display: flex;
  align-items: center;
  gap: 10px;
}

.cs_product_price_old {
  font-size: 14px;
  color: #a0aec0;
  text-decoration: line-through;
}

.cs_product_price {
  font-size: 20px !important;
  font-weight: 700;
  color: #FC5F49 !important;
}

.cs_product_stock {
  font-size: 12px;
}

.cs_stock_status {
  padding: 4px 8px;
  border-radius: 12px;
  display: inline-block;
  font-weight: 600;
  text-transform: uppercase;
  letter-spacing: 0.3px;
  color: #38a169;
  background: rgba(56, 161, 105, 0.1);
}

/* Grid Layout */
.cs_product_grid {
  display: grid;
  grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
  gap: 25px;
  margin-bottom: 40px;
}

.cs_product_col {
  display: flex;
}

/* Responsive Grid */
@media (max-width: 1199px) {
  .cs_product_thumb {
    height: 240px;
  }
  
  .cs_product_grid {
    grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
    gap: 20px;
  }
}

@media (max-width: 767px) {
  .cs_product_thumb {
    height: 200px;
  }
  
  .cs_product_info {
    padding: 15px;
  }
  
  .cs_cart_btn {
    font-size: 12px;
    padding: 10px 16px;
  }
  
  .cs_product_grid {
    grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
    gap: 15px;
  }
}
</style>


<div class="cs_height_140 cs_height_lg_80"></div>
<!-- Start Page Heading -->
<section class="cs_page_heading text-center position-relative cs_bg_filed" data-src="{{ asset('web/assets/img/shop_bg.jpg') }}">
    <div class="cs_hero_overlay position-absolute"></div>
    <div class="container position-relative">
        <div class="cs_page_heading_content">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb cs_white_color justify-content-center mb-3">
                    <li class="breadcrumb-item"><a href="{{ url('/') }}" class="cs_white_color">Home</a></li>
                    @if(isset($selectedCategory))
                        <li class="breadcrumb-item"><a href="{{ route('web.view.shop') }}" class="cs_white_color">Shop</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{ $selectedCategory->name }}</li>
                    @else
                        <li class="breadcrumb-item active" aria-current="page">Shop</li>
                    @endif
                </ol>
            </nav>
            <h2 class="cs_fs_50 cs_bold cs_white_color mb-0">
                @if(isset($selectedCategory))
                    {{ $selectedCategory->name }}
                @else
                    Shop
                @endif
            </h2>
            <p class="cs_white_color mb-0 mt-3">
                @if(isset($selectedCategory))
                    {{ $selectedCategory->description ?: 'Browse products in ' . $selectedCategory->name . ' category' }}
                @else
                    Discover our premium collection of products
                @endif
            </p>
        </div>
    </div>
</section>
<!-- End Page Heading -->

<!-- Start Shop -->
<section class="cs_shop_section">
    <div class="cs_height_140 cs_height_lg_80"></div>
    <div class="container-fluid">
        <div class="row">
            <!-- Filter Sidebar -->
            <div class="col-lg-3 col-md-4">
                <div class="cs_shop_sidebar">
                    <div class="cs_filter_sidebar">
                        <div class="cs_filter_sidebar_heading cs_medium">
                            <div class="cs_filter_sidebar_heading_in">
                                <svg width="20" height="12" viewBox="0 0 20 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <g clip-path="url(#clip0_395_2711)">
                                        <path d="M14.2249 3.46555C12.5384 3.46555 10.8518 3.46555 9.16531 3.4598C8.99666 3.4598 8.93268 3.51153 8.88034 3.6667C8.49651 4.81038 7.42643 5.569 6.22259 5.56325C5.00712 5.56325 3.93123 4.78739 3.55903 3.63796C3.5125 3.49429 3.44853 3.45406 3.30314 3.4598C2.43079 3.46555 1.55845 3.46555 0.686101 3.4598C0.360425 3.4598 0.08709 3.22992 0.0231179 2.93681C-0.0466698 2.62072 0.0987213 2.29314 0.395319 2.1667C0.523263 2.11498 0.67447 2.09199 0.819861 2.09199C1.64568 2.08624 2.47732 2.08624 3.30314 2.09199C3.44853 2.09199 3.5125 2.05176 3.55903 1.90808C3.93123 0.770148 4.99549 0.0057803 6.20515 3.31758e-05C7.42062 -0.00571395 8.48488 0.735665 8.86871 1.88509C8.92687 2.0575 9.00829 2.09199 9.17694 2.09199C12.4744 2.08624 15.7777 2.08624 19.0752 2.08624C19.145 2.08624 19.2206 2.08624 19.2903 2.08624C19.7091 2.10923 19.994 2.39658 19.994 2.78739C19.9882 3.17819 19.6974 3.4598 19.2729 3.46555C18.3133 3.4713 17.3537 3.46555 16.3942 3.46555C15.6788 3.46555 14.9519 3.46555 14.2249 3.46555ZM4.80358 2.7759C4.80358 3.5575 5.43748 4.18969 6.22259 4.18969C7.00189 4.18969 7.6358 3.56325 7.64161 2.79888C7.64743 2.01727 7.01934 1.38509 6.22841 1.37934C5.43748 1.3736 4.80358 1.99429 4.80358 2.7759Z" fill="currentColor" />
                                        <path d="M16.5167 8.53426C17.4064 8.53426 18.2846 8.53426 19.1628 8.53426C19.2791 8.53426 19.3954 8.53426 19.5059 8.56299C19.8083 8.64345 20.006 8.93081 20.0002 9.2469C19.9886 9.5515 19.7792 9.81587 19.4768 9.88483C19.3779 9.90782 19.2733 9.91357 19.1744 9.91357C18.3486 9.91357 17.5169 9.91931 16.6911 9.91357C16.5515 9.91357 16.4934 9.94805 16.4469 10.086C16.063 11.2412 15.0046 11.9998 13.7833 12.0055C12.5678 12.0055 11.5094 11.2584 11.1256 10.109C11.0674 9.9423 10.986 9.91357 10.829 9.91357C7.51403 9.91931 4.19912 9.91931 0.890016 9.91357C0.773703 9.91357 0.65739 9.91357 0.541077 9.88483C0.192139 9.81012 -0.0230402 9.51127 0.00603803 9.15495C0.0293006 8.82161 0.29682 8.55725 0.645759 8.54C0.732994 8.53426 0.820228 8.53426 0.907463 8.53426C4.20493 8.53426 7.50822 8.53426 10.8057 8.54C10.9802 8.54 11.0674 8.50552 11.1314 8.32161C11.5094 7.18368 12.5911 6.43081 13.7949 6.43656C14.9988 6.4423 16.0688 7.21242 16.4469 8.35035C16.4701 8.40207 16.4934 8.46529 16.5167 8.53426ZM13.7717 10.6205C14.5568 10.6262 15.1907 10.0113 15.1965 9.24115C15.2023 8.4538 14.5859 7.82161 13.7949 7.81012C13.0098 7.79862 12.3585 8.43081 12.3527 9.20667C12.3527 9.98828 12.9807 10.6147 13.7717 10.6205Z" fill="currentColor" />
                                    </g>
                                    <defs>
                                        <clipPath id="clip0_395_2711">
                                            <rect width="20" height="12" fill="white" />
                                        </clipPath>
                                    </defs>
                                </svg>
                                <span>Filter Products</span>
                            </div>
                        </div>
                        
                        <div class="cs_filter_sidebar_in">
                            <!-- Search Filter -->
                            <div class="cs_filter_widget">
                                <h3 class="cs_filter_widget_title cs_medium cs_fs_18">Search</h3>
                                <div class="cs_search_wrap position-relative">
                                    <input type="text" id="searchInput" placeholder="Search products..." class="cs_form_field">
                                    <button type="submit" class="cs_search_btn">
                                        <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M15.7 14.3L12.6 11.2C13.6 10.1 14.2 8.6 14.2 7C14.2 3.1 11.1 0 7.2 0C3.3 0 0.2 3.1 0.2 7S3.3 14 7.2 14C8.8 14 10.3 13.4 11.4 12.4L14.5 15.5C14.6 15.6 14.8 15.7 14.9 15.7C15.1 15.7 15.2 15.6 15.3 15.5C15.5 15.1 15.5 14.6 15.7 14.3ZM1.7 7C1.7 3.9 4.1 1.5 7.2 1.5C10.3 1.5 12.7 3.9 12.7 7C12.7 10.1 10.3 12.5 7.2 12.5C4.1 12.5 1.7 10.1 1.7 7Z" fill="currentColor"/>
                                        </svg>
                                    </button>
                                </div>
                            </div>

                            
                            <!-- Price Range Filter -->
                            <div class="cs_filter_widget">
                                <h3 class="cs_filter_widget_title cs_medium cs_fs_18">Price Range</h3>
                                <div class="cs_range_slider_wrap">
                                    <div class="cs_range_value mb-3">
                                        <span id="priceRangeValue">$0 - $1000000</span>
                                    </div>
                                    <div class="cs_range_slider">
                                        <input type="range" id="priceRange" min="0" max="1000000" value="1000" step="50" class="cs_range_input">
                                    </div>
                                </div>
                            </div>

                            <!-- Categories Filter -->
                            <div class="cs_filter_widget">
                                <h3 class="cs_filter_widget_title cs_medium cs_fs_18">Categories</h3>
                                @if(isset($selectedCategory))
                                <div class="cs_selected_category_info mb-3 p-3" style="background: #f8f9fa; border-radius: 8px; border-left: 4px solid #FC5F49;">
                                    <small class="text-muted">Filtered by:</small>
                                    <div class="d-flex align-items-center justify-content-between">
                                        <span class="fw-semibold" style="color: #FC5F49;">{{ $selectedCategory->name }}</span>
                                        <a href="{{ route('web.view.shop') }}" class="btn btn-sm text-muted" title="Clear filter">
                                            <i class="fa fa-times"></i>
                                        </a>
                                    </div>
                                </div>
                                @endif
                                <ul class="cs_filter_category cs_mp0">
                                    <li>
                                        <div class="cs_custom_check">
                                            <input type="radio" name="category" value="all" id="cat_all" {{ !isset($selectedCategoryId) ? 'checked' : '' }}>
                                            <label for="cat_all">All Categories</label>
                                        </div>
                                    </li>
                                    @foreach($categories as $category)
                                    <li>
                                        <div class="cs_custom_check">
                                            <input type="radio" name="category" value="{{ $category->id }}" id="cat_{{ $category->id }}" 
                                                {{ isset($selectedCategoryId) && $selectedCategoryId == $category->id ? 'checked' : '' }}>
                                            <label for="cat_{{ $category->id }}">{{ $category->name }}</label>
                                        </div>
                                    </li>
                                    @endforeach
                                </ul>
                            </div>

                            <!-- Color Filter -->
                            {{-- <div class="cs_filter_widget">
                                <h3 class="cs_filter_widget_title cs_medium cs_fs_18">Colors</h3>
                                <ul class="cs_color_list cs_mp0">
                                    <li><span class="cs_color_box" data-color="red" style="background-color: #FF5722;"></span></li>
                                    <li><span class="cs_color_box" data-color="blue" style="background-color: #2196F3;"></span></li>
                                    <li><span class="cs_color_box" data-color="green" style="background-color: #4CAF50;"></span></li>
                                    <li><span class="cs_color_box" data-color="yellow" style="background-color: #FFC107;"></span></li>
                                    <li><span class="cs_color_box" data-color="purple" style="background-color: #9C27B0;"></span></li>
                                    <li><span class="cs_color_box" data-color="orange" style="background-color: #FC5F49;"></span></li>
                                    <li><span class="cs_color_box" data-color="black" style="background-color: #070707;"></span></li>
                                    <li><span class="cs_color_box" data-color="white" style="background-color: #FFFFFF; border: 1px solid #ddd;"></span></li>
                                </ul>
                            </div> --}}

                            <!-- Size Filter -->
                            {{-- <div class="cs_filter_widget">
                                <h3 class="cs_filter_widget_title cs_medium cs_fs_18">Size</h3>
                                <ul class="cs_size_list cs_mp0">
                                    <li><span class="cs_size_box" data-size="xs">XS</span></li>
                                    <li><span class="cs_size_box" data-size="s">S</span></li>
                                    <li><span class="cs_size_box" data-size="m">M</span></li>
                                    <li><span class="cs_size_box" data-size="l">L</span></li>
                                    <li><span class="cs_size_box" data-size="xl">XL</span></li>
                                    <li><span class="cs_size_box" data-size="xxl">XXL</span></li>
                                </ul>
                            </div> --}}

                            <!-- Brand Filter -->
                            {{-- <div class="cs_filter_widget">
                                <h3 class="cs_filter_widget_title cs_medium cs_fs_18">Brands</h3>
                                <ul class="cs_filter_list cs_mp0">
                                    <li>
                                        <div class="cs_custom_check">
                                            <input type="checkbox" id="brand_nike" value="nike">
                                            <label for="brand_nike">Nike <span>(12)</span></label>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="cs_custom_check">
                                            <input type="checkbox" id="brand_adidas" value="adidas">
                                            <label for="brand_adidas">Adidas <span>(8)</span></label>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="cs_custom_check">
                                            <input type="checkbox" id="brand_puma" value="puma">
                                            <label for="brand_puma">Puma <span>(5)</span></label>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="cs_custom_check">
                                            <input type="checkbox" id="brand_reebok" value="reebok">
                                            <label for="brand_reebok">Reebok <span>(3)</span></label>
                                        </div>
                                    </li>
                                </ul>
                            </div> --}}

                            <!-- Rating Filter -->
                            {{-- <div class="cs_filter_widget">
                                <h3 class="cs_filter_widget_title cs_medium cs_fs_18">Customer Rating</h3>
                                <ul class="cs_rating_list cs_mp0">
                                    <li>
                                        <div class="cs_custom_check">
                                            <input type="radio" name="rating" value="5" id="rating_5">
                                            <label for="rating_5">
                                                <div class="cs_rating cs_size_sm">
                                                    <i class="fa-solid fa-star"></i>
                                                    <i class="fa-solid fa-star"></i>
                                                    <i class="fa-solid fa-star"></i>
                                                    <i class="fa-solid fa-star"></i>
                                                    <i class="fa-solid fa-star"></i>
                                                </div>
                                                <span>(5.0)</span>
                                            </label>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="cs_custom_check">
                                            <input type="radio" name="rating" value="4" id="rating_4">
                                            <label for="rating_4">
                                                <div class="cs_rating cs_size_sm">
                                                    <i class="fa-solid fa-star"></i>
                                                    <i class="fa-solid fa-star"></i>
                                                    <i class="fa-solid fa-star"></i>
                                                    <i class="fa-solid fa-star"></i>
                                                    <i class="fa-regular fa-star"></i>
                                                </div>
                                                <span>(4.0 & up)</span>
                                            </label>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="cs_custom_check">
                                            <input type="radio" name="rating" value="3" id="rating_3">
                                            <label for="rating_3">
                                                <div class="cs_rating cs_size_sm">
                                                    <i class="fa-solid fa-star"></i>
                                                    <i class="fa-solid fa-star"></i>
                                                    <i class="fa-solid fa-star"></i>
                                                    <i class="fa-regular fa-star"></i>
                                                    <i class="fa-regular fa-star"></i>
                                                </div>
                                                <span>(3.0 & up)</span>
                                            </label>
                                        </div>
                                    </li>
                                </ul>
                            </div> --}}

                            <!-- Reset Button -->
                            <div class="cs_filter_widget">
                                <button type="button" onclick="resetFilters()" class="cs_btn cs_style_1 cs_color_1 cs_fs_16 cs_medium w-100">
                                    <span>Reset Filters</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!-- .col -->
            
            <!-- Main Product Area -->
            <div class="col-lg-9 col-md-8">
                <div class="cs_shop_main">
                    <!-- Shop Header -->
                    <div class="cs_shop_header">
                        <div class="cs_shop_result">
                            <p class="cs_medium mb-0">Showing <span id="productCount">{{ count($products) }}</span> of {{ count($products) }} products</p>
                        </div>
                        <div class="cs_shop_sort_wrap">
                            <div class="cs_shop_sort">
                                <select id="sortProducts" class="cs_form_field">
                                    <option value="default">Default Sorting</option>
                                    <option value="name_asc">Sort by Name (A-Z)</option>
                                    <option value="name_desc">Sort by Name (Z-A)</option>
                                    <option value="price_low">Sort by Price: Low to High</option>
                                    <option value="price_high">Sort by Price: High to Low</option>
                                    <option value="newest">Sort by Newest</option>
                                    <option value="oldest">Sort by Oldest</option>
                                </select>
                            </div>
                            <div class="cs_shop_view">
                                <!--<span class="cs_view_icon cs_grid_btn active" data-view="grid">-->
                                <!--    <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">-->
                                <!--        <path d="M0.0102539 1.14031C0.0362956 1.07235 0.0571289 1.00963 0.0779622 0.941678C0.260254 0.392837 0.755046 0.0112627 1.32796 0.00603568C2.73942 0.000808628 4.15088 -0.00441842 5.56234 0.00603568C6.2863 0.0112627 6.87484 0.607146 6.88004 1.33371C6.89046 2.74501 6.89046 4.15631 6.88004 5.56762C6.87484 6.30463 6.28109 6.89529 5.5415 6.90051C4.15088 6.90574 2.75505 6.90574 1.36442 6.90051C0.734212 6.90051 0.218587 6.48758 0.0519206 5.87079C0.0415039 5.8342 0.0258789 5.79761 0.0102539 5.76624C0.0102539 4.22427 0.0102539 2.68229 0.0102539 1.14031ZM3.44255 5.65125C4.09359 5.65125 4.74463 5.64602 5.39567 5.65648C5.56755 5.65648 5.63525 5.60943 5.63525 5.42649C5.63005 4.1145 5.63005 2.80251 5.63525 1.48529C5.63525 1.3128 5.58317 1.2553 5.4113 1.26053C4.104 1.26575 2.79671 1.26575 1.48421 1.26053C1.30192 1.26053 1.25505 1.32848 1.25505 1.50097C1.26025 2.80773 1.26025 4.1145 1.25505 5.42126C1.25505 5.59898 1.30713 5.6617 1.48942 5.65648C2.14046 5.64602 2.7915 5.65125 3.44255 5.65125Z" fill="currentColor" />-->
                                <!--        <path d="M9.02051 1.14128C9.04655 1.07333 9.06738 1.01061 9.08822 0.942654C9.27051 0.393814 9.7653 0.0122393 10.3382 0.00701224C11.7497 0.00178519 13.1611 -0.00344186 14.5726 0.00701224C15.2965 0.0122393 15.8851 0.608123 15.8903 1.33468C15.9007 2.74599 15.9007 4.15729 15.8903 5.56859C15.8851 6.30561 15.2913 6.89626 14.5518 6.90149C13.1611 6.90672 11.7653 6.90672 10.3747 6.90149C9.74447 6.90149 9.22884 6.48855 9.06217 5.87176C9.05176 5.83517 9.03613 5.79858 9.02051 5.76722C9.02051 4.22524 9.02051 2.68326 9.02051 1.14128ZM12.4528 5.65223C13.1038 5.65223 13.7549 5.647 14.4059 5.65745C14.5778 5.65745 14.6455 5.61041 14.6455 5.42746C14.6403 4.11547 14.6403 2.80348 14.6455 1.48627C14.6455 1.31377 14.5934 1.25628 14.4215 1.2615C13.1143 1.26673 11.807 1.26673 10.4945 1.2615C10.3122 1.2615 10.2653 1.32946 10.2653 1.50195C10.2705 2.80871 10.2705 4.11547 10.2653 5.42224C10.2653 5.59996 10.3174 5.66268 10.4997 5.65745C11.1507 5.647 11.8018 5.65223 12.4528 5.65223Z" fill="currentColor" />-->
                                <!--        <path d="M0.0104167 10.236C0.0364583 10.1681 0.0572917 10.1053 0.078125 10.0374C0.260417 9.48854 0.755208 9.10697 1.32292 9.10174C2.73438 9.09651 4.14583 9.09128 5.55729 9.10174C6.28125 9.10697 6.86979 9.70285 6.875 10.4294C6.88542 11.8407 6.88542 13.252 6.875 14.6633C6.86979 15.4003 6.27604 15.991 5.53646 15.9962C4.13542 16.0014 2.73958 16.0014 1.33854 15.9962C0.744792 15.991 0.234375 15.5937 0.0572917 15.024C0.0416667 14.9665 0.0208333 14.9142 0 14.8619C0.0104167 13.32 0.0104167 11.778 0.0104167 10.236ZM5.63542 12.5307C5.63542 11.8825 5.63021 11.2396 5.64062 10.5914C5.64062 10.419 5.59896 10.3458 5.41146 10.351C4.10417 10.3562 2.79688 10.3562 1.48438 10.351C1.31771 10.351 1.25521 10.4033 1.26042 10.5758C1.26562 11.8878 1.26562 13.1997 1.26042 14.517C1.26042 14.6999 1.32292 14.7522 1.5 14.747C2.80208 14.7417 4.10417 14.7417 5.40625 14.747C5.58333 14.747 5.64583 14.6947 5.64062 14.5117C5.63021 13.8531 5.63542 13.1945 5.63542 12.5307Z" fill="currentColor" />-->
                                <!--        <path d="M9.02067 10.237C9.04671 10.169 9.06755 10.1063 9.08838 10.0384C9.27067 9.48952 9.76546 9.10794 10.3332 9.10272C11.7446 9.09749 13.1561 9.09226 14.5675 9.10272C15.2915 9.10794 15.88 9.70383 15.8853 10.4304C15.8957 11.8417 15.8957 13.253 15.8853 14.6643C15.88 15.4013 15.2863 15.992 14.5467 15.9972C13.1457 16.0024 11.7498 16.0024 10.3488 15.9972C9.75505 15.992 9.24463 15.5947 9.06755 15.025C9.05192 14.9675 9.03109 14.9152 9.01025 14.8629C9.02067 13.3209 9.02067 11.779 9.02067 10.237ZM14.6457 12.5317C14.6457 11.8835 14.6405 11.2406 14.6509 10.5924C14.6509 10.4199 14.6092 10.3468 14.4217 10.352C13.1144 10.3572 11.8071 10.3572 10.4946 10.352C10.328 10.352 10.2655 10.4043 10.2707 10.5767C10.2759 11.8887 10.2759 13.2007 10.2707 14.5179C10.2707 14.7009 10.3332 14.7532 10.5103 14.7479C11.8123 14.7427 13.1144 14.7427 14.4165 14.7479C14.5936 14.7479 14.6561 14.6957 14.6509 14.5127C14.6405 13.8541 14.6457 13.1955 14.6457 12.5317Z" fill="currentColor" />-->
                                <!--    </svg>-->
                                <!--</span>-->
                                <!--<span class="cs_view_icon cs_list_btn" data-view="list">-->
                                <!--    <svg width="21" height="16" viewBox="0 0 21 16" fill="none" xmlns="http://www.w3.org/2000/svg">-->
                                <!--        <path d="M0.0102539 1.14031C0.0362956 1.07235 0.0571289 1.00963 0.0779622 0.941678C0.260254 0.392837 0.755046 0.0112627 1.32796 0.00603568C2.73942 0.000808628 4.15088 -0.00441842 5.56234 0.00603568C6.2863 0.0112627 6.87484 0.607146 6.88004 1.33371C6.89046 2.74501 6.89046 4.15631 6.88004 5.56762C6.87484 6.30463 6.28109 6.89529 5.5415 6.90051C4.15088 6.90574 2.75505 6.90574 1.36442 6.90051C0.734212 6.90051 0.218587 6.48758 0.0519206 5.87079C0.0415039 5.8342 0.0258789 5.79761 0.0102539 5.76624C0.0102539 4.22427 0.0102539 2.68229 0.0102539 1.14031ZM3.44255 5.65125C4.09359 5.65125 4.74463 5.64602 5.39567 5.65648C5.56755 5.65648 5.63525 5.60943 5.63525 5.42649C5.63005 4.1145 5.63005 2.80251 5.63525 1.48529C5.63525 1.3128 5.58317 1.2553 5.4113 1.26053C4.104 1.26575 2.79671 1.26575 1.48421 1.26053C1.30192 1.26053 1.25505 1.32848 1.25505 1.50097C1.26025 2.80773 1.26025 4.1145 1.25505 5.42126C1.25505 5.59898 1.30713 5.6617 1.48942 5.65648C2.14046 5.64602 2.7915 5.65125 3.44255 5.65125Z" fill="currentColor" />-->
                                <!--        <path d="M0.0104167 10.236C0.0364583 10.1681 0.0572917 10.1053 0.078125 10.0374C0.260417 9.48854 0.755208 9.10697 1.32292 9.10174C2.73438 9.09651 4.14583 9.09128 5.55729 9.10174C6.28125 9.10697 6.86979 9.70285 6.875 10.4294C6.88542 11.8407 6.88542 13.252 6.875 14.6633C6.86979 15.4003 6.27604 15.991 5.53646 15.9962C4.13542 16.0014 2.73958 16.0014 1.33854 15.9962C0.744792 15.991 0.234375 15.5937 0.0572917 15.024C0.0416667 14.9665 0.0208333 14.9142 0 14.8619C0.0104167 13.32 0.0104167 11.778 0.0104167 10.236ZM5.63542 12.5307C5.63542 11.8825 5.63021 11.2396 5.64062 10.5914C5.64062 10.419 5.59896 10.3458 5.41146 10.351C4.10417 10.3562 2.79688 10.3562 1.48438 10.351C1.31771 10.351 1.25521 10.4033 1.26042 10.5758C1.26562 11.8878 1.26562 13.1997 1.26042 14.517C1.26042 14.6999 1.32292 14.7522 1.5 14.747C2.80208 14.7417 4.10417 14.7417 5.40625 14.747C5.58333 14.747 5.64583 14.6947 5.64062 14.5117C5.63021 13.8531 5.63542 13.1945 5.63542 12.5307Z" fill="currentColor" />-->
                                <!--        <path d="M14.3646 3.14221C12.7188 3.14221 11.0729 3.14221 9.42189 3.14221C8.94273 3.14221 8.63543 2.71359 8.8021 2.2902C8.89585 2.04976 9.07814 1.91908 9.33335 1.89295C9.39064 1.88772 9.44793 1.89295 9.51043 1.89295C12.7604 1.89295 16.0052 1.89295 19.2552 1.89295C19.3386 1.89295 19.4271 1.88772 19.5104 1.90863C19.8177 1.97135 20.0313 2.25884 20.0104 2.56724C19.9896 2.88609 19.7292 3.14221 19.4063 3.14744C18.9584 3.15789 18.5104 3.15267 18.0573 3.15267C16.8281 3.14221 15.5938 3.14221 14.3646 3.14221Z" fill="currentColor" />-->
                                <!--        <path d="M14.406 10.8259C16.0519 10.8259 17.6977 10.8259 19.3487 10.8259C19.8175 10.8259 20.1248 11.2388 19.9737 11.657C19.8852 11.9079 19.6977 12.0438 19.4321 12.0751C19.3748 12.0804 19.3175 12.0804 19.255 12.0804C16.005 12.0804 12.7602 12.0804 9.51019 12.0804C9.42686 12.0804 9.33832 12.0856 9.26019 12.0647C8.9529 12.002 8.73936 11.7145 8.76019 11.4061C8.78102 11.0872 9.04144 10.8311 9.36436 10.8259C9.85915 10.8154 10.3539 10.8206 10.8487 10.8206C12.0362 10.8259 13.2185 10.8259 14.406 10.8259Z" fill="currentColor" />-->
                                <!--        <path d="M12.6665 4.2406C13.7446 4.2406 14.828 4.2406 15.9061 4.2406C16.3905 4.2406 16.703 4.6849 16.5207 5.10829C16.4009 5.38533 16.1769 5.4951 15.88 5.4951C14.4686 5.48987 13.0571 5.4951 11.6405 5.4951C10.9269 5.4951 10.2082 5.4951 9.49463 5.4951C9.04671 5.4951 8.76025 5.2442 8.76025 4.86262C8.76546 4.48628 9.04671 4.2406 9.48421 4.2406C10.5467 4.23538 11.604 4.2406 12.6665 4.2406Z" fill="currentColor" />-->
                                <!--        <path d="M12.6875 13.3353C13.7604 13.3353 14.8333 13.3353 15.9115 13.3353C16.3958 13.3353 16.7083 13.7796 16.526 14.203C16.4062 14.4801 16.1823 14.5898 15.8854 14.5898C14.474 14.5846 13.0625 14.5898 11.6458 14.5898C10.9323 14.5898 10.2135 14.5898 9.5 14.5898C9.05208 14.5898 8.76562 14.3389 8.76562 13.9573C8.77083 13.581 9.05208 13.3353 9.48958 13.3353C10.5521 13.3301 11.6198 13.3353 12.6875 13.3353Z" fill="currentColor" />-->
                                <!--    </svg>-->
                                <!--</span>-->
                            </div>
                        </div>
                    </div>

                    <!-- Product Grid -->
                    <div class="cs_product_grid cs_product_grid_3 cs_grid_view" id="productGrid">
                        @foreach($products as $product)
                            <div class="cs_product_col ts-product-card" 
                                 data-price="{{ $product->price }}" 
                                 data-category="{{ $product->category_id }}"
                                 data-name="{{ strtolower($product->name) }}">
                                <div class="cs_product cs_style_1">
                                    <div class="cs_product_thumb position-relative">
                                        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-100 cs_product_img">
                                        
                                        @if($product->discount_percentage)
                                            <div class="cs_discount_badge cs_white_bg cs_fs_14 cs_primary_color position-absolute">
                                                -{{ $product->discount_percentage }}%
                                            </div>
                                        @endif
                                        
                                        <div class="cs_cart_badge position-absolute">
                                            {{-- <button class="cs_cart_icon cs_accent_bg cs_white_color">
                                                <i class="fa-regular fa-heart"></i>
                                            </button> --}}
                                            <a href="{{ route('web.product.details', $product->id) }}" class="cs_cart_icon cs_accent_bg cs_white_color">
                                                <i class="fa-regular fa-eye"></i>
                                            </a>
                                        </div>
                                        
                                        <button class="cs_cart_btn cs_accent_bg cs_fs_16 cs_white_color cs_medium position-absolute ecommerce-add-to-cart-btn"
                                                data-product-id="{{ $product->id }}"
                                                data-product-name="{{ $product->name }}"
                                                data-product-price="{{ $product->price }}"
                                                data-product-image="{{ asset('storage/' . $product->image) }}">
                                            Add To Cart
                                        </button>
                                    </div>
                                    
                                    <div class="cs_product_info text-center">
                                        <h3 class="cs_product_title cs_fs_21 cs_medium">
                                            <a href="{{ route('web.product.details', $product->id) }}" class="ts-product-title">{{ $product->name }}</a>
                                        </h3>
                                        
                                        <div class="cs_single_product_review">
                                            <div class="cs_rating_container">
                                                <div class="cs_rating cs_size_sm" data-rating="4.5">
                                                    <div class="cs_rating_percentage" style="width: 90%"></div>
                                                </div>
                                            </div>
                                            <span>(25 reviews)</span>
                                        </div>
                                        
                                        <div class="cs_product_price_wrap">
                                            @if($product->discount_percentage)
                                                <span class="cs_product_price_old">${{ number_format($product->price * (1 + $product->discount_percentage / 100), 2) }}</span>
                                            @endif
                                            <p class="cs_product_price cs_fs_18 cs_accent_color mb-0 cs_medium">
                                                ${{ number_format($product->price, 2) }}
                                            </p>
                                        </div>
                                        
                                        <div class="cs_product_stock">
                                            <span class="cs_stock_status cs_accent_color">In Stock</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- Pagination -->
                    <div class="cs_height_75 cs_height_lg_50"></div>
                    <div class="cs_pagination_wrap">
                        <ul class="cs_pagination cs_fs_21 cs_semibold cs_mp0">
                            <li class="cs_page_item">
                                <a class="cs_page_link" href="#" aria-label="Previous">
                                    <i class="fa-solid fa-arrow-left"></i>
                                </a>
                            </li>
                            <li class="cs_page_item active"><a class="cs_page_link" href="#">1</a></li>
                            <li class="cs_page_item"><a class="cs_page_link" href="#">2</a></li>
                            <li class="cs_page_item"><a class="cs_page_link" href="#">3</a></li>
                            <li class="cs_page_item">
                                <a class="cs_page_link" href="#" aria-label="Next">
                                    <i class="fa-solid fa-arrow-right"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div><!-- .col -->
        </div>
    </div>
    <div class="cs_height_140 cs_height_lg_80"></div>
</section>
<!-- End Shop -->


<script>
// Filter and sort functionality
let currentPage = 1;
const productsPerPage = 9; // Change as needed

function getVisibleProducts() {
    const products = Array.from(document.querySelectorAll('.ts-product-card'));
    return products.filter(product => product.style.display !== 'none');
}

function showPage(page) {
    const visibleProducts = getVisibleProducts();
    const totalPages = Math.ceil(visibleProducts.length / productsPerPage);
    currentPage = Math.max(1, Math.min(page, totalPages));
    visibleProducts.forEach((product, idx) => {
        if (idx >= (currentPage - 1) * productsPerPage && idx < currentPage * productsPerPage) {
            product.style.display = 'block';
        } else {
            product.style.display = 'none';
        }
    });
    updatePaginationControls(totalPages);
    document.getElementById('productCount').textContent = visibleProducts.length;
}

function updatePaginationControls(totalPages) {
    const paginationWrap = document.querySelector('.cs_pagination_wrap ul');
    if (!paginationWrap) return;
    let html = '';
    html += `<li class="cs_page_item"><a class="cs_page_link" href="#" aria-label="Previous" data-page="prev"><i class="fa-solid fa-arrow-left"></i></a></li>`;
    for (let i = 1; i <= totalPages; i++) {
        html += `<li class="cs_page_item${i === currentPage ? ' active' : ''}"><a class="cs_page_link" href="#" data-page="${i}">${i}</a></li>`;
    }
    html += `<li class="cs_page_item"><a class="cs_page_link" href="#" aria-label="Next" data-page="next"><i class="fa-solid fa-arrow-right"></i></a></li>`;
    paginationWrap.innerHTML = html;
    // Add event listeners
    paginationWrap.querySelectorAll('a.cs_page_link').forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            let page = this.getAttribute('data-page');
            if (page === 'prev') {
                showPage(currentPage - 1);
            } else if (page === 'next') {
                showPage(currentPage + 1);
            } else {
                showPage(parseInt(page));
            }
        });
    });
}

function resetFilters() {
    // Reset search
    document.getElementById('searchInput').value = '';
    
    // Reset price range
    const priceRange = document.getElementById('priceRange');
    priceRange.value = priceRange.max;
    document.getElementById('priceRangeValue').textContent = `$0 - $${priceRange.max}`;
    
    // Reset category selection
    document.querySelector('input[name="category"][value="all"]').checked = true;
    
    // Reset rating selection
    const ratingInputs = document.querySelectorAll('input[name="rating"]');
    ratingInputs.forEach(input => input.checked = false);
    
    // Reset color selection
    const colorBoxes = document.querySelectorAll('.cs_color_box');
    colorBoxes.forEach(box => box.classList.remove('active'));
    
    // Reset size selection
    const sizeBoxes = document.querySelectorAll('.cs_size_box');
    sizeBoxes.forEach(box => box.classList.remove('active'));
    
    // Reset brand checkboxes
    const brandInputs = document.querySelectorAll('input[type="checkbox"]');
    brandInputs.forEach(input => input.checked = false);
    
    // Trigger filter update to show all products
    updateFilters();
}

function updateFilters() {
    const searchTerm = document.getElementById('searchInput').value.toLowerCase();
    const priceLimit = document.getElementById('priceRange').value;
    const selectedCategory = document.querySelector('input[name="category"]:checked').value;
    const products = document.querySelectorAll('.ts-product-card');
    products.forEach(product => {
        const price = parseFloat(product.dataset.price);
        const category = product.dataset.category;
        const name = product.dataset.name;
        const matchesSearch = name.includes(searchTerm);
        const matchesPrice = price <= priceLimit;
        const matchesCategory = selectedCategory === 'all' || category === selectedCategory;
        if (matchesSearch && matchesPrice && matchesCategory) {
            product.style.display = 'block';
        } else {
            product.style.display = 'none';
        }
    });
    showPage(1); // Reset to first page after filter
}

function sortProducts() {
    const sortValue = document.getElementById('sortProducts').value;
    const productGrid = document.getElementById('productGrid');
    const products = Array.from(productGrid.querySelectorAll('.ts-product-card'));
    
    products.sort((a, b) => {
        switch(sortValue) {
            case 'name_asc':
                return a.dataset.name.localeCompare(b.dataset.name);
            case 'name_desc':
                return b.dataset.name.localeCompare(a.dataset.name);
            case 'price_low':
                return parseFloat(a.dataset.price) - parseFloat(b.dataset.price);
            case 'price_high':
                return parseFloat(b.dataset.price) - parseFloat(a.dataset.price);
            default:
                return 0;
        }
    });
    
    // Reappend sorted products
    products.forEach(product => {
        productGrid.appendChild(product);
    });
}

function toggleView(view) {
    const productGrid = document.getElementById('productGrid');
    const gridBtn = document.querySelector('.cs_grid_btn');
    const listBtn = document.querySelector('.cs_list_btn');
    
    if (view === 'grid') {
        productGrid.classList.add('cs_grid_view');
        productGrid.classList.remove('cs_list_view');
        gridBtn.classList.add('active');
        listBtn.classList.remove('active');
    } else {
        productGrid.classList.add('cs_list_view');
        productGrid.classList.remove('cs_grid_view');
        listBtn.classList.add('active');
        gridBtn.classList.remove('active');
    }
}

// Event listeners
document.addEventListener('DOMContentLoaded', function() {
    // Search filter
    document.getElementById('searchInput').addEventListener('input', updateFilters);
    
    // Price range filter
    document.getElementById('priceRange').addEventListener('input', (e) => {
        document.getElementById('priceRangeValue').textContent = `$0 - $${e.target.value}`;
        updateFilters();
    });
    
    // Category filter
    document.querySelectorAll('input[name="category"]').forEach(radio => {
        radio.addEventListener('change', function() {
            // Update URL to reflect category selection
            const currentUrl = new URL(window.location);
            
            if (this.value === 'all') {
                currentUrl.searchParams.delete('category');
            } else {
                currentUrl.searchParams.set('category', this.value);
            }
            
            // Update the URL without page reload
            window.history.pushState({}, '', currentUrl);
            
            // Update filters to show/hide products
            updateFilters();
        });
    });
    
    // Rating filter
    document.querySelectorAll('input[name="rating"]').forEach(radio => {
        radio.addEventListener('change', updateFilters);
    });
    
    // Color filter
    document.querySelectorAll('.cs_color_box').forEach(colorBox => {
        colorBox.addEventListener('click', function() {
            // Toggle active state
            this.classList.toggle('active');
            updateFilters();
        });
    });
    
    // Size filter
    document.querySelectorAll('.cs_size_box').forEach(sizeBox => {
        sizeBox.addEventListener('click', function() {
            // Toggle active state
            this.classList.toggle('active');
            updateFilters();
        });
    });
    
    // Brand filter
    document.querySelectorAll('input[type="checkbox"]').forEach(checkbox => {
        checkbox.addEventListener('change', updateFilters);
    });
    
    // Sort functionality
    document.getElementById('sortProducts').addEventListener('change', sortProducts);
    
    // View toggle
    document.querySelector('.cs_grid_btn').addEventListener('click', () => toggleView('grid'));
    document.querySelector('.cs_list_btn').addEventListener('click', () => toggleView('list'));
    
    // Initialize filters and pagination
    updateFilters();
});
</script>

@endsection