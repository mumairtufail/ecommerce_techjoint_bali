@extends('admin.layout.app')

@section('content')
<div class="container-fluid mt-4">
    <div class="row mb-4">
        <div class="col-12">
  <!-- Header Section with gradient background -->
  <div class="header-section bg-gradient-purple text-black p-4 rounded-lg shadow-lg mb-4">
                <div class="d-flex justify-content-between align-items-center flex-wrap">
                    <div class="mb-3 mb-md-0">
                        <h4 class="mb-1 font-weight-bold">
                            <i class="fas fa-images mr-2"></i>Manage Banners
                        </h4>
                        <p class="mb-0 opacity-80">Configure banner images and text for the website</p>
                    </div>
                    <div class="size-recommendation-badge">
                        <div class="d-flex align-items-center">
                            <i class="fas fa-ruler-combined mr-2"></i>
                            <div>
                                <small class="d-block font-weight-bold text-black">Recommended Dimensions</small>
                                <span class="d-block">1920 x 600 pixels</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif

            @if($errors->any())
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <ul class="mb-0">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif

            <form action="{{ route('settings.update.banners') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="row">
                    <!-- Home Banner -->
                    <div class="col-md-6 mb-4">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="mb-0">Home Page Banner</h5>
                            </div>
                            <div class="card-body">
                                @if($homeBanner && $homeBanner->image)
                                    <img src="{{ asset('storage/'.$homeBanner->image) }}" class="img-fluid mb-3" alt="Home Banner">
                                @endif
                                <div class="form-group">
                                    <label>Update Home Banner</label>
                                    <input type="file" class="form-control-file" name="home_banner">
                                </div>
                                <div class="form-group">
                                    <label>Title</label>
                                    <input type="text" class="form-control" name="home_title" value="{{ $homeBanner->title ?? '' }}">
                                </div>
                                <div class="form-group">
                                    <label>Subtitle</label>
                                    <input type="text" class="form-control" name="home_subtitle" value="{{ $homeBanner->subtitle ?? '' }}">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Shop Banner -->
                    <div class="col-md-6 mb-4">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="mb-0">Shop Page Banner</h5>
                            </div>
                            <div class="card-body">
                                @if($shopBanner && $shopBanner->image)
                                    <img src="{{ asset('storage/'.$shopBanner->image) }}" class="img-fluid mb-3" alt="Shop Banner">
                                @endif
                                <div class="form-group">
                                    <label>Update Shop Banner</label>
                                    <input type="file" class="form-control-file" name="shop_banner">
                                </div>
                                <div class="form-group">
                                    <label>Title</label>
                                    <input type="text" class="form-control" name="shop_title" value="{{ $shopBanner->title ?? '' }}">
                                </div>
                                <div class="form-group">
                                    <label>Subtitle</label>
                                    <input type="text" class="form-control" name="shop_subtitle" value="{{ $shopBanner->subtitle ?? '' }}">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- About Banner -->
                    <div class="col-md-6 mb-4">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="mb-0">About Page Banner</h5>
                            </div>
                            <div class="card-body">
                                @if($aboutBanner && $aboutBanner->image)
                                    <img src="{{ asset('storage/'.$aboutBanner->image) }}" class="img-fluid mb-3" alt="About Banner">
                                @endif
                                <div class="form-group">
                                    <label>Update About Banner</label>
                                    <input type="file" class="form-control-file" name="about_banner">
                                </div>
                                <div class="form-group">
                                    <label>Title</label>
                                    <input type="text" class="form-control" name="about_title" value="{{ $aboutBanner->title ?? '' }}">
                                </div>
                                <div class="form-group">
                                    <label>Subtitle</label>
                                    <input type="text" class="form-control" name="about_subtitle" value="{{ $aboutBanner->subtitle ?? '' }}">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Contact Banner -->
                    <div class="col-md-6 mb-4">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="mb-0">Contact Page Banner</h5>
                            </div>
                            <div class="card-body">
                                @if($contactBanner && $contactBanner->image)
                                    <img src="{{ asset('storage/'.$contactBanner->image) }}" class="img-fluid mb-3" alt="Contact Banner">
                                @endif
                                <div class="form-group">
                                    <label>Update Contact Banner</label>
                                    <input type="file" class="form-control-file" name="contact_banner">
                                </div>
                                <div class="form-group">
                                    <label>Title</label>
                                    <input type="text" class="form-control" name="contact_title" value="{{ $contactBanner->title ?? '' }}">
                                </div>
                                <div class="form-group">
                                    <label>Subtitle</label>
                                    <input type="text" class="form-control" name="contact_subtitle" value="{{ $contactBanner->subtitle ?? '' }}">
                                </div>
                            </div>
                        </div>
                    </div>



