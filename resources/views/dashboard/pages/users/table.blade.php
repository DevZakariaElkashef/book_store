<div class="card-datatable table-responsive" id="user-list">

    <table class="table">
        <thead class="table-light">
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
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
                        <a href="{{ route('users.edit', $user) }}" class="text-dark">
                            <span class="mdi mdi-pen"></span>
                        </a>

                        <a href="#" data-url="{{ route('users.destroy', $user->id) }}" data-bs-toggle="modal"
                            data-bs-target="#deleteModal">
                            <span class="mdi mdi-trash-can"></span>
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="mt-3 px-3">
        {{ $users->links() }}
    </div>
</div>


<!-- Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="deleteModalLabel">{{ __("Delete") }}</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="post">
                <div class="modal-body">
                    {{ __("Are You Sure!!") }}
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __("Close") }}</button>
                    <button type="button" class="btn btn-primary">{{ __("Delete") }}</button>
                </div>
            </form>
        </div>
    </div>
</div>
