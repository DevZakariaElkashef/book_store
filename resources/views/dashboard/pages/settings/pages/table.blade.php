<div class="card-datatable table-responsive" id="page-list">

    <table class="table">
        <thead class="table-light">
            <tr>
                <th>
                    <input class="form-check-input select-all" type="checkbox">
                </th>
                <th>ID</th>
                <th>{{ __('key') }}</th>
                <th>{{ __('Value') }}</th>
                <th>{{ __('Actions') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($pages as $page)
                <tr>
                    <td>
                        <input class="form-check-input item" value="{{ $page->id }}" type="checkbox">
                    </td>
                    <td>{{ $loop->iteration }}</td>
                    <td>
                        @if ($page->image)
                            <a href="{{ asset($page->image) }}" download>
                                <img class="w-px-40 h-auto rounded-circle" src="{{ asset($page->image) }}"
                                    alt="">
                            </a>
                        @endif
                        {{ Str::limit($page->key, 10) }}
                    </td>
                    <td>
                        {{ Str::limit($page->value, 10) }}
                    </td>

                    <td>
                        <div class="dropdown">
                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                <i class="mdi mdi-dots-vertical"></i>
                            </button>
                            <div class="dropdown-menu" style="">
                                <a class="dropdown-item waves-effect edit-btn"
                                    data-url="{{ route('pages.update', $page->id) }}"
                                    data-value_ar="{{ $page->value_ar }}" data-value_en="{{ $page->value_en }}"
                                    data-bs-toggle="modal" data-bs-target="#updateModal"><i
                                        class="mdi mdi-pencil-outline me-1"></i>
                                    {{ __('Edit') }}</a>
                            </div>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="mt-3 px-3">
        {{ $pages->links() }}
    </div>
</div>
