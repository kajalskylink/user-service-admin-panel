@props(['button_id', 'button_name', 'route', 'parent_title' => null, 'parent_route' => null])

<div class="d-md-flex d-block align-items-center justify-content-between page-breadcrumb mb-3">
    <div class="my-auto mb-2">
        <h2 class="mb-1">{{ config('app.page_title', 'None') }}</h2>
        <nav>
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item">
                    <a href="{{ route('dashboard') }}"><i class="ti ti-smart-home"></i></a>
                </li>

                @if($parent_title && $parent_route)
                    <li class="breadcrumb-item">
                        <a href="{{ $parent_route }}">{{ $parent_title }}</a>
                    </li>
                @endif

                <li class="breadcrumb-item active">
                    {{ config('app.page_title', 'None') }}
                </li>
            </ol>
        </nav>
    </div>

    @if ((isset($button_id) || isset($route)) && isset($button_name))
        <div class="d-flex my-xl-auto right-content align-items-center flex-wrap ">
            <div class="mb-2">
                <a href="{{ $route ?? '#' }}" @if(isset($button_id)) data-bs-toggle="modal" data-bs-target="#{{ $button_id }}" @endif class="btn btn-primary d-flex align-items-center"><i class="ti ti-circle-plus me-2"></i>{{ $button_name}}</a>
            </div>
            <div class="head-icons ms-2">
                <a href="javascript:void(0);" class="" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-original-title="Collapse" id="collapse-header">
                    <i class="ti ti-chevrons-up"></i>
                </a>
            </div>
        </div>
    @endif
</div>

