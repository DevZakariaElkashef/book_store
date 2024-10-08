<div class="card-datatable table-responsive" id="college-list">

    <table class="table">
        <thead class="table-light">
            <tr>
                <th>
                    <input class="form-check-input select-all" type="checkbox">
                </th>
                <th>{{ __('ID') }}</th>
                <th>{{ __('University') }}</th>
                <th>{{ __('Name') }}</th>
                <th>{{ __('Description') }}</th>
                <th>{{ __('Status') }}</th>
                <th>{{ __('Date') }}</th>
                <th>{{ __('Actions') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($colleges as $college)
                <tr>
                    <td>
                        <input class="form-check-input item" value="{{ $college->id }}" type="checkbox">
                    </td>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $college->university->name ?? 'N/A' }}</td>
                    <td>
                        @if ($college->image)
                            <a href="{{ asset($college->image) }}" download>
                                <img class="w-px-40 h-auto rounded-circle" src="{{ asset($college->image) }}"
                                    alt="">
                            </a>
                        @endif
                        {{ $college->name }}
                    </td>
                    <td>{{ Str::limit($college->description, 50) }}</td>
                    <td>
                        @if ($college->is_active)
                            <span class="badge bg-label-primary">{{ __('Active') }}</span>
                        @else
                            <span class="badge bg-label-dark">{{ __('Not Active') }}</span>
                        @endif
                    </td>
                    <td>{{ $college->created_at }}</td>
                    <td>
                        <div class="dropdown">
                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                <i class="mdi mdi-dots-vertical"></i>
                            </button>
                            <div class="dropdown-menu" style="">
                                @can('colleges.update')
                                    <a class="dropdown-item waves-effect"
                                        href="{{ route('colleges.edit', $college->id) }}"><i
                                            class="mdi mdi-pencil-outline me-1"></i> {{ __('Edit') }}</a>
                                @endcan

                                @can('colleges.delete')
                                    <a class="dropdown-item waves-effect delete-btn" href="javascript:void(0);"
                                        data-url="{{ route('colleges.destroy', $college->id) }}" data-bs-toggle="modal"
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
        {{ $colleges->links() }}
    </div>
</div>
