{{--  <!-- Delete Modal -->
<div class="modal fade" id="delete_modal{{ $id ?? '' }}">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body text-center">
                <span class="avatar avatar-xl bg-transparent-danger text-danger mb-3">
                    <i class="ti ti-trash-x fs-36"></i>
                </span>
                <h4 class="mb-1">Confirm Delete</h4>
                <p class="mb-3">{{ $msg }}</p>
                <form action="" method="POST" id="delete_item{{ $id ?? '' }}">
                    @csrf
                    @method('POST')
                    <input type="hidden" id="delete_id{{ $id ?? '' }}" name="id">
                </form>
                <div class="d-flex justify-content-center">
                    <a href="javascript:void(0);" class="btn btn-light me-3" data-bs-dismiss="modal">Cancel</a>
                    <a href="#" id="delete_submit{{ $id ?? '' }}" class="btn btn-danger" >Yes, Delete</a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- \Delete Modal -->
 @push('scripts')
<script>
    $(document).ready(()=>{
        $('.delete_modal').on('click', function () {
            let id = $(this).data('id');
            $('#delete_id{{ $id ?? '' }}').val(id);
        });

        $('#delete_submit{{ $id ?? '' }}').on('click', function (event) {
            event.preventDefault();
            let id = $('#delete_id{{ $id ?? '' }}').val();
            let form = $("#delete_item{{ $id ?? '' }}");
            let actionUrl = "{{ route($target, [$model=>':id']) }}".replace(':id', id);
            form.attr('action', actionUrl);
            form.off('submit').submit();
        });
    });
</script>
@endpush  --}}

<!-- Delete Modal -->
<div class="modal fade" id="delete_modal">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body text-center">
                <span class="avatar avatar-xl bg-transparent-danger text-danger mb-3">
                    <i class="ti ti-trash-x fs-36"></i>
                </span>
                <h4 class="mb-1">Confirm Delete</h4>
                <p class="mb-3" id="delete_msg">{{ $msg ?? 'Are you sure?' }}</p>
                <form action="" method="POST" id="delete_item" data-action-template="{{ route($target, [$model=>':id']) }}">
                    @csrf
                    @method('DELETE')
                    <input type="hidden" id="delete_id" name="id">
                </form>
                <div class="d-flex justify-content-center">
                    <a href="javascript:void(0);" class="btn btn-light me-3" data-bs-dismiss="modal">Cancel</a>
                    <a href="#" id="delete_submit" class="btn btn-danger">Yes, Delete</a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Delete Modal -->

@push('scripts')
	<script>
		$(document).ready(function () {

			// Open modal dynamically
			$(document).on('click', '.delete_modal', function () {
				let id = $(this).data('id');
				$('#delete_id').val(id); // Use a single modal input
				$('#delete_modal').modal('show');
			});

			// Submit delete form dynamically
			$(document).on('click', '#delete_submit', function (event) {
				event.preventDefault();
				let id = $('#delete_id').val();
				let form = $("#delete_item");
				let actionUrl = $(form).data('action-template').replace(':id', id);
				form.attr('action', actionUrl);
				form.submit();
			});

		});

	</script>
@endpush

