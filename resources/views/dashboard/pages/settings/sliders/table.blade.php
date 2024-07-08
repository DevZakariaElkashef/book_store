<div class="card-datatable table-responsive" id="slider-list">

    <table class="table">
        <thead class="table-light">
            <tr>

                <th>ID</th>
                <th>{{ __('Key') }}</th>
                <th>{{ __('Image') }}</th>
                <th>{{ __('Actions') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($sliders as $slider)
                <tr>

                    <td>{{ $loop->iteration }}</td>
                    <td>
                        {{ $slider->key }}
                    </td>
                    <td>
                        @if ($slider->image)
                            <a href="{{ asset($slider->image) }}" download>
                                <img style="width: 50px; height: 50px;" class="rounded-circle" src="{{ asset($slider->image) }}"
                                    alt="">
                            </a>
                        @endif
                    </td>
                    <td>
                        <div class="dropdown">
                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                <i class="mdi mdi-dots-vertical"></i>
                            </button>
                            <div class="dropdown-menu" style="">
                                <a class="dropdown-item waves-effect edit-btn"
                                    data-url="{{ route('sliders.update', $slider->id) }}"
                                    data-image="{{ asset($slider->image) }}"data-bs-toggle="modal"
                                    data-bs-target="#updateModal"><i class="mdi mdi-pencil-outline me-1"></i>
                                    {{ __('Edit') }}
                                </a>
                            </div>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="mt-3 px-3">
        {{ $sliders->links() }}
    </div>
</div>
