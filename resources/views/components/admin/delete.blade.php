@props(['id', 'target', 'msg' => 'You want to delete this item, this can\'t be undone once you delete.'])

@php
    $actionUrl = route($target, $id);
@endphp

<a href="javascript:void(0);" class="btn-delete btn btn-sm p-0 border-0" style="background:none; font-size:15px;" data-action="{{ $actionUrl }}" data-msg="{{ $msg }}">
    <i class="ti ti-trash text-danger"></i>
</a>

@once
    @push('scripts')
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            $(document).ready(function () {
                $(document).on('click', '.btn-delete', function (event) {
                    event.preventDefault();
                    let actionUrl = $(this).data('action');
                    let msg = $(this).data('msg');

                    Swal.fire({
                        html: `
                            <div class="text-center mt-2">
                                <span class="avatar avatar-xl bg-transparent-danger text-danger mb-3" style="width: 4rem; height: 4rem; display: inline-flex; align-items: center; justify-content: center; border-radius: 50%;">
                                    <i class="ti ti-trash-x fs-36" style="font-size: 36px;"></i>
                                </span>
                                <h4 class="mb-1">Confirm Delete</h4>
                                <p class="mb-3">${msg}</p>
                            </div>
                        `,
                        showCancelButton: true,
                        reverseButtons: true, // Output Cancel on Left, Confirm on Right
                        confirmButtonText: 'Yes, Delete',
                        cancelButtonText: 'Cancel',
                        customClass: {
                            confirmButton: 'btn btn-danger',
                            cancelButton: 'btn btn-light me-3',
                            actions: 'mt-0 mb-2' 
                        },
                        buttonsStyling: false
                    }).then((result) => {
                        if (result.isConfirmed) {
                            let form = $('<form>', {
                                'method': 'POST',
                                'action': actionUrl
                            });

                            let token = $('<input>', {
                                'type': 'hidden',
                                'name': '_token',
                                'value': '{{ csrf_token() }}'
                            });

                            let method = $('<input>', {
                                'type': 'hidden',
                                'name': '_method',
                                'value': 'DELETE'
                            });

                            form.append(token, method);
                            $('body').append(form);
                            form.submit();
                        }
                    });
                });
            });
        </script>
    @endpush
@endonce
