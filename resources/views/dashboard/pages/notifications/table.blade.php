<div class="card-datatable table-responsive" id="notification-list">

    <table class="table">
        <thead class="table-light">
            <tr>
                <th>
                    <input class="form-check-input select-all" type="checkbox">
                </th>
                <th>ID</th>
                <th>{{ __('Title') }}</th>
                <th>{{ __('Content') }}</th>
                <th>{{ __('Status') }}</th>
                <th>{{ __('Date') }}</th>
                <th>{{ __('Actions') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($notifications as $notification)
                <tr>
                    <td>
                        <input class="form-check-input item" value="{{ $notification->id }}" type="checkbox">
                    </td>
                    <td>{{ $loop->iteration }}</td>
                    <td>
                        {{ $notification->data['title'] }}
                    </td>
                    <td>
                        {{ $notification->data['body'] }}
                    </td>
                    <td>
                        @if ($notification->read_at)
                            <span class="badge bg-label-primary">{{ __('Read') }}</span>
                        @else
                            <span class="badge bg-label-dark">{{ __('Not Read') }}</span>
                        @endif
                    </td>
                    <td>{{ $notification->created_at }}</td>
                    <td>
                        <div class="dropdown">
                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                <i class="mdi mdi-dots-vertical"></i>
                            </button>
                            <div class="dropdown-menu" style="">
                                <a class="dropdown-item waves-effect delete-btn" href="#"
                                    onclick="event.preventDefault(); document.getElementById('updateForm{{ $notification->id }}').submit();">
                                    <i class="mdi mdi-eye me-1"></i> {{ __('Mark As Read') }}
                                </a>
                                <form class="d-none" id="updateForm{{ $notification->id }}"
                                    action="{{ route('notifications.store') }}" method="post">
                                    @csrf
                                    <input type="hidden" name="read_at" value="1">
                                    <input type="hidden" name="id" value="{{ $notification->id }}">
                                </form>


                                <a class="dropdown-item waves-effect delete-btn" href="javascript:void(0);"
                                    data-url="{{ route('notifications.destroy', $notification->id) }}"
                                    data-bs-toggle="modal" data-bs-target="#deleteModal"><i
                                        class="mdi mdi-trash-can-outline me-1"></i> {{ __('Delete') }}</a>
                            </div>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="mt-3 px-3">
        {{-- {{ $notifications->links() }} --}}
    </div>
</div>
