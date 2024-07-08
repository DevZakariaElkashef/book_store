<div class="card-datatable table-responsive" id="contact-list">

    <table class="table">
        <thead class="table-light">
            <tr>
                <th>
                    <input class="form-check-input select-all" type="checkbox">
                </th>
                <th>ID</th>
                <th>{{ __('Type') }}</th>
                <th>{{ __('Name') }}</th>
                <th>{{ __('Email') }}</th>
                <th>{{ __('Status') }}</th>
                <th>{{ __('Date') }}</th>
                <th>{{ __('Actions') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($contacts as $contact)
                <tr>
                    <td>
                        <input class="form-check-input item" value="{{ $contact->id }}" type="checkbox">
                    </td>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $contact->contactType->name ?? 'N/A' }}</td>
                    <td>
                        {{ $contact->name }}
                    </td>
                    <td>{{ $contact->email }}</td>
                    <td>
                        @if ($contact->status)
                            <span class="badge bg-label-primary">{{ __('Replied') }}</span>
                        @else
                            <span class="badge bg-label-danger">{{ __('Not Replied') }}</span>
                        @endif
                    </td>
                    <td>{{ $contact->created_at }}</td>
                    <td>
                        <div class="dropdown">
                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                <i class="mdi mdi-dots-vertical"></i>
                            </button>
                            <div class="dropdown-menu" style="">
                                @can('contacts.read')
                                    <a class="dropdown-item waves-effect show-btn" href="#"
                                        data-message="{{ $contact->message }}" data-bs-toggle="modal"
                                        data-bs-target="#showModal"><i class="mdi mdi-eye me-1"></i>
                                        {{ __('Show') }}</a>
                                @endcan

                                @can('contacts.update')
                                    <a class="dropdown-item waves-effect update-btn"
                                        data-url="{{ route('contacts.update', $contact->id) }}" href="#"
                                        data-bs-toggle="modal" data-bs-target="#updateModal"><i
                                            class="mdi mdi-pencil-outline me-1"></i> {{ __('Edit') }}</a>
                                @endcan

                                @can('contacts.delete')
                                    <a class="dropdown-item waves-effect delete-btn" href="javascript:void(0);"
                                        data-url="{{ route('contacts.destroy', $contact->id) }}" data-bs-toggle="modal"
                                        data-bs-target="#deleteModal"><i class="mdi mdi-trash-can-outline me-1"></i>
                                        {{ __('Delete') }}</a>
                                @endcan
                            </div>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="mt-3 px-3">
        {{ $contacts->links() }}
    </div>
</div>
