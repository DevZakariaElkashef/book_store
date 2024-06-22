@extends('dashboard.layouts.app')


@section('css')
    <style>
        .preview-images {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin-top: 10px;
        }

        .preview-image-container {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .preview-images img {
            max-width: 100px;
            max-height: 100px;
            border: 1px solid #ddd;
            padding: 5px;
        }

        .remove-link {
            color: red;
            cursor: pointer;
            text-decoration: underline;
        }
    </style>
@endsection

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <h5 class="card-title">{{ __('Create') }}</h5>

                <a href="{{ route('subjects.index') }}" class="btn btn-primary">{{ __('Back') }}</a>

            </div>

            <div class="card-body">
                <form action="{{ route('subjects.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-6 mb-2">
                            <div class="form-group">
                                <label for="univirsitySelect">{{ __('University') }}</label>
                                <select type="text" class="form-control" name="university_id" id="univirsitySelect">
                                    @foreach ($universities as $university)
                                        <option value="{{ $university->id }}"
                                            @if (old('university_id') == $university->id) selected @endif> {{ $university->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('university_id')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6 mb-2">
                            <div class="form-group">
                                <label for="collegeSelect">{{ __('College') }}</label>
                                <select type="text" class="form-control" name="college_id" id="collegeSelect">
                                    <option disabled selected>{{ __('Select University First') }}</option>
                                </select>
                                @error('college_id')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6 mb-2">
                            <div class="form-group">
                                <label for="nameARInput">{{ __('Name') }}(AR)</label>
                                <input type="text" class="form-control" name="name_ar" id="nameARInput"
                                    value="{{ old('name_ar') }}">
                                @error('name_ar')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6 mb-2">
                            <div class="form-group">
                                <label for="nameENInput">{{ __('Name') }}(EN)</label>
                                <input type="text" class="form-control" name="name_en" id="nameENInput"
                                    value="{{ old('name_en') }}">
                                @error('name_en')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>


                        <div class="col-md-12 mb-2">
                            <div class="form-group">
                                <label for="avatarInput">{{ __('Status') }}</label>
                                <select type="file" accept=".jpg,.png" class="form-control" name="is_active"
                                    id="avatarInput" value="{{ old('avatar') }}">
                                    <option value="0" @if (old('is_active') == 0) selected @endif>
                                        {{ __('Not Active') }}</option>
                                    <option value="1" @if (old('is_active') == 1) selected @endif>
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
@section('js')
    <script>
        document.getElementById('imagesInput').addEventListener('change', function(event) {
            const previewContainer = document.getElementById('previewImages');
            previewContainer.innerHTML = '';
            const files = Array.from(event.target.files);

            files.forEach((file, index) => {
                if (file.type.startsWith('image/')) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        const imgContainer = document.createElement('div');
                        imgContainer.classList.add('preview-image-container');

                        const imgElement = document.createElement('img');
                        imgElement.src = e.target.result;

                        const removeLink = document.createElement('span');
                        removeLink.textContent = 'Remove';
                        removeLink.classList.add('remove-link');
                        removeLink.addEventListener('click', () => {
                            files.splice(index, 1);
                            const dataTransfer = new DataTransfer();
                            files.forEach(file => dataTransfer.items.add(file));
                            event.target.files = dataTransfer.files;
                            imgContainer.remove();
                        });

                        imgContainer.appendChild(imgElement);
                        imgContainer.appendChild(removeLink);
                        previewContainer.appendChild(imgContainer);
                    }
                    reader.readAsDataURL(file);
                }
            });
        });
    </script>


    <script>
        $(document).on('change', '#univirsitySelect', function() {
            var univirsityId = $(this).val();
            $.ajax({
                url: "{{ route('colleges.getColleges') }}",
                type: "GET",
                data: {
                    univirsityId: univirsityId
                },
                success: function(data) {
                    $('#collegeSelect').html(data);
                }
            });
        });
    </script>
@endsection
