@extends('site.layout.app')

@section('content')
    <div class="bredcrumb_inner_page">
        <div class="card-img">
            <div class="img-parent">
                <img src="{{ asset('site/assets/images/bredcrumb.png') }}" alt="">
            </div>
            <div class="container-fluid pd-50">
                <div class="breadcrumb_content">
                    <h5>{{ __("colleges") }}</h5>
                    <p class="col-lg-6 mx-auto">
                        {{ $app->short_description }}
                    </p>
                </div>
            </div>
        </div>

    </div>


    <div class="subject_details">
        <div class="container-fluid pd-50">
            <div class="row">
                <div class="col-sm-12 col-md-4 col-lg-3">
                    <div class="filter">
                        <div class="filter_header">
                            <h5>{{ __("Filter") }}</h5>
                        </div>
                        <div class="filter_body">
                            <h4 class="mt-3 ms-3">{{ __("Subjects") }}</h4>
                            <div class="accordion accordion-flush" id="accordionFlushExample">
                                @foreach ($colleges as $item)
                                    <div class="accordion-item">
                                        <h2 class="accordion-header">
                                            <button class="accordion-button collapsed" type="button"
                                                data-bs-toggle="collapse"
                                                data-bs-target="#flush-collapse{{ $item->id }}" aria-expanded="false"
                                                aria-controls="flush-collapse{{ $item->id }}">
                                                {{ $item->name }}
                                            </button>
                                        </h2>
                                        <div id="flush-collapse{{ $item->id }}"
                                            class="accordion-collapse collapse @if ($subject && $subject->college_id == $item->id) show @endif"
                                            data-bs-parent="#accordionFlushExample">
                                            <div class="accordion-body">
                                                <ul class="list-unstyled">
                                                    @foreach ($item->subjects as $sub)
                                                        <li><a class="@if ($subject && $subject->id == $sub->id) text-primary @endif"
                                                                href="{{ route('site.colleges.show', ['id' => $item->id, 'subject' => $sub->id]) }}">{{ $sub->name }}</a>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-md-8 col-lg-9">
                    <div class="subject_details_search">
                        @if ($subject)
                            <h5>{{ $subject->name }}</h5>
                        @endif
                        <form action="{{ route('site.books.index') }}" class="d-flex align-items-center">
                            <input type="text" name="name" class="form-control search-input" placeholder="مبادئ الهندسة المدنية">
                            <button>
                                <i class="fas fa-search"></i>
                                <span>{{ __("Search") }}</span>
                            </button>
                        </form>
                    </div>

                    <div class="custom_preadcrumb">
                        <ul class="mt-5 list-unstyled d-flex align-items-center">
                            <li><a href="{{ route('site.home') }}">{{ __("Home") }}</a></li>
                            <li><a href="{{ route('site.universites.index') }}">{{ __("Universities") }}</a></li>
                            <li><a
                                    href="{{ route('site.universites.show', $college->university->id) }}">{{ $college->university->name }}</a>
                            </li>
                        </ul>
                    </div>

                    <div class="subject_cards mt-5">
                        <h5>{{ $college->name }}</h5>
                        <hr>

                        @include('site.colleges.books')
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
