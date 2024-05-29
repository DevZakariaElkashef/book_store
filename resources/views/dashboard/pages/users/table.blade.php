<div class="card-datatable table-responsive" id="user-list">

    <table class="table">
        <thead class="table-light">
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>
                        @if ($user->avatar)
                            <img class="w-px-40 h-auto rounded-circle" src="{{ asset($user->avatar) }}" alt="">
                        @endif
                        {{ $user->name }}
                    </td>
                    <td>{{ $user->email }}</td>
                    <td>
                        @if($user->is_active)
                        <span class="badge bg-label-primary">{{ __("Active") }}</span>
                        @else
                        <span class="badge bg-label-dark">{{ __("Not Active") }}</span>
                        @endif
                    </td>
                    <td>
                        <div class="dropdown">
                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                <i class="mdi mdi-dots-vertical"></i>
                            </button>
                            <div class="dropdown-menu" style="">
                                <a class="dropdown-item waves-effect" href="{{ route('users.edit', $user->id) }}"><i
                                        class="mdi mdi-pencil-outline me-1"></i> Edit</a>
                                <a class="dropdown-item waves-effect delete-btn" href="javascript:void(0);" data-url="{{ route('users.destroy', $user->id) }}" data-bs-toggle="modal" data-bs-target="#deleteModal"><i
                                        class="mdi mdi-trash-can-outline me-1"></i> Delete</a>
                            </div>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="mt-3 px-3">
        {{ $users->links() }}
    </div>
</div>



