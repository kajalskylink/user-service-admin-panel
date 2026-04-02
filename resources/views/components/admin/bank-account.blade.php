@props(['parent', 'type', 'update'])
@php
    $is_up = isset($update);
    $edit = $is_up ? 'edit_' : '';
@endphp
<x-admin.form-modal title="{{ $is_up ? 'Update' : 'Add' }} Bank Info" modal_id="{{ $is_up ? 'update' : 'add' }}_bank" :form_data="['action'=>'bank.'.($is_up ? 'update' : 'add'), 'id'=>($is_up ? 'update' : 'add').'_bank_submit', 'enctype'=>true, 'model'=>'bank_account', 'update'=>$is_up]">
    <div class="row">
        <input type="hidden" name="parent_id" value="{{ $parent }}"/>
        <input type="hidden" name="parent_type" value="{{ $type }}"/>

        <div class="col-md-6">
            <div class="mb-3">
                <label class="form-label">Account/Card Number <span class="text-danger"> *</span></label>
                <input type="decimal" class="form-control" name="acc_no" id="{{ $edit }}acc_no" minlength="11" maxlength="16" required>
            </div>									
        </div>
        <div class="col-md-6">
            <div class="mb-3">
                <label class="form-label">Account Name</label>
                <input type="text" class="form-control" name="name" id="{{ $edit }}acc_name">
            </div>									
        </div>
        <div class="col-md-5">
            <div class="mb-3">
                <label class="form-label">Bank Name <span class="text-danger"> *</span></label>
                <input type="text" class="form-control" name="bank_name" id="{{ $edit }}bank_name" required>
            </div>									
        </div>
        <div class="col-md-4">
            <div class="mb-3">
                <label class="form-label">Branch</label>
                <input type="text" class="form-control" name="branch" id="{{ $edit }}branch">
            </div>									
        </div>
        <div class="col-md-3">
            <div class="mb-3">
                <label class="form-label">Branch Code</label>
                <input type="text" class="form-control" name="branch_code" id="{{ $edit }}branch_code" maxlength="15">
            </div>									
        </div>
        <div class="col-md-5">
            <div class="mb-3">
                <label class="form-label">Issue Date (MM/YY)</label>
                <input type="text" class="form-control" name="issue" id="{{ $edit }}issue" maxlength="5">
            </div>									
        </div>
        <div class="col-md-5">
            <div class="mb-3">
                <label class="form-label">Expire Date (MM/YY)</label>
                <input type="text" class="form-control" name="expire" id="{{ $edit }}expire" maxlength="5" pattern="\d{2}/\d{2}" >
            </div>									
        </div>
        <div class="col-md-2">
            <div class="mb-3">
                <label class="form-label">CVV</label>
                <input type="decimal" class="form-control" name="cvv" id="{{ $edit }}cvv" maxlength="3">
            </div>									
        </div>
        <div class="col-md-6">
            <div class="mb-3">
                <label class="form-label">Account Type <span class="text-danger"> *</span></label>
                <select class="select" name="type" id="{{ $edit }}acc_type" required>
                    <option value="1">Savings Account</option>
                    <option value="2">Visa Credit Card</option>
                    <option value="3">Master Credit Card</option>
                    <option value="4">Visa Dedit Card</option>
                    <option value="5">Master Dedit Card</option>
                    <option value="6">Bkash</option>
                    <option value="7">Nagad</option>
                    <option value="8">Rocket</option>
                    <option value="9">Upay</option>
                </select>
            </div>		
        </div>
    </div>
</x-admin.form-modal>

@if($is_up)
    @push('scripts')
        <script>
            $(document).ready(function(){
                $('.edit_bank_acc').on('click', function () {
                    let id = $(this).data('id');
                    let acc_no = $(this).data('acc_no');
                    let acc_name = $(this).data('acc_name');
                    let bank_name = $(this).data('bank_name');
                    let branch = $(this).data('branch');
                    let branch_code = $(this).data('branch_code');
                    let issue = $(this).data('issue');
                    let expire = $(this).data('expire');
                    let cvv = $(this).data('cvv');
                    let acc_type = $(this).data('acc_type');

                    $('#edit_bank_account').val(id);
                    $('#edit_acc_no').val(acc_no);
                    $('#edit_acc_name').val(acc_name);
                    $('#edit_bank_name').val(bank_name);
                    $('#edit_branch').val(branch);
                    $('#edit_branch_code').val(branch_code);
                    $('#edit_issue').val(issue);
                    $('#edit_expire').val(expire);
                    $('#edit_cvv').val(cvv);
                    $('#edit_acc_type').val(acc_type).trigger('change');
                });
            });	
        </script>
    @endpush    
@endif