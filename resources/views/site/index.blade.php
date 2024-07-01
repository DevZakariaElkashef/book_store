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
                    <form action="">
                        <div class="row align-items-end">
                            <div class="col-sm-12 col-md-6 col-lg-3">
                                <div class="form-group">
                                    <label for="">أسم الكتاب</label>
                                    <input type="text" class="form-control" placeholder="العلم و الايمان">
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6 col-lg-2">
                                <div class="form-group">
                                    <label for="">قسم الكتاب</label>
                                    <input type="text" class="form-control" placeholder="العلوم الاسلامية">
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6 col-lg-2">
                                <div class="form-group">
                                    <label for="">أسم المؤلف</label>
                                    <input type="text" class="form-control" placeholder="مصطفي محمود">
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6 col-lg-2">
                                <div class="form-group">
                                    <label for="">أسم الجامعة</label>
                                    <input type="text" class="form-control" placeholder=" جامعة الملك فهد">
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-12 col-lg-2">
                                <button>
                                    <i class="fa fa-search"></i>
                                    <span>بحث</span>
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
                <h5 class="ms-2 mt-1">أختر نوع الكتب </h5>
            </div>
            <div class="row">
                <div class="col-sm-12 col-md-12 col-lg-6 mt-2">
                    <div class="book_type d-flex align-items-center">
                        <div class="card_icon">
                            <img src="site/assets/images/type-1.svg" alt="">
                        </div>
                        <div class="card-body">
                            <h5>الجامعات</h5>
                            <p>
                                “لوريم ايبسوم دولار سيت أميت ,كونسيكتيتور أدايبا يسكينج أليايت,سيت دو أيوسمود تيمبور
                            </p>
                            <a href="{{ route('site.universites.index') }}">
                                تسوق الان
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
                            <h5>{{ __('used books') }}</h5>
                            <p>
                                “لوريم ايبسوم دولار سيت أميت ,كونسيكتيتور أدايبا يسكينج أليايت,سيت دو أيوسمود تيمبور
                            </p>
                            <a href="{{ route('site.usedbooks.index') }}">
                                تسوق الان
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
                        <h5 class="ms-2 mt-1">أحدث المنتجات</h5>
                    </div>
                    <a href="{{ route('site.books.index', ['sort' => 'latest']) }}">مشاهدة المزيد</a>
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
                                    <span class="price">{{ $book->price }} <span> {{ __('SAR') }}</span></span>
                                    <div class="options">
                                        <a href="#" data-bs-toggle="modal" data-bs-target="#modaAddAdress"
                                            data-id="{{ $book->id }}" data-count="{{ bookCartCount($book->id) }}"
                                            data-image="{{ asset($book->image) }}"
                                            class="d-inline-flex align-items-center add-to-cart-btn">

                                            <i class="fa-solid fa-cart-shopping"></i>
                                            <span>إضافة للسلة</span>
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
                    <h5 class="ms-2 mt-1">الأكثر مبيعا</h5>
                </div>
                <a href="">مشاهدة المزيد</a>
            </div>
            <div class="row">
                <div class="col-6 col-md-6 col-lg-6 col-xl-4">
                    <div class="product_card d-flex align-items-start">
                        <div class="card-img">
                            <div class="like active_like">
                                <i class="fas fa-heart"></i>
                                <i class="far fa-heart"></i>
                            </div>
                            <div class="img-parent">
                                <img src="site/assets/images/book-1.png" alt="">
                            </div>
                        </div>
                        <div class="card-body ms-3">
                            <h5>أسم الكتاب</h5>
                            <p> دولار سيت أميت ,كونسيكتيتور أدايبا دولار سيت أميت ,كونسيكتيتور أدايبا </p>
                            <span class="price">100 <span> ر.س</span></span>
                            <div class="options">
                                <a href="" class="d-inline-flex align-items-center">
                                    <i class="fa-solid fa-cart-shopping"></i>
                                    <span>إضافة للسلة</span>
                                </a>
                                <a href="">
                                    <i class="far fa-eye"> </i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-6 col-md-6 col-lg-6 col-xl-4">
                    <div class="product_card d-flex align-items-start">
                        <div class="card-img">
                            <div class="like active_like">
                                <i class="fas fa-heart"></i>
                                <i class="far fa-heart"></i>
                            </div>
                            <div class="img-parent">
                                <img src="site/assets/images/book-1.png" alt="">
                            </div>
                        </div>
                        <div class="card-body ms-3">
                            <h5>أسم الكتاب</h5>
                            <p> دولار سيت أميت ,كونسيكتيتور أدايبا دولار سيت أميت ,كونسيكتيتور أدايبا </p>
                            <span class="price">100 <span> ر.س</span></span>
                            <div class="options">
                                <a href="" class="d-inline-flex align-items-center">
                                    <i class="fa-solid fa-cart-shopping"></i>
                                    <span>إضافة للسلة</span>
                                </a>
                                <a href="">
                                    <i class="far fa-eye"> </i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-6 col-md-6 col-lg-6 col-xl-4">
                    <div class="product_card d-flex align-items-start">
                        <div class="card-img">
                            <div class="like active_like">
                                <i class="fas fa-heart"></i>
                                <i class="far fa-heart"></i>
                            </div>
                            <div class="img-parent">
                                <img src="site/assets/images/book-1.png" alt="">
                            </div>
                        </div>
                        <div class="card-body ms-3">
                            <h5>أسم الكتاب</h5>
                            <p> دولار سيت أميت ,كونسيكتيتور أدايبا دولار سيت أميت ,كونسيكتيتور أدايبا </p>
                            <span class="price">100 <span> ر.س</span></span>
                            <div class="options">
                                <a href="" class="d-inline-flex align-items-center">
                                    <i class="fa-solid fa-cart-shopping"></i>
                                    <span>إضافة للسلة</span>
                                </a>
                                <a href="">
                                    <i class="far fa-eye"> </i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-6 col-md-6 col-lg-6 col-xl-4">
                    <div class="product_card d-flex align-items-start">
                        <div class="card-img">
                            <div class="like active_like">
                                <i class="fas fa-heart"></i>
                                <i class="far fa-heart"></i>
                            </div>
                            <div class="img-parent">
                                <img src="site/assets/images/book-1.png" alt="">
                            </div>
                        </div>
                        <div class="card-body ms-3">
                            <h5>أسم الكتاب</h5>
                            <p> دولار سيت أميت ,كونسيكتيتور أدايبا دولار سيت أميت ,كونسيكتيتور أدايبا </p>
                            <span class="price">100 <span> ر.س</span></span>
                            <div class="options">
                                <a href="" class="d-inline-flex align-items-center">
                                    <i class="fa-solid fa-cart-shopping"></i>
                                    <span>إضافة للسلة</span>
                                </a>
                                <a href="">
                                    <i class="far fa-eye"> </i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-6 col-md-6 col-lg-6 col-xl-4">
                    <div class="product_card d-flex align-items-start">
                        <div class="card-img">
                            <div class="like active_like">
                                <i class="fas fa-heart"></i>
                                <i class="far fa-heart"></i>
                            </div>
                            <div class="img-parent">
                                <img src="site/assets/images/book-1.png" alt="">
                            </div>
                        </div>
                        <div class="card-body ms-3">
                            <h5>أسم الكتاب</h5>
                            <p> دولار سيت أميت ,كونسيكتيتور أدايبا دولار سيت أميت ,كونسيكتيتور أدايبا </p>
                            <span class="price">100 <span> ر.س</span></span>
                            <div class="options">
                                <a href="" class="d-inline-flex align-items-center">
                                    <i class="fa-solid fa-cart-shopping"></i>
                                    <span>إضافة للسلة</span>
                                </a>
                                <a href="">
                                    <i class="far fa-eye"> </i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-6 col-md-6 col-lg-6 col-xl-4">
                    <div class="product_card d-flex align-items-start">
                        <div class="card-img">
                            <div class="like active_like">
                                <i class="fas fa-heart"></i>
                                <i class="far fa-heart"></i>
                            </div>
                            <div class="img-parent">
                                <img src="site/assets/images/book-1.png" alt="">
                            </div>
                        </div>
                        <div class="card-body ms-3">
                            <h5>أسم الكتاب</h5>
                            <p> دولار سيت أميت ,كونسيكتيتور أدايبا دولار سيت أميت ,كونسيكتيتور أدايبا </p>
                            <span class="price">100 <span> ر.س</span></span>
                            <div class="options">
                                <a href="" class="d-inline-flex align-items-center">
                                    <i class="fa-solid fa-cart-shopping"></i>
                                    <span>إضافة للسلة</span>
                                </a>
                                <a href="">
                                    <i class="far fa-eye"> </i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if ($offerBooks->count())
        <div class="section_for_books home_offers">
            <div class="container-fluid pd-50">
                <div class="section_header d-flex align-items-center justify-content-between">
                    <div class="wrap d-flex align-items-center">
                        <img src="site/assets/images/book2.svg" alt="">
                        <h5 class="ms-2 mt-1">العروض</h5>
                    </div>
                    <a href="{{ route('site.books.offers') }}">مشاهدة المزيد</a>
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
                                            <span>إضافة للسلة</span>
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
                        <h5 class="head">اتصل بنا</h5>
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
                                            <label for="name">أسم المستخدم</label>
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
                                            <label for="contact_type_id">الموضوع</label>
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
                                            <button class="btn" type="submit">ارسال</button>
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
                            <h5>إضافة المنتج للسلة</h5>
                        </div>
                        <div class=" col-lg-6 mx-auto">
                            <div class="">
                                <form action="{{ route("carts.store") }}" method="POST">
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
                                        <button type="submit" class="confirm-add-to-cart">تأكيد</button>
                                        <a href="">الغاء</a>
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
@endsection
