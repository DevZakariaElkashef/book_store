@extends('dashboard.layouts.app')


@section('css')
    <link rel="stylesheet" href="{{ asset('dashboard/assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css') }}" />
    <link rel="stylesheet"
        href="{{ asset('dashboard/assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css') }}" />
    <link rel="stylesheet"
        href="{{ asset('dashboard/assets/vendor/libs/datatables-checkboxes-jquery/datatables.checkboxes.css') }}" />
    <link rel="stylesheet" href="{{ asset('dashboard/assets/vendor/libs/@form-validation/umd/styles/index.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('dashboard/assets/vendor/libs/animate-css/animate.css') }}" />
@endsection

@section('content')
    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="mb-1">{{ __("Roles List") }}</h4>
        <p class="mb-4">
            {{ __("A role provided access to predefined menus and features so that depending on assigned role an administrator can have access to what user needs.") }}
        </p>
        <!-- Role cards -->
        <div class="row g-4">

            @foreach ($roles as $role)
                <div class="col-xl-4 col-lg-6 col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between mb-2">
                                <p>{{ __("Total") }} {{ $role->users->count() }} {{ __("users") }}</p>
                                <ul class="list-unstyled d-flex align-items-center avatar-group mb-0">
                                    @foreach ($role->users as $key => $user)
                                        @continue($key >= 3)
                                        <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top"
                                            title="{{ $user->name }}" class="avatar pull-up">
                                            <img class="rounded-circle"
                                                src="{{ $user->avatar ? asset($user->avatar) : asset('dashboard/assets/img/avatars/5.png') }}"
                                                alt="Avatar" />
                                        </li>
                                        @if ($key == 2)
                                            <li class="avatar">
                                                <span class="avatar-initial rounded-circle pull-up bg-lighter text-body"
                                                    data-bs-toggle="tooltip" data-bs-placement="bottom"
                                                    title="{{ $role->users->count() - 3 }} more">+{{ $role->users->count() - 3 }}</span>
                                            </li>
                                        @endif
                                    @endforeach
                                </ul>
                            </div>
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="role-heading">
                                    <h4 class="mb-1 text-body">{{ __($role->name) }}</h4>
                                    <a href="#" data-role-id="{{ $role->id }}"
                                        data-update-url="{{ route('roles.update', $role->id) }}"
                                        data-role-name="{{ $role->name }}"
                                        data-role-permissions="{{ $role->permissions->pluck('id') }}"
                                        class="edit-role-btn">

                                        <span>{{ __("Edit") }}</span>
                                    </a>
                                </div>
                                @if ($role->id != 1)
                                    <a href="javascript:void(0);" data-bs-target="#deleteRoleModal" data-bs-toggle="modal" data-url="{{ route('roles.destroy', $role->id) }}"
                                        class="text-muted deleteRoleBtn">
                                        <i class="fa fa-trash"></i>
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach



            <div class="col-xl-4 col-lg-6 col-md-6">
                <div class="card h-100">
                    <div class="row h-100">
                        <div class="col-5">
                            <div class="d-flex align-items-end h-100 justify-content-center">
                                <img src="{{ asset('dashboard/assets/img/illustrations/add-new-role-illustration.png') }}"
                                    class="img-fluid" alt="Image" width="70" />
                            </div>
                        </div>
                        <div class="col-7">
                            <div class="card-body text-sm-end text-center ps-sm-0">
                                <button data-bs-target="#addRoleModal" data-bs-toggle="modal"
                                    class="btn btn-primary mb-3 text-nowrap add-new-role">
                                    {{ __("Add Role") }}
                                </button>
                                <p class="mb-0">{{ __("Add role, if it does not exist") }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--/ Role cards -->

        <!-- Add Role Modal -->
        <div class="modal fade" id="addRoleModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered modal-add-new-role">
                <div class="modal-content p-3 p-md-5">
                    <button type="button" class="btn-close btn-pinned" data-bs-dismiss="modal" aria-label="Close"></button>
                    <div class="modal-body p-md-0">
                        <div class="text-center mb-4">
                            <h3 class="role-title mb-2 pb-0">{{ __("Add New Role") }}</h3>
                            <p>{{ __("Set role permissions") }}</p>
                        </div>
                        <!-- Add role form -->
                        <form id="addRoleForm" class="row g-3" action="{{ route('roles.store') }}" method="post">
                            @csrf
                            <div class="col-12 mb-4">
                                <div class="form-floating form-floating-outline">
                                    <input type="text" id="modalRoleName" name="name" class="form-control"
                                        placeholder="Enter a role name" tabindex="-1" />
                                    <label for="modalRoleName">{{ __("Role Name") }}</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <h5>{{ __("Role Permissions") }}</h5>
                                <!-- Permission table -->
                                <div class="table-responsive">
                                    <table class="table table-flush-spacing">
                                        <tbody>
                                            <tr>
                                                <td class="text-nowrap fw-medium">
                                                    {{ __("Administrator Access") }}
                                                    <i class="mdi mdi-information-outline" data-bs-toggle="tooltip"
                                                        data-bs-placement="top"
                                                        title="Allows a full access to the system"></i>
                                                </td>
                                                <td>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" id="selectAll" />
                                                        <label class="form-check-label" for="selectAll"> {{ __("Select All") }}
                                                        </label>
                                                    </div>
                                                </td>
                                            </tr>
                                            @foreach ($permissions as $permission => $actions)
                                                <tr>
                                                    <td class="text-nowrap fw-medium">{{ $permission }}</td>
                                                    <td>
                                                        <div class="d-flex">
                                                            @foreach ($actions as $action)
                                                                <div class="form-check me-3 me-lg-5">
                                                                    <input class="form-check-input" name="permissions[]"
                                                                        value="{{ $action->id }}" type="checkbox"
                                                                        id="userManagementRead{{ $action->id }}" />
                                                                    <label class="form-check-label"
                                                                        for="userManagementRead{{ $action->id }}">
                                                                        {{ $action->name }}
                                                                    </label>
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach

                                        </tbody>
                                    </table>
                                </div>
                                <!-- Permission table -->
                            </div>
                            <div class="col-12 text-center">
                                <button type="submit" class="btn btn-primary me-sm-3 me-1">{{ __("Submit") }}</button>
                                <button type="reset" class="btn btn-outline-secondary" data-bs-dismiss="modal"
                                    aria-label="Close">
                                    {{ __("Cancel") }}
                                </button>
                            </div>
                        </form>
                        <!--/ Add role form -->
                    </div>
                </div>
            </div>
        </div>
        <!--/ Add Role Modal -->

        <!-- edit Role Modal -->
        <div class="modal fade" id="editRoleModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered modal-add-new-role">
                <div class="modal-content p-3 p-md-5">
                    <button type="button" class="btn-close btn-pinned" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                    <div class="modal-body p-md-0">
                        <div class="text-center mb-4">
                            <h3 class="role-title mb-2 pb-0">{{ __("Edit Role") }}</h3>
                            <p>{{ __("Update role permissions") }}</p>
                        </div>
                        <!-- Add role form -->
                        <form id="editRoleForm" class="row g-3" method="post">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="id" id="roleId">
                            <div class="col-12 mb-4">
                                <div class="form-floating form-floating-outline">
                                    <input type="text" id="editRoleName" name="name" class="form-control"
                                        placeholder="Enter a role name" tabindex="-1" />
                                    <label for="editRoleName">{{ __("Role Name") }}</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <h5>{{ __("Role Permissions") }}</h5>
                                <!-- Permission table -->
                                <div class="table-responsive">
                                    <table class="table table-flush-spacing">
                                        <tbody>
                                            <tr>
                                                <td class="text-nowrap fw-medium">
                                                    {{ __("Administrator Access") }}
                                                    <i class="mdi mdi-information-outline" data-bs-toggle="tooltip"
                                                        data-bs-placement="top"
                                                        title="Allows a full access to the system"></i>
                                                </td>
                                                <td>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" id="selectAll" />
                                                        <label class="form-check-label" for="selectAll"> {{ __("Select All") }}
                                                        </label>
                                                    </div>
                                                </td>
                                            </tr>
                                            @foreach ($permissions as $permission => $actions)
                                                <tr>
                                                    <td class="text-nowrap fw-medium">{{ $permission }}</td>
                                                    <td>
                                                        <div class="d-flex">
                                                            @foreach ($actions as $action)
                                                                <div class="form-check me-3 me-lg-5">
                                                                    <input class="form-check-input editPermission"
                                                                        name="permissions[]" value="{{ $action->id }}"
                                                                        type="checkbox" id="action{{ $action->id }}" />
                                                                    <label class="form-check-label"
                                                                        for="action{{ $action->id }}">
                                                                        {{ $action->name }}
                                                                    </label>
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach

                                        </tbody>
                                    </table>
                                </div>
                                <!-- Permission table -->
                            </div>
                            <div class="col-12 text-center">
                                <button type="submit" class="btn btn-primary me-sm-3 me-1">{{ __("Submit") }}</button>
                                <button type="reset" class="btn btn-outline-secondary" data-bs-dismiss="modal"
                                    aria-label="Close">
                                    {{ __("Cancel") }}
                                </button>
                            </div>
                        </form>
                        <!--/ Add role form -->
                    </div>
                </div>
            </div>
        </div>
        <!--/ edit Role Modal -->

        <!-- delete Role Modal -->
        <div class="modal fade" id="deleteRoleModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-add-new-role">
                <div class="modal-content p-3 p-md-5">
                    <button type="button" class="btn-close btn-pinned" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                    <div class="modal-body p-md-0">
                        <div class="text-center mb-4">
                            <h3 class="role-title mb-2 pb-0">{{ __("Delete Role") }}</h3>
                            <p>{{ __("Delete role permissions") }}</p>
                        </div>
                        <!-- Add role form -->
                        <form id="deleteRoleForm" class="row g-3" method="post">
                            @csrf
                            @method('DELETE')
                            <div class="col-12 text-center">
                                {{ __('Are you sure!') }}
                            </div>

                            <div class="col-12 text-center">
                                <button type="submit" class="btn btn-danger me-sm-3 me-1">{{ __("Submit") }}</button>
                                <button type="reset" class="btn btn-outline-secondary" data-bs-dismiss="modal"
                                    aria-label="Close">
                                    {{ __("Cancel") }}
                                </button>
                            </div>
                        </form>
                        <!--/ Add role form -->
                    </div>
                </div>
            </div>
        </div>
        <!--/ delete Role Modal -->




    </div>
    <!-- / Content -->
@endsection


@section('js')
    <!-- Vendors JS -->
    <script src="{{ asset('dashboard/assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js') }}"></script>

    <script src="{{ asset('dashboard/assets/vendor/libs/@form-validation/umd/bundle/popular.min.js') }}"></script>
    <script src="{{ asset('dashboard/assets/vendor/libs/@form-validation/umd/plugin-bootstrap5/index.min.js') }}"></script>
    <script src="{{ asset('dashboard/assets/vendor/libs/@form-validation/umd/plugin-auto-focus/index.min.js') }}"></script>

    <!-- Page JS -->
    <script src="{{ asset('dashboard/assets/js/app-access-roles.js') }}"></script>
    <script src="{{ asset('dashboard/assets/js/modal-add-role.js') }}"></script>

    <script>
        $(document).on('click', '.edit-role-btn', function() {
            var role_id = $(this).data('role-id');
            var role_name = $(this).data('role-name');
            var role_permissions = $(this).data('role-permissions');
            var url = $(this).data('update-url');

            $('#roleId').val(role_id)

            // Uncheck all inputs with class 'editPermission'
            $('.editPermission').prop('checked', false);

            // Loop through each input with class 'editPermission'
            $('.editPermission').each(function() {
                // Check if the input value is in the permissionsArray
                var permissionId = parseInt($(this).val());
                if (role_permissions.includes(permissionId)) {
                    $(this).prop('checked', true);
                }
            });

            $('#editRoleModal').modal('show');
            $('#editRoleForm').attr('action', url);
            $('#editRoleName').val(role_name);
            $('#editRolePermissions').val(role_permissions);
        });


        // delete role
        $(document).on('click', '.deleteRoleBtn', function(){
            let url = $(this).data('url');

            $('#deleteRoleForm').attr('action', url);
        })
    </script>
@endsection
