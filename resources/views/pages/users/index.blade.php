<x-admin-layout>
    <div class="content">

        {{-- Breadcrumb --}}
        <x-admin.breadcrumb title="User List" route="users.create">
            <x-admin.button button_id="add_user" button_name="Add User"/>
        </x-admin.breadcrumb>

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
                        <x-admin.delete :id="$user->id" target="users.destroy" msg="Are you sure you want to delete this user? This action cannot be undone." />
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center py-3">No users found.</td>
                </tr>
            @endforelse
        </x-admin.card-table>


    </div>
</x-admin-layout>
