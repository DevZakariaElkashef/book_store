@extends('site.layout.app')

@section('content')
    <div class="custom_preadcrumb">
        <div class="container-fluid pd-50">
            <ul class="mt-5 list-unstyled d-flex align-items-center">
                <li><a href="{{ route('site.home') }}">{{ __("Home") }}</a></li>
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
                                    <div class="profile-left-data">
                                        <div class="profile-user-data">
                                            <div class="head text-center">
                                                <h5>{{ __("Personal profile") }}</h5>
                                            </div>
                                            <form action="{{ route('site.profile.update') }}" method="POST"
                                                enctype="multipart/form-data">
                                                @csrf
                                                <input type="hidden" name="id" value="{{ $user->id }}">
                                                <div class="row">
                                                    <div class="col-sm-12 col-lg-12">
                                                        <div class="form-group personal-img-form-group mb-5 mt-1">
                                                            <div class="personal-img">
                                                                <div class="per"
                                                                    style="background-image: url('{{ asset('site/assets/images/camera.svg') }}');">
                                                                </div>
                                                                <div class="upload-btn-wrapper">
                                                                    <button class="btn">
                                                                        <i class="fas fa-plus"></i>
                                                                    </button>
                                                                    <input type="file" data-file-upload=""
                                                                        class="personal-img-file" name="avatar" />
                                                                    @error('avatar')
                                                                        <div class="text-danger">{{ $message }}</div>
                                                                    @enderror
                                                                </div>

                                                            </div>
                                                            <h5>{{ __("Upload a photo") }}</h5>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-12 col-lg-6">
                                                        <div class="form-group">
                                                            <label for="name">{{ __("user name") }}</label>
                                                            <input type="text" name="name" placeholder="مروان ابراهيم"
                                                                id="name" class="form-control"
                                                                value="{{ $user->name }}">

                                                            @error('name')
                                                                <div class="text-danger">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="col-sm-12 col-lg-6">
                                                        <div class="form-group">
                                                            <label for="email">{{ __("Email") }}</label>
                                                            <input type="text" name="email" placeholder="{{ __('Email') }}"
                                                                id="email" class="form-control"
                                                                value="{{ $user->email }}">

                                                            @error('email')
                                                                <div class="text-danger">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-12 col-lg-6">
                                                        <div class="form-group">
                                                            <label for="city_id">{{ __("City") }}</label>
                                                            <select name="city_id" id="city_id" class="form-control">
                                                                @foreach ($cities as $city)
                                                                    <option value="{{ $city->id }}"
                                                                        @if ($user->city_id == $city->id) selected @endif>
                                                                        {{ $city->name }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="col-sm-12 col-lg-12">
                                                        <div class="form-group">
                                                            <label for="address">{{ __("Address") }}</label>
                                                            <textarea class="form-control" name="address" id="address">{{ $user->address }}</textarea>
                                                            @error('address')
                                                                <div class="text-danger">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="col-sm-12 col-lg-12">
                                                        <div class="btn-options">
                                                            <div class="btn-more">
                                                                <button type="submit" class="btn-style">{{ __("Save") }}</button>
                                                            </div>
                                                            <div class="btn-more btn-change-pass">
                                                                <a href="{{ route('site.password.edit') }}" class="btn-style">{{ __("Change the password") }}</a>
                                                            </div>
                                                        </div>
                                                    </div>
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
@endsection
