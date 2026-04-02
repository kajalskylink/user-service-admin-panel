@props(['title' => null, 'parent_title' => null, 'parent_route' => null, 'parent_icon' => 'ti ti-smart-home'])

<div class="d-md-flex d-block align-items-center justify-content-between page-breadcrumb mb-3">
    <div class="my-auto mb-2">
        <h2 class="mb-1">{{ $title ?? config('app.page_title', 'None') }}</h2>
        <nav>
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item">
                    <a href="{{ route('dashboard') }}"><i class="{{ $parent_icon }}"></i></a>
                </li>

                @if($parent_title && $parent_route)
                    <li class="breadcrumb-item">
                        <a href="{{ $parent_route }}">{{ $parent_title }}</a>
                    </li>
                @endif

                <li class="breadcrumb-item active">
                    {{ $title ?? config('app.page_title', 'None') }}
                </li>
            </ol>
        </nav>
    </div>

    {{ $slot }}
</div>

