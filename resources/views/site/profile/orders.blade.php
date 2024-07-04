@extends('site.layout.app')

@section('css')
    <style>
        .card_header,
        .card_options {
            cursor: pointer;
        }
    </style>
@endsection

@section('content')
    <div class="custom_preadcrumb">
        <div class="container-fluid pd-50">
            <ul class="mt-5 list-unstyled d-flex align-items-center">
                <li><a href="{{ route('site.home') }}">{{ __("Home") }}</a></li>
                <li><a href="{{ route('site.profile.index') }}">{{ __('Personal profile') }}</a></li>
            </ul>
        </div>
    </div>


    <div class="main-content home-main-content myaccount-profile ">
        <div class="wrapper">
            <div class="container-fluid pd-50">
                <div class="profile-page">
                    <div class="wrapper">
                        <div class="container">
                            <div class="open-profile-sidebar">
                                <i class="fas fa-bars"></i>
                            </div>
                        </div>
                        <div class="">
                            <div class="row">
                                @include('site.profile._nav')

                                <div class="col-sm-12 col-md-12 col-lg-9">

                                    <div class="order_cards">

                                        @foreach ($orders as $order)
                                            <div class="order_card">
                                                <div class="status" style="background-color: {{ $order->status->color }} !important; color: #FFFFFF;">{{ $order->status->name ?? '' }}</div>
                                                <div class="card_header"
                                                    data-url="{{ route('site.orders.show', $order->id) }}">
                                                    <h5>{{ __("order number") }} <span>#{{ $order->id }}</span> </h5>
                                                    <p> {{ __("The date of application") }} <span>{{ $order->created_at->format('Y-m-d') }}</span>
                                                    </p>
                                                    <p>{{ __("Expected date of arrival of the order") }} <span> {{ $order->created_at->addDays($app->expected_order_delivered) }}</span> </p>
                                                </div>

                                                <hr>

                                                <div class="card_options mb-4"
                                                    data-url="{{ route('site.orders.show', $order->id) }}">
                                                    <ul class="list-unstyled">
                                                        <li>
                                                            <i class="fas fas fas fa-map-marker-alt"></i>
                                                            <span>{{ __("Order delivery address") }}</span>
                                                        </li>
                                                        <li>
                                                            <span>
                                                                {{ $order->address }}
                                                            </span>
                                                        </li>
                                                    </ul>
                                                </div>

                                                <div class="card_footer">
                                                    @if (in_array($order->order_status_id, [1, 2, 3]))
                                                        <a href="#" class="cancle-order-btn" data-bs-toggle="modal"
                                                            data-bs-target="#modaAddAdress" data-id="{{ $order->id }}">
                                                            {{ __("Cancelling order") }}
                                                        </a>
                                                    @endif
                                                    <div class="price">{{ $order->total }} ر.س</div>
                                                </div>
                                            </div>
                                        @endforeach

                                    </div>

                                    <div class="my-4">
                                        {{ $orders->links() }}
                                    </div>


                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="adress_modal">
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
                            <h5>{{ __('Cancle Order') }}</h5>
                        </div>
                        <div class=" col-lg-6 mx-auto">
                            <div class="">
                                <form action="{{ route('orders.cancle') }}" method="POST">
                                    @csrf

                                    <input type="hidden" name="order_id" id="OrderIdInput">
                                    <div class="options mt-5">
                                        <button type="submit"
                                            class="mx-1 btn btn-primary confirm-add-to-cart">تأكيد</button>
                                        <button data-bs-dismiss="modal" class="btn btn-secondary mx-1"
                                            href="">الغاء</button>
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
        document.addEventListener('DOMContentLoaded', function() {
            const radios = document.querySelectorAll('input[name="lang"]');
            radios.forEach(radio => {
                radio.addEventListener('change', function() {
                    document.getElementById('langForm').submit();
                });
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            // Add click event listener to both card_header and card_options
            $('.card_header, .card_options').on('click', function(event) {
                window.location.href = $(this).data('url');
            });
        });
    </script>



    <script>
        $(document).on('click', '.cancle-order-btn', function() {
            let id = $(this).data('id');
            $('#OrderIdInput').val(id);
        });
    </script>
@endsection
