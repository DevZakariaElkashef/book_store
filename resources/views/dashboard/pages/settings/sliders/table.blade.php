<div class="card-datatable table-responsive" id="slider-list">

    <table class="table">
        <thead class="table-light">
            <tr>
                <th>
                    <input class="form-check-input select-all" type="checkbox">
                </th>
                <th>ID</th>
                <th>{{ __('Title') }}</th>
                <th>{{ __('Content') }}</th>
                <th>{{ __('Url') }}</th>
                <th>{{ __('Status') }}</th>
                <th>{{ __('Actions') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($sliders as $slider)
                <tr>
                    <td>
                        <input class="form-check-input item" value="{{ $slider->id }}" type="checkbox">
                    </td>
                    <td>{{ $loop->iteration }}</td>
                    <td>
                        @if ($slider->image)
                            <a href="{{ asset($slider->image) }}" download>
                                <img class="w-px-40 h-auto rounded-circle" src="{{ asset($slider->image) }}"
                                    alt="">
                            </a>
                        @endif
                        {{ Str::limit($slider->title, 10) }}
                    </td>
                    <td>
                        {{ Str::limit($slider->content, 10) }}
                    </td>
                    <td>
                        {{ $slider->url }}
                    </td>
                    <td>
                        @if ($slider->is_active)
                            <span class="badge bg-label-primary">{{ __('Active') }}</span>
                        @else
                            <span class="badge bg-label-dark">{{ __('Not Active') }}</span>
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
                                    data-title_ar="{{ $slider->title_ar }}" data-title_en="{{ $slider->title_en }}"
                                    data-content_ar="{{ $slider->content_ar }}"
                                    data-content_en="{{ $slider->content_en }}" data-link="{{ $slider->url }}"
                                    data-image="{{ asset($slider->image) }}"
                                    data-is_active="{{ $slider->is_active }}" data-bs-toggle="modal"
                                    data-bs-target="#updateModal"><i class="mdi mdi-pencil-outline me-1"></i>
                                    {{ __('Edit') }}</a>
                                <a class="dropdown-item waves-effect delete-btn" href="javascript:void(0);"
                                    data-url="{{ route('sliders.destroy', $slider->id) }}" data-bs-toggle="modal"
                                    data-bs-target="#deleteModal"><i class="mdi mdi-trash-can-outline me-1"></i>
                                    {{ __('Delete') }}</a>
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
