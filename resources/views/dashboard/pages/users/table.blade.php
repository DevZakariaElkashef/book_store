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
                        @if($user->avatar)
                        <img class="w-px-40 h-auto rounded-circle" src="{{ asset($user->avatar) }}" alt="">
                        @endif
                        {{ $user->name }}
                    </td>
                    <td>{{ $user->email }}</td>
                    <td></td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="mt-3 px-3">
        {{ $users->links() }}
    </div>
</div>
