<div class="card-datatable table-responsive" id="book-list">

    <table class="table">
        <thead class="table-light">
            <tr>
                <th>
                    <input class="form-check-input select-all" type="checkbox">
                </th>
                <th>ID</th>
                <th>{{ __('University') }}</th>
                <th>{{ __('College') }}</th>
                <th>{{ __('Subject') }}</th>
                <th>{{ __('Name') }}</th>
                <th>{{ __('Author') }}</th>
                <th>{{ __('Description') }}</th>
                <th>{{ __('Status') }}</th>
                <th>{{ __('Actions') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($books as $book)
                <tr>
                    <td>
                        <input class="form-check-input item" value="{{ $book->id }}" type="checkbox">
                    </td>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $book->subject->college->university->name ?? 'N/A' }}</td>
                    <td>{{ $book->subject->college->name ?? 'N/A' }}</td>
                    <td>{{ $book->subject->name ?? 'N/A' }}</td>

                    <td>
                        @if ($book->image)
                            <a href="{{ asset($book->image) }}" download="">
                                <img class="w-px-40 h-auto rounded-circle" src="{{ asset($book->image) }}"
                                    alt="">
                            </a>
                        @endif
                        {{ $book->name }}
                    </td>
                    <td>{{ $book->author }}</td>
                    <td>{{ Str::limit($book->description, 50) }}</td>
                    <td>
                        @if ($book->is_active)
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
                                <a class="dropdown-item waves-effect" href="{{ route('books.edit', $book->id) }}"><i
                                        class="mdi mdi-pencil-outline me-1"></i> {{ __('Edit') }}</a>
                                <a class="dropdown-item waves-effect delete-btn" href="javascript:void(0);"
                                    data-url="{{ route('books.destroy', $book->id) }}" data-bs-toggle="modal"
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
        {{ $books->links() }}
    </div>
</div>
