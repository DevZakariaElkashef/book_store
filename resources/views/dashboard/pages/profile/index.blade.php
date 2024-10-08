@extends('dashboard.layouts.app')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <h5 class="card-title">{{ __('Update') }}</h5>
            </div>

            <div class="card-body">
                <form action="{{ route('dashboard.profile.update') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="id" value="{{ $user->id }}">
                    <div class="row">
                        <div class="col-md-6 mb-2">
                            <div class="form-group">
                                <label for="nameInput">{{ __('Name') }}</label>
                                <input type="text" class="form-control" name="name" id="nameInput"
                                    value="{{ old('name') ?? $user->name }}">
                                @error('name')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6 mb-2">
                            <div class="form-group">
                                <label for="emailInput">{{ __('Email') }}</label>
                                <input type="email" class="form-control" name="email" id="emailInput"
                                    value="{{ old('email') ?? $user->email }}">
                                @error('email')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6 mb-2">
                            <div class="form-group">
                                <label for="phoneInput">{{ __('Phone') }}</label>
                                <input type="text" class="form-control" name="phone" id="phoneInput"
                                    value="{{ old('phone') ?? $user->phone }}">
                                @error('phone')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6 mb-2">
                            <div class="form-group">
                                <label for="passwordInput">{{ __('Password') }}</label>
                                <input type="password" class="form-control" name="password" id="passwordInput">
                                @error('password')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6 mb-2">
                            <div class="form-group">
                                <label for="avatarInput">{{ __('Avatar') }}</label>
                                <input type="file" accept=".jpg,.png" class="form-control" name="avatar"
                                    id="avatarInput">
                                @if ($user && $user->avatar)
                                    <img src="{{ asset($user->avatar) }}" alt="" style="max-width: 200px;"
                                        class="mt-3">
                                @endif
                                @error('avatar')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6 mb-2">
                            <div class="form-group">
                                <label for="city_idInput">{{ __('City') }}</label>
                                <select type="file" class="form-control" name="city_id" id="city_idInput"
                                    value="{{ old('city_id') }}">
                                    @foreach ($cities as $city)
                                        <option value="{{ $city->id }}"
                                            @if (old('city_id') == $city->id || $user->city_id == $city->id) selected @endif>
                                            {{ $city->name }}</option>
                                    @endforeach
                                </select>
                                @error('city_id')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>




                        <div class="col-md-12 mt-2 text-end">
                            <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
                        </div>
                    </div>

                </form>
            </div>


        </div>

    </div>
@endsection
