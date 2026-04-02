@props(['modal_id', 'title', 'form_data', 'btn_data', 'no_footer' => false])
@php
    $model = isset($form_data['model']) ? $form_data['model'] : '';
@endphp

<!-- Form Modal -->
<div class="modal fade" id="{{ $modal_id }}">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                @if(isset($title))
                <div class="d-flex align-items-center">
                    <h4 class="modal-title me-2">{{ $title}}</h4>
                </div>
                @endif
                <button type="button" class="btn-close custom-btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <i class="ti ti-x"></i>
                </button>
            </div>
            @if (isset($form_data))
                <form
                    action=""
                    method="{{ isset($form_data['method']) ? $form_data['method'] : 'POST' }}"
                    enctype="{{ isset($form_data['enctype']) && $form_data['enctype'] ? 'multipart/form-data' : '' }}"
                    id="{{ isset($form_data['id']) ? $form_data['id'] : '' }}">
                    @csrf
                    @method(isset($form_data['method']) ? $form_data['method'] : 'POST')
                    @if(isset($form_data['update']) && $form_data['update'])
                        <input type="hidden" name="id" id="edit_{{ $model }}">
                    @endif
            @endif
                <div class="modal-body pb-0 ">
                    {{ $slot }}
                </div>
                    @if(!$no_footer)
                        <div class="modal-footer">
                            <button type="button" class="btn btn-outline-light border me-2" data-bs-dismiss="modal">
                                {{ isset($btn) && $btn['cancel'] ?  $btn['cancel'] : 'Cancel' }}
                            </button>

                            <button type="submit" class="btn btn-primary">
                                {{ isset($btn) && $btn['name'] ? $btn['name'] : 'Save' }}
                            </button>
                        </div>
                    @endif

                @if (isset($form_data)) </form> @endif
        </div>
    </div>
</div>
<!-- /Form Modal -->

@push('scripts')

<!-- JavaScript -->
<script>
    $(document).ready(function() {
        @if(isset($form_data) && isset($form_data['id']))
            let form = $("#{{ $form_data['id'] }}");
            @if(isset($form_data['update']) && $model != '')
                form.on('submit', (e)=>{
                    e.preventDefault();
                    let id = $('#edit_{{ $model }}').val();
                    let actionUrl = "{{ isset($form_data['action'], $model) ? route($form_data['action'], [$model => ':id']) : '' }}".replace(':id', id);
                    form.attr('action', actionUrl);
                    form.off('submit').submit();
                });
            @else
                form.on('submit', (e)=>{
                    e.preventDefault();
                    let actionUrl = "{{ isset($form_data['action']) ? route($form_data['action']) : '' }}";
                    form.attr('action',  actionUrl);
                    form.off('submit').submit();
                });
            @endif
        @endif
    });
</script>
@endpush
