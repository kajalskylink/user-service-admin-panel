<x-admin.form-modal
    title="Update User"
    modal_id="update_user"
    :form_data="[
        'method' => 'POST',
        'action'=>'users.update',
        'id'=>'update_user_submit',
        'enctype'=>true,
        'update'=>true,
        'model'=>'user'
    ]">

    <div class="row">
        @php
            $profileImage = asset('img/default.jpeg');
        @endphp

        <x-admin.image-upload-form layout_size="12" title="Profile Picture" max_size="512 KB" sl="1" :existing_image="$profileImage"/>

        {{-- USER ID --}}
        <input type="hidden" name="user" id="edit_user">

        {{-- NAME --}}
        <div class="col-md-6">
            <div class="mb-3">
                <label class="form-label">Name <span class="text-danger"> *</span></label>
                <input type="text" class="form-control" name="name" id="edit_name" required>
            </div>
        </div>

        {{-- EMAIL --}}
        <div class="col-md-6">
            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" class="form-control" name="email" id="edit_email">
            </div>
        </div>

        {{-- PASSWORD --}}
        <div class="col-md-6">
            <div class="mb-3">
                <label class="form-label">Password</label>
                <input type="password" class="form-control" name="password" id="edit_password">
            </div>
        </div>

        {{-- CONFIRM PASSWORD --}}
        <div class="col-md-6">
            <div class="mb-3">
                <label class="form-label">Confirm Password</label>
                <input type="password" class="form-control" name="password_confirmation" id="edit_password_confirmation">
            </div>
        </div>

        {{--  MULTIPLE ROLES (SPATIE SAFE) --}}
        <div class="col-md-6">
            <div class="mb-3">
                <label class="form-label">Roles</label>
                <select class="select" name="roles[]" id="edit_role" multiple>
                    @foreach ($roles as $role)
                        {{-- USE ROLE NAME (Spatie Standard) --}}
                        <option value="{{ $role->name }}">{{ $role->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="col-md-6">
            <div class="mb-3">
                <label class="form-label">Status <span class="text-danger">*</span></label>
                <select class="select" name="is_active" id="edit_status">
                    <option value="1">Active</option>
                    <option value="0" selected>Inactive</option>
                </select>
            </div>
        </div>

    </div>
</x-admin.form-modal>
