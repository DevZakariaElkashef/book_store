<div class="card-datatable table-responsive" id="slider-list">

    <table class="table">
        <thead class="table-light">
            <tr>
                <th>
                    <input class="form-check-input select-all" type="checkbox">
                </th>
                <th>ID</th>
                <th>{{ __('Content') }}</th>
                <th>{{ __('Image') }}</th>
                <th>{{ __('Status') }}</th>
                <th>{{ __('Actions') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($aboutus as $item)
                <tr>
                    <td>
                        <input class="form-check-input item" value="{{ $item->id }}" type="checkbox">
                    </td>
                    <td>{{ $loop->iteration }}</td>
                    <td>
                        {{ Str::limit($item->content, 10) }}
                    </td>
                    <td>

                        @if ($item->image)
                            <a href="{{ asset($item->image) }}" download>
                                <img style="width: 50px; height: 50px;" class="rounded-circle" src="{{ asset($item->image) }}"
                                    alt="">
                            </a>
                        @endif
                    </td>

                    <td>
                        @if ($item->is_active)
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
                                    data-url="{{ route('aboutus.update', $item->id) }}"
                                    data-content_ar="{{ $item->content_ar }}"
                                    data-content_en="{{ $item->content_en }}"
                                    data-image="{{ asset($item->image) }}" data-is_active="{{ $item->is_active }}"
                                    data-bs-toggle="modal" data-bs-target="#updateModal"><i
                                        class="mdi mdi-pencil-outline me-1"></i>
                                    {{ __('Edit') }}</a>
                                <a class="dropdown-item waves-effect delete-btn" href="javascript:void(0);"
                                    data-url="{{ route('aboutus.destroy', $item->id) }}" data-bs-toggle="modal"
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
        {{ $aboutus->links() }}
    </div>
</div>
