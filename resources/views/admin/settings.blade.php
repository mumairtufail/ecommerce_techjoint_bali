@extends('admin.layout.app')
@section('title', 'Manage Banners')

@section('content')
<!-- Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<style>
    :root {
        --primary-color: #8B7BA8;
        --primary-light: #A893C4;
        --primary-lighter: #C4B5D8;
        --primary-lightest: #E9E3F0;
        --primary-dark: #6B5B7D;
        --background: #F8F9FA;
        --white: #FFFFFF;
        --text-dark: #2D3748;
        --text-medium: #4A5568;
        --text-light: #718096;
        --border-light: #E2E8F0;
        --success: #48BB78;
        --warning: #ED8936;
        --danger: #F56565;
        --info: #4299E1;
    }

    .settings-container {
        background-color: var(--background);
        min-height: 100vh;
        padding: 2rem 0;
    }

    .page-header {
        background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-light) 100%);
        color: var(--white);
        padding: 2rem;
        border-radius: 16px;
        margin-bottom: 2rem;
    }

    .page-title {
        font-size: 1.75rem;
        font-weight: 700;
        margin-bottom: 0.5rem;
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }

    .page-subtitle {
        opacity: 0.85;
        font-size: 1rem;
        margin: 0;
    }

    .size-recommendation {
        background: rgba(255, 255, 255, 0.15);
        padding: 1rem;
        border-radius: 12px;
        margin-top: 1rem;
    }

    .banner-card {
        background: var(--white);
        border-radius: 16px;
        padding: 1.5rem;
        box-shadow: 0 1px 3px rgba(139, 123, 168, 0.08);
        margin-bottom: 1.5rem;
        transition: all 0.2s ease;
    }

    .banner-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(139, 123, 168, 0.15);
    }

    .banner-header {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        margin-bottom: 1.5rem;
        padding-bottom: 1rem;
        border-bottom: 1px solid var(--border-light);
    }

    .banner-header h5 {
        margin: 0;
        color: var(--text-dark);
        font-weight: 600;
    }

    .banner-header i {
        color: var(--primary-color);
    }

    .banner-preview {
        position: relative;
        overflow: hidden;
        border-radius: 12px;
        margin-bottom: 1.5rem;
        border: 1px solid var(--border-light);
    }

    .banner-preview img {
        width: 100%;
        height: 200px;
        object-fit: cover;
    }

    .form-label {
        font-weight: 600;
        color: var(--text-medium);
        margin-bottom: 0.5rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .form-label i {
        color: var(--primary-color);
    }

    .form-control {
        border: 1px solid var(--border-light);
        border-radius: 8px;
        padding: 0.75rem;
        transition: border-color 0.2s ease;
        font-size: 0.9rem;
    }

    .form-control:focus {
        outline: none;
        border-color: var(--primary-color);
        box-shadow: 0 0 0 3px rgba(139, 123, 168, 0.1);
    }

    .custom-file {
        position: relative;
        margin-bottom: 1rem;
    }

    .custom-file-input {
        position: relative;
        z-index: 2;
        width: 100%;
        height: calc(2.25rem + 2px);
        margin: 0;
        opacity: 0;
    }

    .custom-file-label {
        position: absolute;
        top: 0;
        right: 0;
        left: 0;
        z-index: 1;
        height: calc(2.25rem + 2px);
        padding: 0.75rem;
        line-height: 1.5;
        color: var(--text-medium);
        background-color: var(--white);
        border: 1px solid var(--border-light);
        border-radius: 8px;
        transition: all 0.2s ease;
        cursor: pointer;
    }

    .custom-file-label:hover {
        border-color: var(--primary-color);
        background-color: rgba(139, 123, 168, 0.05);
    }

    .custom-file-label::after {
        content: "Choose file";
        position: absolute;
        top: 0;
        right: 0;
        bottom: 0;
        z-index: 3;
        display: block;
        height: calc(2.25rem);
        padding: 0.75rem 1rem;
        line-height: 1.5;
        color: var(--white);
        background-color: var(--primary-color);
        border-left: 1px solid var(--primary-color);
        border-radius: 0 8px 8px 0;
        transition: background-color 0.2s ease;
    }

    .custom-file-input:hover + .custom-file-label::after {
        background-color: var(--primary-dark);
    }

    .file-hint {
        color: var(--text-light);
        font-size: 0.875rem;
        margin-top: 0.25rem;
    }

    .btn-primary-custom {
        background: var(--primary-color);
        border: 1px solid var(--primary-color);
        color: var(--white);
        padding: 0.75rem 2rem;
        border-radius: 10px;
        font-weight: 500;
        transition: all 0.2s ease;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        text-decoration: none;
        font-size: 1rem;
    }

    .btn-primary-custom:hover {
        background: var(--primary-dark);
        border-color: var(--primary-dark);
        color: var(--white);
        transform: translateY(-1px);
        text-decoration: none;
    }

    .alert-custom {
        border: none;
        border-radius: 12px;
        padding: 1rem 1.5rem;
        margin-bottom: 1.5rem;
    }

    .alert-success {
        background: rgba(72, 187, 120, 0.1);
        color: var(--success);
        border-left: 4px solid var(--success);
    }

    .alert-danger {
        background: rgba(245, 101, 101, 0.1);
        color: var(--danger);
        border-left: 4px solid var(--danger);
    }

    .form-actions {
        background: var(--white);
        padding: 2rem;
        border-radius: 16px;
        box-shadow: 0 1px 3px rgba(139, 123, 168, 0.08);
        text-align: center;
        margin-top: 2rem;
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .settings-container {
            padding: 1rem 0;
        }
        
        .page-header {
            padding: 1.5rem;
            text-align: center;
        }
        
        .page-title {
            font-size: 1.5rem;
            justify-content: center;
        }
        
        .banner-card {
            padding: 1rem;
        }

        .banner-preview img {
            height: 150px;
        }
    }
</style>

<div class="settings-container">
    <div class="container-fluid">
        <!-- Page Header -->
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h1 class="page-title">
                        <i class="fas fa-images"></i>
                        Manage Banners
                    </h1>
                    <p class="page-subtitle">Configure banner images and text for the website</p>
                </div>
                <div class="col-md-4">
                    <div class="size-recommendation">
                        <div class="d-flex align-items-center">
                            <i class="fas fa-ruler-combined mr-2"></i>
                            <div>
                                <small class="d-block font-weight-bold">Recommended Dimensions</small>
                                <span class="d-block">1920 x 600 pixels</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Alert Messages -->
        @if(session('success'))
            <div class="alert alert-success alert-custom alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        @if($errors->any())
            <div class="alert alert-danger alert-custom alert-dismissible fade show" role="alert">
                <h6><i class="fas fa-exclamation-triangle"></i> Please fix the following errors:</h6>
                <ul class="mb-0 mt-2">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        <!-- Banner Form -->
        <form action="{{ route('settings.update.banners') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="row">
                <!-- Home Banner -->
                <div class="col-lg-6 col-md-12">
                    <div class="banner-card">
                        <div class="banner-header">
                            <i class="fas fa-home"></i>
                            <h5>Home Page Banner</h5>
                        </div>
                        @if($homeBanner && $homeBanner->image)
                            <div class="banner-preview">
                                <img src="{{ asset('storage/'.$homeBanner->image) }}" alt="Home Banner">
                            </div>
                        @endif
                        <div class="form-group">
                            <label class="form-label">
                                <i class="fas fa-upload"></i>
                                Update Home Banner
                            </label>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" name="home_banner" id="home_banner" accept="image/*">
                                <label class="custom-file-label" for="home_banner">Choose file</label>
                            </div>
                            <div class="file-hint">PNG, JPG, JPEG up to 2MB</div>
                        </div>
                        <div class="form-group">
                            <label class="form-label">
                                <i class="fas fa-heading"></i>
                                Title
                            </label>
                            <input type="text" class="form-control" name="home_title" value="{{ $homeBanner->title ?? '' }}" placeholder="Enter banner title">
                        </div>
                        <div class="form-group">
                            <label class="form-label">
                                <i class="fas fa-text-width"></i>
                                Subtitle
                            </label>
                            <input type="text" class="form-control" name="home_subtitle" value="{{ $homeBanner->subtitle ?? '' }}" placeholder="Enter banner subtitle">
                        </div>
                    </div>
                </div>

                <!-- Shop Banner -->
                <div class="col-lg-6 col-md-12">
                    <div class="banner-card">
                        <div class="banner-header">
                            <i class="fas fa-shopping-bag"></i>
                            <h5>Shop Page Banner</h5>
                        </div>
                        @if($shopBanner && $shopBanner->image)
                            <div class="banner-preview">
                                <img src="{{ asset('storage/'.$shopBanner->image) }}" alt="Shop Banner">
                            </div>
                        @endif
                        <div class="form-group">
                            <label class="form-label">
                                <i class="fas fa-upload"></i>
                                Update Shop Banner
                            </label>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" name="shop_banner" id="shop_banner" accept="image/*">
                                <label class="custom-file-label" for="shop_banner">Choose file</label>
                            </div>
                            <div class="file-hint">PNG, JPG, JPEG up to 2MB</div>
                        </div>
                        <div class="form-group">
                            <label class="form-label">
                                <i class="fas fa-heading"></i>
                                Title
                            </label>
                            <input type="text" class="form-control" name="shop_title" value="{{ $shopBanner->title ?? '' }}" placeholder="Enter banner title">
                        </div>
                        <div class="form-group">
                            <label class="form-label">
                                <i class="fas fa-text-width"></i>
                                Subtitle
                            </label>
                            <input type="text" class="form-control" name="shop_subtitle" value="{{ $shopBanner->subtitle ?? '' }}" placeholder="Enter banner subtitle">
                        </div>
                    </div>
                </div>

                <!-- About Banner -->
                <div class="col-lg-6 col-md-12">
                    <div class="banner-card">
                        <div class="banner-header">
                            <i class="fas fa-info-circle"></i>
                            <h5>About Page Banner</h5>
                        </div>
                        @if($aboutBanner && $aboutBanner->image)
                            <div class="banner-preview">
                                <img src="{{ asset('storage/'.$aboutBanner->image) }}" alt="About Banner">
                            </div>
                        @endif
                        <div class="form-group">
                            <label class="form-label">
                                <i class="fas fa-upload"></i>
                                Update About Banner
                            </label>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" name="about_banner" id="about_banner" accept="image/*">
                                <label class="custom-file-label" for="about_banner">Choose file</label>
                            </div>
                            <div class="file-hint">PNG, JPG, JPEG up to 2MB</div>
                        </div>
                        <div class="form-group">
                            <label class="form-label">
                                <i class="fas fa-heading"></i>
                                Title
                            </label>
                            <input type="text" class="form-control" name="about_title" value="{{ $aboutBanner->title ?? '' }}" placeholder="Enter banner title">
                        </div>
                        <div class="form-group">
                            <label class="form-label">
                                <i class="fas fa-text-width"></i>
                                Subtitle
                            </label>
                            <input type="text" class="form-control" name="about_subtitle" value="{{ $aboutBanner->subtitle ?? '' }}" placeholder="Enter banner subtitle">
                        </div>
                    </div>
                </div>

                <!-- Contact Banner -->
                <div class="col-lg-6 col-md-12">
                    <div class="banner-card">
                        <div class="banner-header">
                            <i class="fas fa-envelope"></i>
                            <h5>Contact Page Banner</h5>
                        </div>
                        @if($contactBanner && $contactBanner->image)
                            <div class="banner-preview">
                                <img src="{{ asset('storage/'.$contactBanner->image) }}" alt="Contact Banner">
                            </div>
                        @endif
                        <div class="form-group">
                            <label class="form-label">
                                <i class="fas fa-upload"></i>
                                Update Contact Banner
                            </label>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" name="contact_banner" id="contact_banner" accept="image/*">
                                <label class="custom-file-label" for="contact_banner">Choose file</label>
                            </div>
                            <div class="file-hint">PNG, JPG, JPEG up to 2MB</div>
                        </div>
                        <div class="form-group">
                            <label class="form-label">
                                <i class="fas fa-heading"></i>
                                Title
                            </label>
                            <input type="text" class="form-control" name="contact_title" value="{{ $contactBanner->title ?? '' }}" placeholder="Enter banner title">
                        </div>
                        <div class="form-group">
                            <label class="form-label">
                                <i class="fas fa-text-width"></i>
                                Subtitle
                            </label>
                            <input type="text" class="form-control" name="contact_subtitle" value="{{ $contactBanner->subtitle ?? '' }}" placeholder="Enter banner subtitle">
                        </div>
                    </div>
                </div>

                <!-- Mid Photo Banner -->
                {{-- <div class="col-lg-4 col-md-12">
                    <div class="banner-card">
                        <div class="banner-header">
                            <i class="fas fa-image"></i>
                            <h5>Home Mid Photo</h5>
                        </div>
                        @if(isset($midPhotoBanner) && $midPhotoBanner->image)
                            <div class="banner-preview">
                                <img src="{{ asset('storage/'.$midPhotoBanner->image) }}" alt="Mid Section Photo">
                            </div>
                        @endif
                        <div class="form-group">
                            <label class="form-label">
                                <i class="fas fa-upload"></i>
                                Update Mid Photo
                            </label>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" name="mid_photo" id="mid_photo" accept="image/*">
                                <label class="custom-file-label" for="mid_photo">Choose file</label>
                            </div>
                            <div class="file-hint">Recommended dimensions for better display</div>
                        </div>
                        <div class="form-group">
                            <label class="form-label">
                                <i class="fas fa-heading"></i>
                                Title
                            </label>
                            <input type="text" class="form-control" name="mid_title" value="{{ $midPhotoBanner->title ?? '' }}" placeholder="Enter title">
                        </div>
                        <div class="form-group">
                            <label class="form-label">
                                <i class="fas fa-text-width"></i>
                                Subtitle
                            </label>
                            <input type="text" class="form-control" name="mid_subtitle" value="{{ $midPhotoBanner->subtitle ?? '' }}" placeholder="Enter subtitle">
                        </div>
                    </div>
                </div>

                <!-- Left Image -->
                <div class="col-lg-4 col-md-12">
                    <div class="banner-card">
                        <div class="banner-header">
                            <i class="fas fa-arrow-left"></i>
                            <h5>Left Section Image</h5>
                        </div>
                        @if(isset($leftImageBanner) && $leftImageBanner->image)
                            <div class="banner-preview">
                                <img src="{{ asset('storage/'.$leftImageBanner->image) }}" alt="Left Section Image">
                            </div>
                        @endif
                        <div class="form-group">
                            <label class="form-label">
                                <i class="fas fa-upload"></i>
                                Update Left Image
                            </label>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" name="left_image" id="left_image" accept="image/*">
                                <label class="custom-file-label" for="left_image">Choose file</label>
                            </div>
                            <div class="file-hint">Best suited for promotional content</div>
                        </div>
                        <div class="form-group">
                            <label class="form-label">
                                <i class="fas fa-heading"></i>
                                Title
                            </label>
                            <input type="text" class="form-control" name="left_title" value="{{ $leftImageBanner->title ?? '' }}" placeholder="Enter title">
                        </div>
                        <div class="form-group">
                            <label class="form-label">
                                <i class="fas fa-text-width"></i>
                                Subtitle
                            </label>
                            <input type="text" class="form-control" name="left_subtitle" value="{{ $leftImageBanner->subtitle ?? '' }}" placeholder="Enter subtitle">
                        </div>
                    </div>
                </div>

                <!-- Right Image -->
                <div class="col-lg-4 col-md-12">
                    <div class="banner-card">
                        <div class="banner-header">
                            <i class="fas fa-arrow-right"></i>
                            <h5>Right Section Image</h5>
                        </div>
                        @if(isset($rightImageBanner) && $rightImageBanner->image)
                            <div class="banner-preview">
                                <img src="{{ asset('storage/'.$rightImageBanner->image) }}" alt="Right Section Image">
                            </div>
                        @endif
                        <div class="form-group">
                            <label class="form-label">
                                <i class="fas fa-upload"></i>
                                Update Right Image
                            </label>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" name="right_image" id="right_image" accept="image/*">
                                <label class="custom-file-label" for="right_image">Choose file</label>
                            </div>
                            <div class="file-hint">Perfect for seasonal campaigns</div>
                        </div>
                        <div class="form-group">
                            <label class="form-label">
                                <i class="fas fa-heading"></i>
                                Title
                            </label>
                            <input type="text" class="form-control" name="right_title" value="{{ $rightImageBanner->title ?? '' }}" placeholder="Enter title">
                        </div>
                        <div class="form-group">
                            <label class="form-label">
                                <i class="fas fa-text-width"></i>
                                Subtitle
                            </label>
                            <input type="text" class="form-control" name="right_subtitle" value="{{ $rightImageBanner->subtitle ?? '' }}" placeholder="Enter subtitle">
                        </div>
                    </div>
                </div> --}}
            </div>

            <!-- Form Actions -->
            <div class="form-actions">
                <button type="submit" class="btn-primary-custom">
                    <i class="fas fa-save"></i>
                    Update All Banners
                </button>
            </div>
        </form>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Custom file input handler
    const fileInputs = document.querySelectorAll('.custom-file-input');
    
    fileInputs.forEach(function(input) {
        input.addEventListener('change', function() {
            const fileName = this.files[0] ? this.files[0].name : 'Choose file';
            const label = this.nextElementSibling;
            label.textContent = fileName;
            label.classList.add('selected');
        });
    });
});
</script>

@endsection