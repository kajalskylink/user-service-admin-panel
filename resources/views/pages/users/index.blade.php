<x-admin-layout>
    <div class="content">

        <x-admin.breadcrumb title="User List" route="users.index">
            <x-permission name="can-create-user">
                <x-admin.button button_id="add_user" button_name="Add User"/>
            </x-permission>
        </x-admin.breadcrumb>


        <div class="row mb-4">
            <x-admin.card-table title="User List" :headers="['#SL', 'Name', 'Email', 'Roles', 'Status', 'Action']" id="userTable">
                @foreach ($users as $user)
                    <tr>
                        <td>
                            <div class="form-check form-check-md">
                                <input class="form-check-input" type="checkbox">
                            </div>
                        </td>

                        <td>
                            <div class="d-flex align-items-center">
                                <a href="{{ route('dashboard') }}">{{ $user->name }}</a>
                                {{--  <span class="fs-12">{{ $user->address ?? 'N/A' }}</span>  --}}
                            </div>
                        </td>

                        <td>{{ $user->email ?? 'N/A' }}</td>

                        <td>{{ collect($user->roles)->pluck('name')->join(', ') ?: 'N/A' }}</td>

                        <td>
                            <span class="badge badge-{{ $user->is_active ? 'success' : 'danger' }} d-inline-flex align-items-center badge-xs">
                                <i class="ti ti-point-filled me-1"></i>{{ $user->is_active ? 'Active' : 'Inactive' }}
                            </span>
                        </td>

                        <td>
                            <div class="action-icon d-inline-flex">
                                <x-permission name="can-edit-user">
                                    <a href="#" class="me-2 edit"
                                       data-bs-toggle="modal"
                                       data-bs-target="#update_user"
                                       title="Update User"
                                       data-id="{{ $user->id }}"
                                       data-name="{{ $user->name }}"
                                       data-email="{{ $user->email }}"
                                       data-status="{{ $user->is_active }}"
                                       data-roles='@json(collect($user->roles ?? [])->pluck("name"))'
                                       data-image="{{ asset($user->image->path ?? 'img/default.jpeg') }}">
                                        <i class="ti ti-edit"></i>
                                    </a>
                                </x-permission>

                                <x-permission name="can-delete-user">
                                    <x-admin.delete
                                        :id="$user->id"
                                        target="users.destroy"
                                        msg="You want to delete this user, this can't be undone once you delete."
                                    />
                                </x-permission>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </x-admin.card-table>
        </div>
    </div>


    @include('pages.users.modal.add-user-modal')
    @include('pages.users.modal.update-user-modal')

    @push('scripts')
        <script>
            $(document).ready(function () {
                // Initialize Update User modal selects
                $('#update_user').on('shown.bs.modal', function () {
                    $('#edit_referrer_id').select2({
                        placeholder: "Select Introducer Email",
                        dropdownParent: $('#update_user')
                    });
                });

                $(document).on('click', '.edit', function () {

                    let id    = $(this).data('id');
                    let name  = $(this).data('name');
                    let email = $(this).data('email');
                    let roles = $(this).data('roles');
                    let image = $(this).data('image');
                    let status = $(this).data('status');

                    $('#edit_user').val(id);
                    $('#edit_name').val(name);
                    $('#edit_email').val(email);

                    $('#edit_role').val(roles).trigger('change');
                    $('#edit_status').val(status).trigger('change');

                    $('#edit_password').val('');
                    $('#edit_password_confirmation').val('');

                    $('#image_holder1').css({
                        "background-image": "url('" + image + "')",
                        "background-repeat": "no-repeat",
                        "background-size": "cover",
                        "background-position": "center"
                    });

                });



            });
        </script>
    @endpush
</x-admin-layout>
