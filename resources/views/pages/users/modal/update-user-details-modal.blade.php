<x-admin.form-modal
    title="Update User Details"
    modal_id="edit_user_details"
    :form_data="[
        'method' => 'POST',
        'action' => 'users.details.update',
        'id' => 'add_user_details_submit',
        'enctype' => true,
        'update' => true,
        'model' => 'user'
    ]"
>
    <div class="row">
        @php
            $profileImage = $user->image ? asset($user->image->path) : asset('img/default.jpeg');
        @endphp

        <x-admin.image-upload-form layout_size="12" title="Profile Picture" max_size="512 KB" sl="1" :existing_image="$profileImage"/>

        <input type="hidden" name="user" id="edit_user">

        <div class="col-md-6">
            <div class="mb-3">
                <label class="form-label">Name <span class="text-danger"> *</span></label>
                <input type="text" class="form-control" name="name" id="edit_user_name" required disabled>
            </div>
        </div>
        <div class="col-md-6">
            <div class="mb-3">
                <label class="form-label">Phone Number <span class="text-danger"> *</span></label>
                <input type="text" class="form-control" name="mobile_no" id="edit_user_mobile_no" required>
            </div>
        </div>
        <div class="col-md-6">
            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" class="form-control" name="email" id="edit_user_email" disabled>
            </div>
        </div>
        <div class="col-md-6">
            <div class="mb-3">
                <label class="form-label">NID</label>
                <input type="text" class="form-control" name="nid" id="edit_user_nid">
            </div>
        </div>

        <div class="col-md-6">
            <div class="mb-3">
                <label class="form-label">Designation</label>
                <input type="text" class="form-control" name="designation" id="edit_user_designation" maxlength="100">
            </div>
        </div>
        <div class="col-md-6">
            <div class="mb-3">
                <label class="form-label">Status <span class="text-danger"> *</span></label>
                <select class="select" name="status" id="edit_user_status">
                    <option value="1">Active</option>
                    <option value="0">In-Active</option>
                </select>
            </div>
        </div>
        <div class="col-md-12">
            <div class="mb-3">
                <label class="form-label">Address</label>
                <input type="text" class="form-control" name="address" id="edit_user_address">
            </div>
        </div>
        <div class="col-md-12">
            <div class="mb-3">
                <label class="form-label">Description</label>
                <textarea class="form-control" rows="3" name="note" id="edit_user_note"></textarea>
            </div>
        </div>
    </div>
</x-admin.form-modal>
