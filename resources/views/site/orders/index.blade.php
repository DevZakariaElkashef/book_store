@extends('site.layout.app')

@php
    $totalCart = optional(auth()->user()->cart)->totalCart(auth()->id());
    $taxCost = $totalCart * ($app->tax / 100);
@endphp

@section('css')
    <style>
        #map {
            height: 400px;
            width: 100%;
        }

        #ImageDiv {
            display: none;
            /* Initially hidden */
        }
    </style>
@endsection

@section('content')
    <div class="custom_preadcrumb">
        <div class="container-fluid pd-50">
            <ul class="mt-5 list-unstyled d-flex align-items-center">
                <li><a href="">الرئيسية</a></li>
                <li><a href="">الجامعات</a></li>
                <li><a href="">جامعة الملك عبد العزيز</a></li>
                <li><a href="">كلية الهندسة</a></li>
            </ul>
        </div>
    </div>



    <div class="cart_page payment_page">
        <div class="container-fluid pd-50">
            <div class="row">
                <div class="col-sm-12 col-md-12 col-lg-6">
                    <div class="cart_page_info">
                        <h5>الدفع الالكتروني</h5>
                        <p>من فضلك اختر طريقة الدفع</p>

                        <form action="{{ route('site.orders.store') }}" class="mt-5" method="POST"
                            enctype="multipart/form-data">
                            @csrf

                            <input type="hidden" name="shipping" id="shippingInput">

                            <div class="form_group">
                                <div class="bank_account">
                                    <div class="row">
                                        <div class="col-6 col-md-6 col-lg-6 col-xl-3">
                                            <label for="checkBoxBank">
                                                <input type="radio" name="banktype" required value="0"
                                                    id="checkBoxBank">

                                                <div class="bank_card">
                                                    <div class="card_icon">
                                                        <img src="{{ asset('site/assets/images/bank-1.png') }}"
                                                            alt="">
                                                    </div>
                                                    <h5>بطاقة ائتمانية</h5>
                                                </div>
                                            </label>
                                        </div>
                                        <div class="col-6 col-md-6 col-lg-6 col-xl-3">
                                            <label for="checkBoxBank1">
                                                <input type="radio" name="banktype" required value="1"
                                                    id="checkBoxBank1">
                                                <div class="bank_card">
                                                    <div class="card_icon">
                                                        <img src="{{ asset('site/assets/images/bank-2.png') }}"
                                                            alt="">
                                                    </div>
                                                    <h5>حوالة بنكية</h5>
                                                </div>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="my-2">
                                <label for="name">Name</label>
                                <input type="text" disabled name="name" class="form-control"
                                    value="{{ auth()->user()->name }}">
                            </div>

                            <div class="my-2">
                                <label for="phone">Phone</label>
                                <input type="text" disabled name="phone" class="form-control"
                                    value="{{ auth()->user()->phone }}">
                            </div>

                            <div class="my-2">
                                <label for="email">Email</label>
                                <input type="email" disabled name="email" class="form-control"
                                    value="{{ auth()->user()->email }}">
                            </div>

                            <div class="my-2">
                                <label for="city_id">City</label>
                                <select name="city_id" id="city_id" class="form-control">
                                    @foreach ($cities as $city)
                                        <option value="{{ $city->id }}"
                                            @if ($city->id == auth()->user()->city_id) selected @endif>{{ $city->name }}</option>
                                    @endforeach
                                </select>
                            </div>



                            <div class="my-2">
                                <label for="address">Address</label>
                                <textarea type="text" required name="address" class="form-control">{{ auth()->user()->address }}</textarea>
                            </div>




                            <div class="my-2">
                                <label for="note">Note</label>
                                <textarea type="text" name="note" class="form-control">{{ old('note') }}</textarea>
                            </div>

                            <div class="mt-3" id="ImageDiv">
                                <input type="file" name="transfer_image" id="">
                            </div>

                            <div id="map" style="height: 540px; margin-top: 20px;"></div>
                            <input type="hidden" id="latInput" name="lat" placeholder="Latitude" value="23.8859">
                            <input type="hidden" id="lngInput" name="lng" placeholder="Longitude" value="45.0792">



                            <div class="mt-3">
                                <button type="submit" class="btn btn-primary">Order</button>
                            </div>

                        </form>
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
                                        <span>
                                            @if (auth()->user() && auth()->user()->cart && auth()->user()->cart->items->count())
                                                {{ auth()->user()->cart->items->count() }}
                                            @else
                                                0
                                            @endif
                                        </span>
                                    </div>
                                </li>

                                <li>
                                    <span> تكلفة المنتجات</span>
                                    <div class="price d-flex align-items-center">
                                        <span>{{ $totalCart }}

                                            ر.س</span>
                                    </div>
                                </li>

                                @if ($taxCost)
                                    <li class="tax">
                                        <span> الضريبة</span>
                                        <div class="price d-flex align-items-center">
                                            <span>
                                                {{ $taxCost }} ر.س
                                            </span>
                                        </div>
                                    </li>
                                @endif


                                <li class="shippingDiv d-none">
                                    <span> الشحن </span>
                                    <div class="price d-flex align-items-center">
                                        <span id="shippingVal"></span>
                                        <span>ر.س</span>
                                    </div>
                                </li>


                                @if ($cart->coupon)
                                    <li class="discount">
                                        <span> الخصم</span>
                                        <div class="price d-flex align-items-center">
                                            <span>
                                                {{ ($totalCart + $taxCost) * ($cart->coupon->discount / 100) }} ر.س
                                            </span>
                                        </div>
                                    </li>
                                @endif

                                <li>
                                    <span> التكلفة الاجمالية</span>
                                    <div class="price d-flex align-items-center">
                                        <span>
                                            @if ($cart->coupon)
                                                {{ $totalCart + $taxCost - ($totalCart + $taxCost) * ($cart->coupon->discount / 100) }}
                                            @else
                                                {{ $totalCart + $taxCost }}
                                            @endif
                                            ر.س
                                        </span>
                                    </div>
                                </li>

                            </ul>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection


