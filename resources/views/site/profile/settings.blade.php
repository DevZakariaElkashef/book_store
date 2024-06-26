@extends('site.layout.app')

@section('content')
    <div class="custom_preadcrumb">
        <div class="container-fluid pd-50">
            <ul class="mt-5 list-unstyled d-flex align-items-center">
                <li><a href="{{ route('site.home') }}">الرئيسية</a></li>
                <li><a href="{{ route('site.profile.index') }}">{{ __('Profile') }}</a></li>
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
                                    <div class="order_details_page">


                                        <div class="setting_card">
                                            <h5>اللغة</h5>
                                            <div class="labg">
                                                <form id="langForm" action="{{ route('site.lang.update') }}" method="POST">
                                                    @csrf
                                                    <div class="form-group">
                                                        <input type="radio" value="ar" id="ar" @if(app()->getLocale() == 'ar') checked @endif name="lang">
                                                        <label for="ar">العربية</label>
                                                    </div>
                                                    <div class="form-group">
                                                        <input type="radio" value="en" id="en" name="lang" @if(app()->getLocale() == 'en') checked @endif>
                                                        <label for="en">الانجليزية</label>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>

                                    </div>
                                </div>

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

@endsection
