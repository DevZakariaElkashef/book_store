@extends('dashboard.layouts.app')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <h5 class="card-title">{{ __('Update') }}</h5>

                <a href="{{ route('employees.index') }}" class="btn btn-primary">{{ __('Back') }}</a>

            </div>

            <div class="card-body">
                <form action="{{ route('employees.update', $employee->id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="id" value="{{ $employee->id }}">
                    <div class="row">
                        <div class="col-md-6 mb-2">
                            <div class="form-group">
                                <label for="nameInput">{{ __('Name') }}</label>
                                <input type="text" class="form-control" name="name" id="nameInput"
                                    value="{{ old('name') ?? $employee->name }}">
                                @error('name')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6 mb-2">
                            <div class="form-group">
                                <label for="emailInput">{{ __('Email') }}</label>
                                <input type="email" class="form-control" name="email" id="emailInput"
                                    value="{{ old('email') ?? $employee->email }}">
                                @error('email')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6 mb-2">
                            <div class="form-group">
                                <label for="phoneInput">{{ __('Phone') }}</label>
                                <input type="text" class="form-control" name="phone" id="phoneInput"
                                    value="{{ old('phone') ?? $employee->phone }}">
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
                                @if ($employee && $employee->avatar)
                                    <img src="{{ asset($employee->avatar) }}" alt="" style="max-width: 200px;"
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
                                            @if (old('city_id') == $city->id || $employee->city_id == $city->id) selected @endif>
                                            {{ $city->name }}</option>
                                    @endforeach
                                </select>
                                @error('city_id')
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
                                            @if (old('city_id') == $city->id || $employee->city_id) selected @endif>
                                            {{ $city->name }}</option>
                                    @endforeach
                                </select>
                                @error('city_id')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6 mb-2">
                            <div class="form-group">
                                <label for="role_idInput">{{ __('Role') }}</label>
                                <select class="form-control" name="role_id" id="role_idInput">
                                    @foreach ($roles as $role)
                                        <option value="{{ $role->id }}"
                                            @if (old('role_id') == $role->id || auth()->user()->roles->contains('id', $role->id)) selected @endif>
                                            {{ $role->name }}</option>
                                    @endforeach
                                </select>

                                @error('role_id')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>


                        <div class="col-md-6 mb-2">
                            <div class="form-group">
                                <label for="avatarInput">{{ __('Status') }}</label>
                                <select type="file" accept=".jpg,.png" class="form-control" name="is_active"
                                    id="avatarInput" value="{{ old('avatar') }}">
                                    <option value="0" @if (old('is_active') == 0 || $employee->is_active == 0) selected @endif>
                                        {{ __('Not Active') }}</option>
                                    <option value="1" @if (old('is_active') == 1 || $employee->is_active == 1) selected @endif>
                                        {{ __('Active') }}</option>
                                </select>
                                @error('avatar')
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
