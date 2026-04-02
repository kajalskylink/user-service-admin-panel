<x-admin-layout>
    <div class="content">

        {{-- Breadcrumb --}}
        <x-admin.breadcrumb
            button_name="Add User"
            :route="route('users.create')"
            :parent_route="route('dashboard')"
        />

        {{-- Users Table --}}
        <x-admin.card-table
            title="Users List"
            :headers="['#', 'Name', 'Email', 'Role', 'Status', 'Action']"
        >
            @forelse ($users as $index => $user)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $user->name ?? 'N/A' }}</td>
                    <td>{{ $user->email ?? 'N/A' }}</td>
                    <td>{{ $user->role ?? 'User' }}</td>
                    <td>
                        <span class="badge bg-success-transparent">Active</span>
                    </td>
                    <td>
                        <a href="javascript:void(0);"
                            class="delete_modal btn btn-sm p-0 border-0"
                            style="background:none; font-size:15px;"
                            data-id="{{ $user->id ?? '' }}">
                            <i class="ti ti-trash text-danger"></i>
                        </a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center py-3">No users found.</td>
                </tr>
            @endforelse
        </x-admin.card-table>

        {{-- Delete Confirmation Modal --}}
        <x-admin.delete
            :target="'users.destroy'"
            :model="'id'"
            msg="Are you sure you want to delete this user? This action cannot be undone."
        />

    </div>
</x-admin-layout>
