@extends('site.layout.app')

@php
    // Assuming $subjects is an instance of Subject model or query builder
    $query = \App\Models\College::query(); // Initialize the query builder for College model
    $books = \App\Models\Book::query(); // Initialize the query builder for Book model

    if (request()->filled('university_id')) {
        $universityIds = explode(',', request('university_id'));

        $query = $query->whereIn('university_id', $universityIds);

        $books = $books
            ->whereHas('subject', function ($subject) use ($universityIds) {
                $subject->whereHas('college', function ($college) use ($universityIds) {
                    $college->whereIn('university_id', $universityIds);
                });
            })
            ->where('is_active', 1)
            ->get();
    }

    if (request()->filled('college_id')) {
        $collegeIds = explode(',', request('college_id'));

        $query = $query->whereIn('id', $collegeIds);
    }

    // Execute the query or continue chaining methods
    $colleges = $query->where('is_active', 1)->get(); // Corrected typo from 'wehre' to 'where'

@endphp


@section('content')
    <div class="bredcrumb_inner_page">
        <div class="card-img">
            <div class="img-parent">
                <img src="{{ asset($heroImg) }}" alt="">
            </div>
            <div class="container-fluid pd-50">
                <div class="breadcrumb_content">
                    <h5>{{ __('Used Books') }}</h5>
                    <p class="col-lg-6 mx-auto">
                        {{ $app->short_description }}
                    </p>
                </div>
            </div>
        </div>

    </div>

    <!-- <div class="custom_preadcrumb">
                    <div class="container-fluid pd-50">
                        <ul class="mt-5 list-unstyled d-flex align-items-center">
                        <li><a href="">الرئيسية</a></li>
                        <li><a href="">من نحن</a></li>
                        </ul>
                    </div>
                </div> -->


    <div class="subject_details">
        <div class="container-fluid pd-50">
            <div class="row">
                <div class="col-sm-12 col-md-4 col-lg-3">
                    <div class="filter">

                        <div class="filter_header">
                            <h5>{{ __('Filter') }}</h5>
                        </div>
                        <div class="filter_body">
                            <h4 class="mt-3 ms-3">{{ __('Universities') }}</h4>
                            <div class="accordion accordion-flush" id="accordionFlushExample">
                                @foreach ($universities as $item)
                                    <ul class="list-unstyled">
                                        <li class="m-1">
                                            <input class="university-select" type="checkbox" value="{{ $item->id }}"
                                                id="university{{ $item->id }}">
                                            <label for="university{{ $item->id }}">{{ $item->name }}</label>
                                        </li>
                                    </ul>
                                @endforeach
                            </div>
                        </div>
                        <hr>
                        <div class="filter_body">
                            <h4 class="mt-3 ms-3">{{ __('colleges') }}</h4>
                            <div class="accordion accordion-flush" id="accordionFlushExample">
                                @foreach ($colleges as $item)
                                    <ul class="list-unstyled">
                                        <li class="m-1">
                                            <input class="college-select" type="checkbox" value="{{ $item->id }}"
                                                id="college{{ $item->id }}">
                                            <label for="college{{ $item->id }}">{{ $item->name }}</label>
                                        </li>
                                    </ul>
                                @endforeach
                            </div>
                        </div>
                        <hr>
                        <div class="filter_body">
                            <h4 class="mt-3 ms-3">{{ __('Subjects') }}</h4>
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
                                        <div id="flush-collapse{{ $item->id }}" class="accordion-collapse collapse"
                                            data-bs-parent="#accordionFlushExample">
                                            <div class="accordion-body">
                                                <ul class="list-unstyled">
                                                    @foreach ($item->subjects as $sub)
                                                        <li><a class="" href="#">{{ $sub->name }}</a>
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
                        <form action="{{ route('site.books.index') }}" class="d-flex align-items-center">
                            <input name="name" type="text" class="form-control search-input"
                                placeholder="مبادئ الهندسة المدنية">
                            <button>
                                <i class="fas fa-search"></i>
                                <span>{{ __('Search') }}</span>
                            </button>
                        </form>
                    </div>

                    <div class="custom_preadcrumb">
                        <ul class="mt-5 list-unstyled d-flex align-items-center">
                            <li><a href="{{ route('site.home') }}">{{ __('Home') }}</a></li>
                            <li><a href="{{ route('site.usedbooks.index') }}">{{ __('Used Books') }}</a></li>
                        </ul>
                    </div>

                    <div class="subject_cards mt-5">
                        <hr>

                        @include('site.colleges.books', ['books' => $usedBooks])
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection


@section('js')
    <script>
        $(document).ready(function() {
            // Function to check checkboxes based on query parameter
            function checkCheckboxes(className, paramName) {
                let urlParams = new URLSearchParams(window.location.search);
                if (urlParams.has(paramName)) {
                    let ids = urlParams.get(paramName).split(',');

                    // Check the checkboxes based on the query parameter
                    ids.forEach(function(id) {
                        $('#' + className + id).prop('checked', true);
                    });
                }
            }

            // Check universities on page load
            checkCheckboxes('university', 'university_id');
            // Check colleges on page load
            checkCheckboxes('college', 'college_id');

            // Event listener for university-select checkboxes
            $(document).on('click', '.university-select', function() {
                updateCheckboxQueryString('university_id', $(this).val(), $(this).prop('checked'));
            });

            // Event listener for college-select checkboxes
            $(document).on('click', '.college-select', function() {
                updateCheckboxQueryString('college_id', $(this).val(), $(this).prop('checked'));
            });

            // Function to update checkbox query string
            function updateCheckboxQueryString(paramName, itemId, isChecked) {
                let url = new URL(window.location.href);
                let params = new URLSearchParams(url.search);

                // Update or add the parameter
                if (params.has(paramName)) {
                    let currentIds = params.get(paramName).split(',');
                    if (isChecked) {
                        // Add the id if it's not already in the list
                        if (!currentIds.includes(itemId)) {
                            currentIds.push(itemId);
                        }
                    } else {
                        // Remove the id if it's unchecked
                        currentIds = currentIds.filter(id => id !== itemId);
                    }
                    params.set(paramName, currentIds.join(','));
                } else {
                    params.set(paramName, itemId);
                }

                // Construct the new URL
                let newUrl = url.origin + url.pathname + '?' + decodeURIComponent(params.toString());
                window.location.href = newUrl; // Reload the page with the new URL
            }
        });
    </script>
@endsection
