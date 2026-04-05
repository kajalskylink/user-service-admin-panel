<x-admin-layout>
    <div class="content">

        {{-- Breadcrumb --}}
        <x-admin.breadcrumb title="Role List" route="roles.index">
            <x-permission name="can-create-role">
                <x-admin.button :route="route('roles.create')" button_name="Add Role"/>
            </x-permission>
        </x-admin.breadcrumb>

        {{-- Roles Table --}}
        <x-admin.card-table
            title="Roles List"
            :headers="['#', 'Role Name', 'Permissions Count', 'Status', 'Action']"
        >
            @forelse ($roles as $index => $role)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>
                        <h6 class="fw-medium text-gray-9">{{ data_get($role, 'name') }}</h6>
                    </td>
                    <td>
                        <span class="badge bg-outline-primary">{{ count(data_get($role, 'permissions', [])) }} Permissions</span>
                    </td>
                    <td>
                        <div class="form-check form-switch">
                            <input class="form-check-input status-toggle" type="checkbox" role="switch"
                                data-id="{{ data_get($role, 'id') }}" {{ data_get($role, 'is_active') ? 'checked' : '' }}>
                        </div>
                    </td>
                    <td>
                        <div class="action-icon d-inline-flex">
                            <x-permission name="can-edit-role">
                                <a href="{{ route('roles.edit', data_get($role, 'id')) }}" class="me-2">
                                    <i class="ti ti-edit"></i>
                                </a>
                            </x-permission>

                            @if(data_get($role, 'name') !== 'Super Admin')
                                <x-permission name="can-delete-role">
                                    <x-admin.delete :id="data_get($role, 'id')" target="roles.destroy" msg="Are you sure you want to delete this role?" />
                                </x-permission>
                            @endif
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center py-3">No roles found.</td>
                </tr>
            @endforelse
        </x-admin.card-table>
    </div>

    @push('scripts')
        <script>
            $(document).ready(function () {
                // Edit Role Handler

                // Status Toggle Handler
                $(document).on('change', '.status-toggle', function() {
                    let id = $(this).data('id');
                    let isActive = $(this).is(':checked') ? 1 : 0;

                    $.ajax({
                        url: `{{ url('roles') }}/${id}/change-status`,
                        type: 'PATCH',
                        data: {
                            _token: '{{ csrf_token() }}',
                            is_active: isActive
                        },
                        success: function(response) {
                            toastr.success(response.message || "Status updated.");
                        },
                        error: function(xhr) {
                            toastr.error("Failed to update status.");
                            // Revert toggle if failed
                            $(this).prop('checked', !isActive);
                        }
                    });
                });

                // Select All Group Permissions
                $('.select-group').on('change', function() {
                    let group = $(this).data('group');
                    let isChecked = $(this).is(':checked');
                    $(`.perm-group-${group}`).prop('checked', isChecked);
                });
            });
        </script>
    @endpush
</x-admin-layout>
