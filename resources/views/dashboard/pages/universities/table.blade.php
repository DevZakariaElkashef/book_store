<div class="card-datatable table-responsive" id="university-list">

    <table class="table">
        <thead class="table-light">
            <tr>
                <th>ID</th>
                <th>{{ __("Name") }}</th>
                <th>{{ __("Description") }}</th>
                <th>{{ __("Status") }}</th>
                <th>{{ __("Date") }}</th>
                <th>{{ __("Actions") }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($universities as $university)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>
                        @if ($university->image)
                        <a href="{{ asset($university->image) }}" download>
                            <img class="w-px-40 h-auto rounded-circle" src="{{ asset($university->image) }}" alt="">
                        </a>
                        @endif
                        {{ $university->name }}
                    </td>
                    <td>{{ Str::limit($university->description, 50) }}</td>
                    <td>
                        @if($university->is_active)
                        <span class="badge bg-label-primary">{{ __("Active") }}</span>
                        @else
                        <span class="badge bg-label-dark">{{ __("Not Active") }}</span>
                        @endif
                    </td>
                    <td>{{ $university->created_at }}</td>
                    <td>
                        <div class="dropdown">
                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                <i class="mdi mdi-dots-vertical"></i>
                            </button>
                            <div class="dropdown-menu" style="">
                                <a class="dropdown-item waves-effect" href="{{ route('universities.edit', $university->id) }}"><i
                                        class="mdi mdi-pencil-outline me-1"></i> {{ __("Edit") }}</a>
                                <a class="dropdown-item waves-effect delete-btn" href="javascript:void(0);" data-url="{{ route('universities.destroy', $university->id) }}" data-bs-toggle="modal" data-bs-target="#deleteModal"><i
                                        class="mdi mdi-trash-can-outline me-1"></i> {{ __("Delete") }}</a>
                            </div>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="mt-3 px-3">
        {{ $universities->links() }}
    </div>
</div>



