<x-admin.form-modal
    title="Update Permission"
    modal_id="update_permission"
    :form_data="[
        'method' => 'POST',
        'model' => 'permission',
        'enctype' => false,
        'update' => 'true',
        'id' => 'update_permission_submit',
        'action' => 'permissions.update'
    ]">

    <div class="row">
        <div class="col-12 mb-3">
            <label class="form-label">Name <span class="text-danger">*</span></label>
            <input type="text" class="form-control" name="name" id="edit_name" required>
        </div>

        <div class="col-md-12 mb-3">
            <label class="form-label">Group Name <span class="text-danger">*</span></label>

            <select class="form-select" id="edit_group_select">
                <option value="">Select Existing Group</option>
                @foreach ($groups as $group)
                    <option value="{{ $group->group_name }}">{{ $group->group_name }}</option>
                @endforeach
                <option value="__new__">➕ Create New Group</option>
            </select>

            <input type="text"
                class="form-control mt-2 d-none"
                id="edit_group_input"
                placeholder="Enter new group name">

            <input type="hidden" name="group_name" id="edit_group_name">
        </div>

        <div class="col-12 mb-3">
            <label class="form-label">Status <span class="text-danger">*</span></label>
            <select class="form-select" name="is_active" id="edit_is_active" required>
                <option value="1">Active</option>
                <option value="0">Inactive</option>
            </select>
        </div>
    </div>

</x-admin.form-modal>
