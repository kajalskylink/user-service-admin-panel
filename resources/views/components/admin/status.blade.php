<!-- Status Modal -->
<div class="modal fade" id="status_modal">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body text-center">
                <span class="avatar avatar-xl bg-transparent-success text-success mb-3">
                    <i class="ti ti-check fs-36"></i>
                </span>
                <h4 class="mb-1" id="status_modal_title">Confirm Status Change</h4>
                <p class="mb-3" id="status_modal_msg">Are you sure you want to change the status?</p>
                <form action="" method="POST" id="status_form">
                    @csrf
                    @method('PATCH')
                    <input type="hidden" name="status" id="status_input">
                </form>
                <div class="d-flex justify-content-center">
                    <a href="javascript:void(0);" class="btn btn-light me-3" data-bs-dismiss="modal">Cancel</a>
                    <a href="#" class="btn btn-success" id="status_submit_btn">Yes, Confirm</a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- \Status Modal -->
