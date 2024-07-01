@extends('site.layout.app')

@section('content')
    <div class="custom_preadcrumb">
        <div class="container-fluid pd-50">
            <ul class="mt-5 list-unstyled d-flex align-items-center">
                <li><a href="{{ route('site.home') }}">الرئيسية</a></li>
                <li><a href="{{ route('carts.index') }}">{{ __('Cart') }}</a></li>
            </ul>
        </div>
    </div>



    <div class="cart_page">
        <div class="container-fluid pd-50">
            <div class="row">
                <div class="col-sm-12 col-md-12 col-lg-6">
                    <div class="cart_page_info">

                        @foreach ($cart->items as $item)
                            <div class="product_card_wide d-flex">
                                <div class="add_to_card">
                                    <img src="{{ asset('site/assets/images/delete.svg') }}" alt="">
                                </div>
                                <div class="card-img">
                                    <div class="img-parent">
                                        <img src="{{ asset($item->book->image) }}" alt="">
                                    </div>
                                </div>
                                <div class="card_body">
                                    <h5>{{ $book->name }}</h5>
                                    @if(in)
                                    <span class="price">100 ر.س</span> <span class="discount">120 ر.س</span>
                                    <div class="buy_basket">
                                        <form>
                                            <div class="form-group">
                                                <span class="numbutton input-number-increment"
                                                    data-bind="click: increment">+</span>
                                                <input type="number" class="form-control numinput" id="num1"
                                                    value="1" min="0">
                                                <span class="numbutton input-number-decrement"
                                                    data-bind="click: decrement">-</span>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <hr>
                        @endforeach

                    </div>

                </div>
                <div class="col-sm-12 col-md-12 col-lg-6">
                    <div class="buy_basket">
                        <div class="card_header">
                            <h5>سلة المشتريات</h5>
                        </div>
                        <div class="card_info">
                            <ul class="list-unstyled">

                                <li>
                                    <span> عدد المنتجات</span>
                                    <div class="price d-flex align-items-center">
                                        <span>3</span>
                                    </div>
                                </li>

                                <li>
                                    <span> تكلفة المنتجات</span>
                                    <div class="price d-flex align-items-center">
                                        <span>800 000 ر.س</span>
                                    </div>
                                </li>


                                <li class="discount">
                                    <span> الخصم</span>
                                    <div class="price d-flex align-items-center">
                                        <span>800 000 ر.س</span>
                                    </div>
                                </li>


                                <li>
                                    <span> التكلفة الاجمالية</span>
                                    <div class="price d-flex align-items-center">
                                        <span>800 000 ر.س</span>
                                    </div>
                                </li>

                            </ul>

                            <div class="byu_btn">
                                <a href="">إتمام الطلب</a>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
