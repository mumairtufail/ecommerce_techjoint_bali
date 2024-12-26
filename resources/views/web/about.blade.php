@extends('web.layout.app')
@section('content')

<!-- start wpo-page-title -->
   <section class="wpo-page-title">
            <div class="container">
                <div class="row">
                    <div class="col col-xs-12">
                        <div class="wpo-breadcumb-wrap">
                            <h2>about us</h2>
                            <ol class="wpo-breadcumb-wrap">
                                <li><a href="index.html">Home</a></li>
                                <li>about</li>
                            </ol>
                        </div>
                    </div>
                </div> <!-- end row -->
            </div> <!-- end container -->
        </section>
        <!-- end page-title -->

        <!-- start of pengu-about-section-->
        <section class="pengu-about-section pengu-about-section-s2 section-padding">
            <div class="about-top-title">
                <h1>Well-know Brands</h1>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="about-wrap">
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                                Sit vitae viverra tellus vulputate. Ante integer mattis viverra fringilla quis eleifend
                                imperdiet.
                                Tristique praesent sed in neque porta imperdiet vitae,
                                tincidunt magna. Massa adipiscing tincidunt eget eros nunc ante sed sit pulvinar.</p>
                            <a class="about-btn" href="about.html">
                                <div class="about-bg">
                                    <img src="assets/images/about-bg.png" alt="">
                                </div>
                                <span>Our <br> Story</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="about-bottom-title">
                <h1>Best Collection</h1>
            </div>
        </section>
        <!-- end of pengu-about-section-->

        @endsection