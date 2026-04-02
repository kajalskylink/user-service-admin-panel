<x-admin-layout>
    <div class="content">

        {{-- Breadcrumb --}}
        <x-admin.breadcrumb title="Permission List" route="permission.create">
                <x-admin.button button_id="add_permission" button_name="Add Permission"/>
        </x-admin.breadcrumb>

        {{-- Permissions Table --}}
        <x-admin.card-table
            title="Roles & Permissions List"
            :headers="['#', 'Permission Name', 'Guard Name', 'Group Name', 'Status', 'Action']"
        >
            @forelse ($permissions as $index => $permission)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $permission->name ?? '-' }}</td>
                    <td>{{ $permission->guard_name ?? '-' }}</td>
                    <td>{{ $permission->group_name ?? '-' }}</td>
                    <td>
                        @if($permission->is_active)
                            <span class="badge bg-success">Active</span>
                        @else
                            <span class="badge bg-danger">Inactive</span>
                        @endif
                    </td>
                    <td>
                        <x-admin.delete :id="$permission->id" target="permissions.destroy" msg="You want to delete the permission, this can't be undone once you delete." />
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center py-3">No roles or permissions found.</td>
                </tr>
            @endforelse
        </x-admin.card-table>

    </div>
</x-admin-layout>
