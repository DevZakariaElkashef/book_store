@extends('site.layout.app')

@section('content')
    <div class="bredcrumb_inner_page">
        <div class="card-img">
            <div class="img-parent">
                <img src="{{ asset($heroImg) }}" alt="">
            </div>
            <div class="container-fluid pd-50">
                <div class="breadcrumb_content">
                    <h5>{{ __("About Us") }}</h5>
                    <p class="col-lg-6 mx-auto">
                        {{ $app->short_description }}
                    </p>
                </div>
            </div>
        </div>

    </div>

    <div class="custom_preadcrumb">
        <div class="container-fluid pd-50">
            <ul class="mt-5 list-unstyled d-flex align-items-center">
                <li><a href="{{ route('site.home') }}">{{ __("Home") }}</a></li>
                <li><a href="{{ route('site.aboutus.index') }}">{{ __("About Us") }}</a></li>
            </ul>
        </div>
    </div>


    <div class="who_us_section">
        <div class="container-fluid pd-50">
            <div class="section_header d-flex align-items-center">
                <img src="{{ asset('site/assets/images/book2.svg') }}" alt="">
                <h2>{{ __("About Us") }}</h2>
            </div>
            @foreach ($abouts as $about)
                <div class="row align-items-center mt-3">
                    <div class="col-sm-12 col-md-6 col-lg-6">
                        <div class="who_us_section_content">

                            <div class="card_text col-lg-11 col-lg-9">
                                <p>
                                    {{ $about->content }}
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-6 col-lg-6">
                        <div class="about_img">
                            <div class="card-img">
                                <div class="img-parent">
                                    <img src="{{ asset($about->image) }}" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
