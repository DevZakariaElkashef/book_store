@extends('dashboard.layouts.app')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <h5 class="card-title">{{ __('Update') }}</h5>

                <a href="{{ route('universities.index') }}" class="btn btn-primary">{{ __('Back') }}</a>

            </div>

            <div class="card-body">
                <form action="{{ route('universities.update', $university->id) }}" method="post"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="id" value="{{ $university->id }}">
                    <div class="row">
                        <div class="col-md-6 mb-2">
                            <div class="form-group">
                                <label for="nameARInput">{{ __('Name') }}(AR)</label>
                                <input type="text" class="form-control" name="name_ar" id="nameARInput"
                                    value="{{ old('name_ar') ?? $university->name_ar }}">
                                @error('name_ar')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6 mb-2">
                            <div class="form-group">
                                <label for="nameENInput">{{ __('Name') }}(EN)</label>
                                <input type="text" class="form-control" name="name_en" id="nameENInput"
                                    value="{{ old('name_en') ?? $university->name_en }}">
                                @error('name_en')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>


                        <div class="col-md-6 mb-2">
                            <div class="form-group">
                                <label for="descriptionARInput">{{ __('Description') }}(AR)</label>
                                <textarea type="description" class="form-control" name="description_ar" id="descriptionARInput">{{ old('description_ar') ?? $university->description_ar }}</textarea>
                                @error('description_ar')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>


                        <div class="col-md-6 mb-2">
                            <div class="form-group">
                                <label for="descriptionENInput">{{ __('Description') }}(EN)</label>
                                <textarea type="description" class="form-control" name="description_en" id="descriptionENInput">{{ old('description_en') ?? $university->description_ar }}</textarea>
                                @error('description_en')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>



                        <div class="col-md-6 mb-2">
                            <div class="form-group">
                                <label for="imageInput">{{ __('Image') }}</label>
                                <input type="file" accept=".jpg,.png" class="form-control" name="image"
                                    id="imageInput">
                                @if($university->image)
                                <img style="max-width: 100px;" src="{{ asset($university->image) }}" alt="">
                                @endif
                                @error('image')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6 mb-2">
                            <div class="form-group">
                                <label for="avatarInput">{{ __('Status') }}</label>
                                <select type="file" accept=".jpg,.png" class="form-control" name="is_active"
                                    id="avatarInput" value="{{ old('avatar') }}">
                                    <option value="0" @if (old('is_active') == 0 || $university->is_active == 0) selected @endif>
                                        {{ __('Not Active') }}</option>
                                    <option value="1" @if (old('is_active') == 1 || $university->is_active == 1) selected @endif>
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
