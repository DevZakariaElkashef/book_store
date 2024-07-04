@extends('site.layout.app')
@section('content')
    <div class="bredcrumb_inner_page">
        <div class="card-img">
            <div class="img-parent">
                <img src="{{ asset($heroImg) }}" alt="">
            </div>
            <div class="container-fluid pd-50">
                <div class="breadcrumb_content">
                    <h5>{{ $university->name }}</h5>
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
                <li><a href="{{ route("site.home") }}">{{ __("Home") }}</a></li>
                <li><a href="{{ route("site.universites.index") }}">{{ __("Universities") }}</a></li>
                <li><a href="{{ route("site.universites.show", $university->id) }}">{{ $university->name }}</a></li>
            </ul>
        </div>
    </div>



    <div class="university-details pt-5">
        <div class="container-fluid pd-50">
            <ul class="list-unstyled">
                @forelse ($colleges as $college)
                <li class="mb-4">
                    <a href="{{ route('site.colleges.show', $college->id) }}" class="d-flex align-items-center">
                        <img src="{{ asset('site/assets/images/book.svg') }}" alt="">
                        <h5 class="mb-0 text-black ms-2">{{ $college->name }}</h5>
                    </a>
                </li>
                @empty
                <li class="mb-4 text-center">
                    {{ __("No Colleges Yet !") }}
                </li>
                @endforelse



            </ul>
        </div>
    </div>
@endsection
