<div class="card-datatable table-responsive" id="employee-list">

    <table class="table borded">
        <thead class="table-light">
            <tr>
                <th>
                    <input class="form-check-input select-all" type="checkbox">
                </th>
                <th>ID</th>
                <th>{{ __('Name') }}</th>
                <th>{{ __('Email') }}</th>
                <th>{{ __('Status') }}</th>
                <th>{{ __('Actions') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($employees as $employee)
                <tr>
                    <td>
                        <input class="form-check-input item" value="{{ $employee->id }}" type="checkbox">
                    </td>
                    <td>{{ $loop->iteration }}</td>
                    <td>
                        @if ($employee->avatar)
                            <a href="{{ asset($employee->avatar) }}" download>
                                <img class="w-px-40 h-auto rounded-circle" src="{{ asset($employee->avatar) }}"
                                    alt="">
                            </a>
                        @endif
                        {{ $employee->name }}
                    </td>
                    <td>{{ $employee->email }}</td>
                    <td>
                        @if ($employee->is_active)
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
                                @can('employees.update')
                                    <a class="dropdown-item waves-effect"
                                        href="{{ route('employees.edit', $employee->id) }}"><i
                                            class="mdi mdi-pencil-outline me-1"></i> {{ __('Edit') }}</a>
                                @endcan
                                @can('employees.delete')
                                    <a class="dropdown-item waves-effect delete-btn" href="javascript:void(0);"
                                        data-url="{{ route('employees.destroy', $employee->id) }}" data-bs-toggle="modal"
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
        {{ $employees->links() }}
    </div>
</div>
