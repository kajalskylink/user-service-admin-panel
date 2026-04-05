<x-admin-layout>
    <div class="content">
        {{-- Breadcrumb --}}
        <x-admin.breadcrumb parent_title="Role List" :parent_route="route('roles.index')" title="Edit Role" route="roles.index" />

        <div class="row">
            <div class="col-md-12">
                <div class="card shadow-sm border-0">
                    <div class="card-header bg-white border-bottom py-3">
                        <h4 class="card-title mb-0 fw-bold text-gray-9">Edit Role</h4>
                    </div>
                    <form action="{{ route('roles.update', data_get($role, 'id')) }}" method="POST">
                        @csrf
                        <div class="card-body">
                            <div class="mb-4">
                                <label class="form-label fw-bold text-gray-9 fs-14">Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="name" value="{{ data_get($role, 'name') }}" required placeholder="Enter role name">
                            </div>

                            <div class="table-responsive border rounded">
                                <table class="table mb-0 align-middle">
                                    <thead class="bg-light">
                                        <tr>
                                            <th class="py-3 px-4 fw-bold text-dark border-0">Administrator Access</th>
                                            <th class="py-3 px-4 text-end border-0">
                                                <div class="form-check d-inline-block">
                                                    <input class="form-check-input me-1" type="checkbox" id="selectAllPermissions">
                                                    <label class="form-check-label fw-semibold text-gray-9 cursor-pointer" for="selectAllPermissions">Select All</label>
                                                </div>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $groupedPermissions = $permissions;
                                        @endphp

                                        @foreach ($groupedPermissions as $groupName => $perms)
                                            <tr class="border-top">
                                                <td class="py-4 px-4 fw-bold text-gray-8 align-top" style="width: 30%;">
                                                    {{ ucwords(str_replace(['_', '-'], ' ', $groupName)) }}
                                                </td>
                                                <td class="py-4 px-4">
                                                    <div class="d-flex flex-column gap-3">
                                                        @foreach ($perms as $perm)
                                                            <div class="form-check">
                                                                <input class="form-check-input perm-group-{{ $groupName }} permission-checkbox"
                                                                       type="checkbox" name="permission_ids[]" value="{{ data_get($perm, 'name') }}"
                                                                       id="perm_{{ data_get($perm, 'id') }}"
                                                                       {{ in_array(data_get($perm, 'id'), $currentRolePermissions ?? []) || in_array(data_get($perm, 'name'), $currentRolePermissions ?? []) ? 'checked' : '' }}>
                                                                <label class="form-check-label fs-13 text-secondary ms-1 cursor-pointer w-100" for="perm_{{ data_get($perm, 'id') }}">
                                                                    {{ ucwords(str_replace(['can-', '-', '_'], ['', ' ', ' '], data_get($perm, 'name', ''))) }}
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
                        </div>
                        <div class="card-footer bg-white py-4 d-flex justify-content-end border-top">
                            <a href="{{ route('roles.index') }}" class="btn btn-outline-light border text-dark me-2 d-flex align-items-center px-4">
                                <i class="ti ti-arrow-left me-1"></i> Back to List
                            </a>
                            <button type="submit" class="btn btn-primary px-4 d-flex align-items-center bg-orange border-orange">
                                <i class="ti ti-device-floppy me-2"></i> Save Changes
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            $(document).ready(function() {
                // Select All Master Toggle
                $('#selectAllPermissions').on('change', function() {
                    let isChecked = $(this).is(':checked');
                    $('.permission-checkbox').prop('checked', isChecked);
                });

                // Sync Select All
                $('.permission-checkbox').on('change', function() {
                    let total = $('.permission-checkbox').length;
                    let checked = $('.permission-checkbox:checked').length;
                    $('#selectAllPermissions').prop('checked', total === checked && total > 0);
                });

                // Initial Sync
                let total = $('.permission-checkbox').length;
                let checked = $('.permission-checkbox:checked').length;
                $('#selectAllPermissions').prop('checked', total === checked && total > 0);
            });
        </script>
    @endpush

    <style>
        .bg-orange { background-color: #f16f31 !important; color: white !important; }
        .border-orange { border-color: #f16f31 !important; }
        .bg-orange:hover { background-color: #d65a22 !important; }
        .table > :not(caption) > * > * { border-bottom-width: 0; }
        .form-check-input:checked { background-color: #f16f31; border-color: #f16f31; }
    </style>
</x-admin-layout>