@section('js')
    <script src="https://maps.googleapis.com/maps/api/js?callback=initMap" async defer></script>
    <script>
        function initMap() {
            // Coordinates for Saudi Arabia
            const saudiArabia = {
                lat: 23.8859,
                lng: 45.0792
            };

            const map = new google.maps.Map(document.getElementById("map"), {
                center: saudiArabia,
                zoom: 6,
            });

            const marker = new google.maps.Marker({
                position: saudiArabia,
                map: map,
                draggable: true,
            });

            // Update inputs on marker drag
            marker.addListener('dragend', function() {
                const lat = marker.getPosition().lat();
                const lng = marker.getPosition().lng();
                document.getElementById('latInput').value = lat;
                document.getElementById('lngInput').value = lng;
            });

            // Update inputs on map click
            map.addListener('click', function(event) {
                marker.setPosition(event.latLng);
                document.getElementById('latInput').value = event.latLng.lat();
                document.getElementById('lngInput').value = event.latLng.lng();

                updateShipping(event.latLng.lat(), event.latLng.lng());
            });
        }


        function updateShipping(lat, lng) {
            $.ajax({
                type: "get",
                url: "/calc-shipping",
                data: {
                    lat: lat,
                    lng: lng
                },
                success: function(response) {
                    if (response.status) {
                        if (response.shipping > 0) {
                            $('.shippingDiv').removeClass('d-none');
                            $('#shippingInput').val(response.shipping);
                        } else {
                            $('.shippingDiv').addClass('d-none');
                        }

                        // Recalculate total and discount
                        const totalCart = parseFloat('{{ $totalCart }}');
                        const taxCost = parseFloat('{{ $taxCost }}');
                        const shippingCost = response.shipping;

                        let discount = 0;
                        let grandTotal = totalCart + taxCost + shippingCost;

                        @if ($cart->coupon)
                            discount = grandTotal * (parseFloat('{{ $cart->coupon->discount }}') / 100);
                            grandTotal -= discount;
                        @endif

                        // Update discount and total in the DOM
                        if (discount > 0) {
                            $('.discount span:last-child').text(discount.toFixed(2) + ' ر.س');
                        }

                        $('.tax span:last-child').text(taxCost.toFixed(2) + ' ر.س');
                        $('.shippingDiv span:last-child').text(shippingCost.toFixed(2) + ' ر.س');
                        $('.card_info .price span:last-child').last().text(grandTotal.toFixed(2) + ' ر.س');
                    } else {
                        alert(response.message);
                    }
                }
            });
        }
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const checkBoxBank = document.getElementById('checkBoxBank');
            const checkBoxBank1 = document.getElementById('checkBoxBank1');
            const imageDiv = document.getElementById('ImageDiv');

            checkBoxBank.addEventListener('change', function() {
                if (this.checked) {
                    imageDiv.style.display = 'none';
                }
            });

            checkBoxBank1.addEventListener('change', function() {
                if (this.checked) {
                    imageDiv.style.display = 'block';
                }
            });

            // Optional: Ensure the correct state is set on page load
            if (checkBoxBank.checked) {
                imageDiv.style.display = 'none';
            } else if (checkBoxBank1.checked) {
                imageDiv.style.display = 'block';
            }
        });
    </script>
@endsection
