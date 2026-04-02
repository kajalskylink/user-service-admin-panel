<x-admin-layout>
    <div class="content">

        {{-- Breadcrumb --}}
        <x-admin.breadcrumb
            button_name="Add Permission"
            button_id="add_permission"
            :parent_route="route('dashboard')"
        />

        {{-- Permissions Table --}}
        <x-admin.card-table
            title="Roles & Permissions List"
            :headers="['#', 'Role Name', 'Description', 'Status', 'Action']"
        >
            @forelse ($permissions as $index => $permission)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $permission->name ?? 'N/A' }}</td>
                    <td>{{ $permission->description ?? 'N/A' }}</td>
                    <td>
                        <span class="badge bg-success-transparent">Active</span>
                    </td>
                    <td>
                        <a href="javascript:void(0);"
                            class="delete_modal btn btn-sm p-0 border-0"
                            style="background:none; font-size:12px;"
                            data-id="{{ $permission->id ?? '' }}">
                            <i class="ti ti-trash text-danger"></i>
                        </a>
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
