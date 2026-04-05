{{-- Add Contact Info Modal --}}
<x-admin.form-modal
    title="Add Permission"
    modal_id="add_permission"
    :form_data="[
        'method' => 'POST',
        'model' => 'permission',
        'enctype' => false,
        'id' => 'add_permission_submit',
        'action' => 'permissions.store'
    ]">

    <div class="row">
        <div class="col-12 mb-3">
            <label class="form-label">Name <span class="text-danger">*</span></label>
            <input type="text" class="form-control" name="name" id="add_name">
        </div>

        <div class="col-md-12 mb-3">
            <label class="form-label">Group Name <span class="text-danger">*</span></label>

            <select class="form-select" id="group_select">
                <option value="">Select Existing Group</option>
                @foreach ($groups as $group)
                    <option value="{{ $group->group_name }}">{{ $group->group_name }}</option>
                @endforeach
                <option value="__new__">➕ Create New Group</option>
            </select>

            <input
                type="text"
                class="form-control mt-2 d-none"
                id="group_input"
                placeholder="Enter new group name"
            >

            <!-- Hidden field that actually gets submitted -->
            <input type="hidden" name="group_name" id="group_name">
        </div>

    </div>

</x-admin.form-modal>
