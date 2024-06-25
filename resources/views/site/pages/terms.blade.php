@extends('site.layout.app')

@section('content')
    <div class="custom_preadcrumb">
        <div class="container-fluid pd-50">
            <ul class="mt-5 list-unstyled d-flex align-items-center">
                <li><a href="{{ route('site.home') }}">الرئيسية</a></li>
                <li><a href="{{ route('site.terms.index') }}">{{ __('terms and conditions') }}</a></li>
            </ul>
        </div>
    </div>




    <div class="terms-condition-page">
        <div class="wrapper">
            <div class="container-fluid pd-50">

                <div class="terms-condition-content colsm-12 col-lg-12">
                    <ul class="list-unstyled col-lg-9">
                        <li>
                            <p>
                                {{ $terms->value }}
                            </p>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection
