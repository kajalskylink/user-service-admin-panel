<x-admin.form-modal
    title="Add New User"
    modal_id="add_user"
    :form_data="[
        'method' => 'POST',
        'model' => 'user',
        'enctype' => true,
        'id' => 'add_user_submit',
        'action' => 'users.store'
    ]">

    <div class="row">

        <x-admin.image-upload-form title="Media Images" max_size="512 KB" sl="1"/>

        <div class="col-md-6">
            <div class="mb-3">
                <label class="form-label">Name <span class="text-danger"> *</span></label>
                <input type="text" class="form-control" name="name" id="name" required>
            </div>
        </div>

        <div class="col-md-6">
            <div class="mb-3">
                <label class="form-label">Email <span class="text-danger"> *</span></label>
                <input type="email" class="form-control" name="email" id="email">
            </div>
        </div>

        <div class="col-md-6">
            <div class="mb-3">
                <label class="form-label">Password <span class="text-danger"> *</span></label>
                <input type="password" class="form-control" name="password" id="password">
            </div>
        </div>

        <div class="col-md-6">
            <div class="mb-3">
                <label class="form-label">Confirm Password <span class="text-danger"> *</span></label>
                <input type="password" class="form-control" name="password_confirmation" id="password_confirmation">
            </div>
        </div>

        <div class="col-md-6">
            <div class="mb-3">
                <label class="form-label">Roles</label>
                <select class="select" name="roles[]" id="roles" multiple>
                    @foreach ($roles as $role)
                        <option value="{{ $role->name }}">{{ $role->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="col-md-6">
            <div class="mb-3">
                <label class="form-label">Status <span class="text-danger">*</span></label>
                <select class="select" name="is_active" id="status">
                    <option value="1">Active</option>
                    <option value="0" selected>Inactive</option>
                </select>
            </div>
        </div>
    </div>

</x-admin.form-modal>