<!-- Mid Photo Banner -->
<div class="col-md-4 mb-4">
    <div class="card shadow-sm h-100">
        <div class="card-header  text-white">
            <h5 class="mb-0">
                <i class="mr-2"></i>Home Mid Photo
            </h5>
        </div>
        <div class="card-body">
            @if(isset($midPhotoBanner) && $midPhotoBanner->image)
                <div class="banner-preview mb-3">
                    <img src="{{ asset('storage/'.$midPhotoBanner->image) }}" 
                         class="img-fluid rounded shadow-sm" 
                         alt="Mid Section Photo">
                </div>
            @endif
            <div class="form-group">
                <label class="font-weight-bold">
                    <i class="fas fa-upload mr-1"></i>Update Mid Photo
                </label>
                <div class="custom-file">
                    <input type="file" 
                           class="custom-file-input" 
                           name="mid_photo" 
                           id="mid_photo"
                           accept="image/*">
                    <label class="custom-file-label" for="mid_photo">Choose file</label>
                </div>
                <small class="form-text text-muted">
                    <i class="fas fa-info-circle mr-1"></i>
                    Recommended dimensions for better display
                </small>
            </div>
            <div class="form-group">
                <label>Title</label>
                <input type="text" class="form-control" name="mid_title" value="{{ $midPhotoBanner->title ?? '' }}">
            </div>
            <div class="form-group">
                <label>Subtitle</label>
                <input type="text" class="form-control" name="mid_subtitle" value="{{ $midPhotoBanner->subtitle ?? '' }}">
            </div>
        </div>
    </div>
</div>

<!-- Left Image -->
<div class="col-md-4 mb-4">
    <div class="card shadow-sm h-100">
        <div class="card-header text-white">
            <h5 class="mb-0">
                <i class=" mr-2"></i>Left Section Image
            </h5>
        </div>
        <div class="card-body">
            @if(isset($leftImageBanner) && $leftImageBanner->image)
                <div class="banner-preview mb-3">
                    <img src="{{ asset('storage/'.$leftImageBanner->image) }}" 
                         class="img-fluid rounded shadow-sm" 
                         alt="Left Section Image">
                </div>
            @endif
            <div class="form-group">
                <label class="font-weight-bold">
                    <i class="mr-1"></i>Update Left Image
                </label>
                <div class="custom-file">
                    <input type="file" 
                           class="custom-file-input" 
                           name="left_image" 
                           id="left_image"
                           accept="image/*">
                    <label class="custom-file-label" for="left_image">Choose file</label>
                </div>
                <small class="form-text text-muted">
                    <i class="fas fa-info-circle mr-1"></i>
                    Best suited for promotional content
                </small>
            </div>
            <div class="form-group">
                <label>Title</label>
                <input type="text" class="form-control" name="left_title" value="{{ $leftImageBanner->title ?? '' }}">
            </div>
            <div class="form-group">
                <label>Subtitle</label>
                <input type="text" class="form-control" name="left_subtitle" value="{{ $leftImageBanner->subtitle ?? '' }}">
            </div>
        </div>
    </div>
</div>

<!-- Right Image -->
<div class="col-md-4 mb-4">
    <div class="card shadow-sm h-100">
        <div class="card-header text-white">
            <h5 class="mb-0">
                <i class="mr-2"></i>Right Section Image
            </h5>
        </div>
        <div class="card-body">
            @if(isset($rightImageBanner) && $rightImageBanner->image)
                <div class="banner-preview mb-3">
                    <img src="{{ asset('storage/'.$rightImageBanner->image) }}" 
                         class="img-fluid rounded shadow-sm" 
                         alt="Right Section Image">
                </div>
            @endif
            <div class="form-group">
                <label class="font-weight-bold">
                    <i class="fas fa-upload mr-1"></i>Update Right Image
                </label>
                <div class="custom-file">
                    <input type="file" 
                           class="custom-file-input" 
                           name="right_image" 
                           id="right_image"
                           accept="image/*">
                    <label class="custom-file-label" for="right_image">Choose file</label>
                </div>
                <small class="form-text text-muted">
                    <i class="fas fa-info-circle mr-1"></i>
                    Perfect for seasonal campaigns
                </small>
            </div>
            <div class="form-group">
                <label>Title</label>
                <input type="text" class="form-control" name="right_title" value="{{ $rightImageBanner->title ?? '' }}">
            </div>
            <div class="form-group">
                <label>Subtitle</label>
                <input type="text" class="form-control" name="right_subtitle" value="{{ $rightImageBanner->subtitle ?? '' }}">
            </div>
        </div>
    </div>
</div>
                </div>

                <div class="row">
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary">
                            Update Banners
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- <style>
.banner-preview {
    position: relative;
    overflow: hidden;
    border-radius: 8px;
}

.banner-preview img {
    width: 100%;
    height: 200px;
    object-fit: cover;
}

.card {
    transition: all 0.3s ease;
}

.card:hover {
    transform: translateY(-5px);
}

.custom-file-label {
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
}

.card-header {
    padding: 1rem;
}

.shadow-sm {
    box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075) !important;
}

/* Responsive adjustments */
@media (max-width: 768px) {
    .banner-preview img {
        height: 150px;
    }
}
</style> -->

<script>
// Custom file input handler
$('.custom-file-input').on('change', function() {
    let fileName = $(this).val().split('\\').pop();
    $(this).next('.custom-file-label').addClass("selected").html(fileName);
});
</script>
@endsection