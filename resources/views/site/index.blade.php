@extends('site.layout.app')

@section('title')
    {{ __('Home') }}
@endsection

@section('content')
    <div class="bredcrumb_inner_page home_bredcrumb_inner_page">
        <div class="card-img">
            <div class="img-parent">
                <img src="{{ asset($heroImg) }}" alt="">
            </div>
            <div class="container-fluid pd-50">
                <div class="breadcrumb_content">
                    <h5>{{ $app->name }}</h5>
                    <p class="col-lg-6 mx-auto">
                        {{ $app->short_description }}
                    </p>
                </div>
                <div class="search_wrapper">
                    <form action="{{ route('site.books.index') }}" method="GET">
                        <div class="row align-items-end">
                            <div class="col-sm-12 col-md-6 col-lg-3">
                                <div class="form-group">
                                    <label for="">{{ __('Book name') }}</label>
                                    <input name="name" type="text" class="form-control" placeholder="العلم و الايمان">
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6 col-lg-2">
                                <div class="form-group">
                                    <label for="universitySelect">{{ __('University') }}</label>
                                    <select name="university_id" class="form-control" id="universitySelect">
                                        <option selected disabled>{{ __('select One') }}</option>
                                        @foreach ($universites as $university)
                                            <option value="{{ $university->id }}">{{ $university->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-sm-12 col-md-6 col-lg-2">
                                <div class="form-group">
                                    <label for="collegeSelect">{{ __('College') }}</label>
                                    <select name="college_id" class="form-control" id="collegeSelect">
                                        <option selected disabled>{{ __('select One') }}</option>
                                        @foreach ($colleges as $college)
                                            <option value="{{ $college->id }}">{{ $college->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6 col-lg-2">
                                <div class="form-group">
                                    <label for="subjectSelect">{{ __('Subject') }}</label>
                                    <select name="subject_id" class="form-control" id="subjectSelect">
                                        <option selected disabled>{{ __('select One') }}</option>
                                        @foreach ($subjects as $subject)
                                            <option value="{{ $subject->id }}">{{ $subject->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-sm-12 col-md-12 col-lg-2">
                                <button type="submit">
                                    <i class="fa fa-search"></i>
                                    <span>{{ __('Search') }}</span>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>


    <div class="choose_books_type">
        <div class="container-fluid pd-50">
            <div class="section_header d-flex align-items-center justify-content-center">
                <img src="site/assets/images/book2.svg" alt="">
                <h5 class="ms-2 mt-1">{{ __('Choose the type of books') }} </h5>
            </div>
            <div class="row">
                <div class="col-sm-12 col-md-12 col-lg-6 mt-2">
                    <div class="book_type d-flex align-items-center">
                        <div class="card_icon">
                            <img src="site/assets/images/type-1.svg" alt="">
                        </div>
                        <div class="card-body">
                            <h5>{{ __('Universities') }}</h5>
                            <p>
                                {{ $app->short_description }}
                            </p>
                            <a href="{{ route('site.universites.index') }}">
                                {{ __('Shop now') }}
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-md-12 col-lg-6 mt-2">
                    <div class="book_type d-flex align-items-center">
                        <div class="card_icon">
                            <img src="site/assets/images/type-2.svg" alt="">
                        </div>
                        <div class="card-body">
                            <h5>{{ __('Used Books') }}</h5>
                            <p>
                                {{ $app->short_description }}
                            </p>
                            <a href="{{ route('site.usedbooks.index') }}">
                                {{ __('Shop now') }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    @if ($latestBooks->count())
        <div class="section_for_books">
            <div class="container-fluid pd-50">
                <div class="section_header d-flex align-items-center justify-content-between">
                    <div class="wrap d-flex align-items-center">
                        <img src="site/assets/images/book2.svg" alt="">
                        <h5 class="ms-2 mt-1">{{ __('Latest products') }}</h5>
                    </div>
                    <a href="{{ route('site.books.index', ['sort' => 'latest']) }}">{{ __('see more') }}</a>
                </div>
                <div class="row">
                    @foreach ($latestBooks as $book)
                        <div class="col-6 col-md-6 col-lg-6 col-xl-4">
                            <div class="product_card d-flex align-items-start">
                                <div class="card-img">
                                    <div class="like active_like">

                                        <a href="{{ route('site.favourite.toggle', ['book_id' => $book->id]) }}">
                                            @if (hasFavourite(auth()->user(), $book->id))
                                                <i class="fa-solid fa-heart"></i>
                                            @else
                                                <i class="fa-regular fa-heart"></i>
                                            @endif
                                        </a>
                                    </div>
                                    <div class="img-parent">
                                        <img src="{{ asset($book->image) }}" alt="">
                                    </div>
                                </div>
                                <div class="card-body ms-3">
                                    <h5>{{ $book->name }}</h5>
                                    <p>{{ Str::limit($book->description, $strLimit) }}</p>
                                    <span class="price">{{ $book->price }} <span> {{ __('sar') }}</span></span>
                                    <div class="options">
                                        <a href="#" data-bs-toggle="modal" data-bs-target="#modaAddAdress"
                                            data-id="{{ $book->id }}" data-count="{{ bookCartCount($book->id) }}"
                                            data-image="{{ asset($book->image) }}"
                                            class="d-inline-flex align-items-center add-to-cart-btn">

                                            <i class="fa-solid fa-cart-shopping"></i>
                                            <span>{{ __('Add to cart') }}</span>
                                        </a>
                                        <a href="#">
                                            <i class="far fa-eye"> </i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach

                </div>
            </div>
        </div>
    @endif


    <div class="section_for_books most_seller">
        <div class="container-fluid pd-50">
            <div class="section_header d-flex align-items-center justify-content-between">
                <div class="wrap d-flex align-items-center">
                    <img src="site/assets/images/book2.svg" alt="">
                    <h5 class="ms-2 mt-1">{{ __('best seller') }}</h5>
                </div>
                <a href="{{ route('site.books.index', ['sort' => 'most-saled']) }}">{{ __('see more') }}</a>
            </div>
            <div class="row">

                @foreach ($mostSaledBooks as $book)
                    <div class="col-6 col-md-6 col-lg-6 col-xl-4">
                        <div class="product_card d-flex align-items-start">
                            <div class="card-img">
                                <div class="like active_like">

                                    <a href="{{ route('site.favourite.toggle', ['book_id' => $book->id]) }}">
                                        @if (hasFavourite(auth()->user(), $book->id))
                                            <i class="fa-solid fa-heart"></i>
                                        @else
                                            <i class="fa-regular fa-heart"></i>
                                        @endif
                                    </a>
                                </div>
                                <div class="img-parent">
                                    <img src="{{ asset($book->image) }}" alt="">
                                </div>
                            </div>
                            <div class="card-body ms-3">
                                <h5>{{ $book->name }}</h5>
                                <p>{{ Str::limit($book->description, $strLimit) }}</p>
                                <span class="price">{{ $book->price }} <span> {{ __('SAR') }}</span></span>
                                <div class="options">
                                    <a href="#" data-bs-toggle="modal" data-bs-target="#modaAddAdress"
                                        data-id="{{ $book->id }}" data-count="{{ bookCartCount($book->id) }}"
                                        data-image="{{ asset($book->image) }}"
                                        class="d-inline-flex align-items-center add-to-cart-btn">

                                        <i class="fa-solid fa-cart-shopping"></i>
                                        <span>{{ __('Add to cart') }}</span>
                                    </a>
                                    <a href="#">
                                        <i class="far fa-eye"> </i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    </div>

    @if ($offerBooks->count())
        <div class="section_for_books" style="background-image: url('{{ asset($offerImg) }}')">
            <div class="container-fluid pd-50">
                <div class="section_header d-flex align-items-center justify-content-between">
                    <div class="wrap d-flex align-items-center">
                        <img src="site/assets/images/book2.svg" alt="">
                        <h5 class="ms-2 mt-1">{{ __('Offers and discounts') }}</h5>
                    </div>
                    <a href="{{ route('site.books.offers') }}">{{ __('see more') }}</a>
                </div>
                <div class="row">
                    @foreach ($offerBooks as $book)
                        <div class="col-6 col-md-6 col-lg-6 col-xl-4">
                            <div class="product_card d-flex align-items-start">
                                <div class="card-img">
                                    <div class="like active_like">
                                        <i class="fas fa-heart"></i>
                                        <i class="far fa-heart"></i>
                                    </div>
                                    <div class="img-parent">
                                        <img src="{{ asset($book->image) }}" alt="">
                                    </div>
                                </div>
                                <div class="card-body ms-3">
                                    <h5>{{ $book->name }}</h5>
                                    <p> {{ Str::limit($book->description, $strLimit) }} </p>
                                    <span class="price">{{ $book->price }} <span> {{ __('SAR') }}</span></span>
                                    <div class="options">
                                        <a href="" class="d-inline-flex align-items-center">
                                            <i class="fa-solid fa-cart-shopping"></i>
                                            <span>{{ __('Add to cart') }}</span>
                                        </a>
                                        <a href="" data-bs-toggle="modal" data-bs-target="#modaAddAdress">
                                            <i class="far fa-eye"> </i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    @endif


    <div class="contact_us home_contact_us"
        style="background-image: url({{ asset('site/assets/images/contact-bg.png') }});">
        <div class="container-fluid pd-50">
            <div class="row align-items-center">
                <div class="col-sm-12 col-md-12 col-lg-7">
                    <div class="contact_us_conent">
                        <h5 class="head">{{ __('Connect with us') }}</h5>
                        <p class="col-lg-6">
                            {{ $app->short_description }}
                        </p>
                        <div class="contact_icons">
                            <ul class="list-unstyled d-flex">
                                <li>
                                    <a class="icon">
                                        <div class="wrp">
                                            <i class="fas fa-phone-alt"></i>
                                        </div>
                                        <span href="">{{ $app->phone }}</span>
                                    </a>
                                </li>
                                <li>
                                    <a class="icon">
                                        <div class="wrp">
                                            <i class="fas fa-envelope"></i>
                                        </div>
                                        <span href="">{{ $app->email }}</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div class="contact_form">
                            <form action="{{ route('site.contacts.store') }}" method="post">
                                @csrf
                                <div class="row">
                                    <div class="col-sm-12 col-md-6 col-lg-6">
                                        <div class="form-group">
                                            <label for="name">{{ __('user name') }}</label>
                                            <input type="text" class="form-control" name="name" id="name"
                                                placeholder="مروان ابراهيم">
                                            @error('name')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-sm-12 col-md-6 col-lg-6">
                                        <div class="form-group">
                                            <label for="email">{{ __('Email') }}</label>
                                            <input type="text" name="email" id="email" class="form-control"
                                                placeholder="966 055 356757">
                                            @error('email')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>


                                    <div class="col-sm-12 col-md-12 col-lg-12">
                                        <div class="form-group">
                                            <label for="contact_type_id">{{ __('Subject') }}</label>
                                            <select name="contact_type_id" id="contact_type_id" class="form-control">
                                                @foreach ($contactTypes as $type)
                                                    <option value="{{ $type->id }}">{{ $type->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-sm-12 col-md-12 col-lg-12">
                                        <div class="form-group">
                                            <textarea name="message" class="form-control" placeholder="" id="" cols="30" rows="10"></textarea>
                                            @error('message')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-sm-12 col-md-12 col-lg-12">
                                        <div class="btn_submit">
                                            <button class="btn" type="submit">{{ __('Send') }}</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-md-12 col-lg-5">
                    <div class="contact_img text-center mt-4">
                        <img src="{{ asset($contactUsImg) }}" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="adress_modal">
        <!-- Button trigger modal -->
        <!-- Modal -->
        <div class="modal fade moda_map" id="modaAddAdress" tabindex="-1" aria-labelledby="modaAddAdressLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-body">

                        <div class="close" type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                            <i class="fas fa-times-circle"></i>
                        </div>

                        <div class="section_header text-center">
                            <h5>{{ __('Add product to cart') }}</h5>
                        </div>
                        <div class=" col-lg-6 mx-auto">
                            <div class="">
                                <form action="{{ route('carts.store') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="id" class="inputId">
                                    <div class="product_card">
                                        <div class="card-img">
                                            <div class="img-parent">
                                                <img class="image-cart-modal" alt="">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="buy_basket">
                                        <div class="form-group">
                                            <span class="numbutton input-number-increment"
                                                data-bind="click: increment">+</span>
                                            <input type="number" class="form-control numinput" id="num1"
                                                value="1" min="0" name="count">
                                            <span class="numbutton input-number-decrement"
                                                data-bind="click: decrement">-</span>
                                        </div>
                                    </div>


                                    <div class="options mt-5">
                                        <button type="submit"
                                            class="btn btn-primary confirm-add-to-cart">{{ __('confirm') }}</button>
                                        <button type="button" class="btn btn-secondary">{{ __('Cancle') }}</a>
                                    </div>
                                </form>
                            </div>

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection


@section('js')
    <script>
        $(document).on('click', '.add-to-cart-btn', function() {
            $('.image-cart-modal').attr('src', $(this).data('image'));
            $('.numinput').val($(this).data('count'));
            $('.inputId').val($(this).data('id'));
        });
    </script>

    {{-- universitySelect - collegeSelect - subjectSelect --}}
    <script>
        $(document).on('change', '#universitySelect', function() {
            let universityId = $(this).val();
            let url = '{{ route('colleges.getColleges') }}';


            $.ajax({
                type: "GET",
                url: url,
                data: {
                    univirsityId: universityId
                },
                success: function(response) {
                    $('#collegeSelect').html(response);
                }
            });
        });


        $(document).on('change', '#collegeSelect', function() {
            let collegeId = $(this).val();
            let url = '{{ route('subjects.getSubjects') }}';


            $.ajax({
                type: "GET",
                url: url,
                data: {
                    collegeId: collegeId
                },
                success: function(response) {
                    $('#subjectSelect').html(response);
                }
            });
        });
    </script>
@endsection
