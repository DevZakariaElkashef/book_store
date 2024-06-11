<div class="card-datatable table-responsive" id="contacttype-list">

    <table class="table">
        <thead class="table-light">
            <tr>
                <th>
                    <input class="form-check-input select-all" type="checkbox">
                </th>
                <th>ID</th>
                <th>{{ __("Name") }}</th>
                <th>{{ __("Status") }}</th>
                <th>{{ __("Date") }}</th>
                <th>{{ __("Actions") }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($contacttypes as $contacttype)
                <tr>
                    <td>
                        <input class="form-check-input item" value="{{ $contacttype->id }}" type="checkbox">
                    </td>
                    <td>{{ $loop->iteration }}</td>
                    <td>
                        {{ $contacttype->name }}
                    </td>
                    <td>
                        @if($contacttype->is_active)
                        <span class="badge bg-label-primary">{{ __("Active") }}</span>
                        @else
                        <span class="badge bg-label-dark">{{ __("Not Active") }}</span>
                        @endif
                    </td>
                    <td>{{ $contacttype->created_at }}</td>
                    <td>
                        <div class="dropdown">
                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                <i class="mdi mdi-dots-vertical"></i>
                            </button>
                            <div class="dropdown-menu" style="">
                                <a class="dropdown-item waves-effect" href="{{ route('contact_types.edit', $contacttype->id) }}"><i
                                        class="mdi mdi-pencil-outline me-1"></i> {{ __("Edit") }}</a>
                                <a class="dropdown-item waves-effect delete-btn" href="javascript:void(0);" data-url="{{ route('contact_types.destroy', $contacttype->id) }}" data-bs-toggle="modal" data-bs-target="#deleteModal"><i
                                        class="mdi mdi-trash-can-outline me-1"></i> {{ __("Delete") }}</a>
                            </div>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="mt-3 px-3">
        {{ $contacttypes->links() }}
    </div>
</div>



