@props(['layout_size', 'title', 'max_size', 'name', 'multiple', 'sl', 'existing_image' => null])

<div class="col-md-{{ $layout_size ?? 12 }}">
    <div class="d-flex align-items-center flex-wrap row-gap-3 bg-light w-100 rounded p-3 mb-4">
        <div id="image_holder{{ $sl ?? ''}}" class="d-flex align-items-center justify-content-center avatar avatar-xxl rounded-circle border border-dashed me-2 flex-shrink-0 text-dark frames"
            @if($existing_image)
                style="background-image: url('{{ asset($existing_image) }}'); background-repeat: no-repeat; background-size: cover; background-position: center;"
            @endif
        >
            @if(!$existing_image)
                <i class="ti ti-photo text-gray-2 fs-16"></i>
            @endif
        </div>
        <div class="profile-upload">
            <div class="mb-2">
                <h6 class="mb-1">Upload {{ $title }}</h6>
                <p class="fs-12">Image should be below {{ $max_size ?? '4 mb' }}</p>
            </div>
            <div class="profile-uploader d-flex align-items-center">
                <div class="drag-upload-btn btn btn-sm btn-primary me-2">
                    Upload
                    <input type="file" class="form-control image-sign" name="{{ isset($multiple) ? (isset($name) ? $name.'[]' : 'images[]') : $name ?? 'image' }}" {{ $multiple ?? '' }} id="image_select_input{{ $sl ?? ''}}">
                </div>
                <a href="javascript:void(0);" class="btn btn-light btn-sm">Cancel</a>
            </div>
        </div>
    </div>
    <div id="more_image{{ $sl ?? ''}}"></div>
</div>

@push('scripts')
    <script>
        $(document).ready(()=>{
            const input = $("#image_select_input{{ $sl ?? ''}}");
            const holder = $("#image_holder{{ $sl ?? ''}}");
            const more = $('#more_image{{ $sl ?? ''}}');

            input.on('change', (e)=>{
                let images = e.target.files;
                holder.removeAttr('style');
                more.empty();

                if(images.length > 1){
                    selectedFiles = Array.from(e.target.files);
                    renderPreviews("more_image{{ $sl ?? ''}}", "image_select_input{{ $sl ?? ''}}");
                }else{
                    if (images[0]) {
                        const reader = new FileReader();
                        reader.onload = function(e) {
                            holder.css({
                                "background-image": "url('" + e.target.result + "')",
                                "background-repeat": "no-repeat",
                                "background-size": "cover",
                                "background-position": "center"
                            });
                        };
                        reader.readAsDataURL(images[0]);
                    }
                }
            });
        });
    </script>
@endpush
