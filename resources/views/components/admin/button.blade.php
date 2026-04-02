{{--  @props(['button_id' => null, 'route' => '#', 'button_name'])

<div class="d-flex my-xl-auto right-content align-items-center flex-wrap ">
    <div class="mb-2">
        <a href="{{ $route }}"
           @if($button_id) data-bs-toggle="modal" data-bs-target="#{{ $button_id }}" @endif
           class="btn btn-primary d-flex align-items-center">
            <i class="ti ti-circle-plus me-2"></i>{{ $button_name }}
        </a>
    </div>
    <div class="head-icons ms-2">
        <a href="javascript:void(0);" class="" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-original-title="Collapse" id="collapse-header">
            <i class="ti ti-chevrons-up"></i>
        </a>
    </div>
</div>  --}}

@props(['button_id' => null, 'route' => '#', 'button_name'])

<div class="d-flex my-xl-auto right-content align-items-center flex-wrap ">
    <div class="mb-2">
        @if($button_id)
            <!-- Modal button -->
            <button type="button" class="btn btn-primary d-flex align-items-center"
                    data-bs-toggle="modal" data-bs-target="#{{ $button_id }}">
                <i class="ti ti-circle-plus me-2"></i>{{ $button_name }}
            </button>
        @else
            <!-- Normal link button -->
            <a href="{{ $route }}" class="btn btn-primary d-flex align-items-center">
                <i class="ti ti-circle-plus me-2"></i>{{ $button_name }}
            </a>
        @endif
    </div>
    <div class="head-icons ms-2">
        <a href="javascript:void(0);" class="" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-original-title="Collapse" id="collapse-header">
            <i class="ti ti-chevrons-up"></i>
        </a>
    </div>
</div>
