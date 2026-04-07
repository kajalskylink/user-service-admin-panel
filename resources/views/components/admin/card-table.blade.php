{{--@props(['title', 'headers', 'datatable'])--}}
{{--<div class="card">--}}
{{--    <div class="card-header d-flex align-items-center justify-content-between flex-wrap row-gap-3">--}}
{{--        <h5>{{ $title ?? "" }}</h5>--}}
{{--    </div>--}}
{{--    <div class="card-body p-0">--}}
{{--        <div class="custom-datatable-filter table-responsive">--}}
{{--            <table class="table {{ !isset($datatable) ? 'datatable' : '' }}">--}}
{{--                <thead class="thead-light">--}}
{{--                <tr>--}}
{{--                    @foreach ($headers as $head)--}}
{{--                        <th>{{ $head }}</th>--}}
{{--                    @endforeach--}}
{{--                </tr>--}}
{{--                </thead>--}}
{{--                <tbody>--}}
{{--                {{ $slot }}--}}
{{--                </tbody>--}}
{{--            </table>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</div>--}}

@props(['title', 'headers', 'datatable'])
<div class="card">
    <div class="card-header d-flex align-items-center justify-content-between flex-wrap row-gap-3">
        <h5>{{ $title ?? '' }}</h5>
    </div>
    <div class="card-body p-0">
        <div class="custom-datatable-filter table-responsive">
            <table class="table {{ !isset($datatable) ? 'datatable' : '' }}">
                <thead class="thead-light">
                <tr>
                    @foreach ($headers as $head)
                        <th>{{ $head }}</th>
                    @endforeach
                </tr>
                </thead>
                <tbody>
                {{ $slot }}
                </tbody>
            </table>
        </div>
    </div>
</div>

@push('scripts')
    <script>
        $(document).ready(function() {
            function applyDatatableLengthSelectStyle(scope) {
                const $scope = scope ? $(scope) : $(document);

                $scope.find('.dataTables_length select').each(function() {
                    const $select = $(this);

                    if ($select.hasClass('select2-hidden-accessible')) {
                        return;
                    }

                    $select.addClass('select');

                    $select.select2({
                        minimumResultsForSearch: -1,
                        width: '72px',
                        dropdownAutoWidth: false
                    });
                });
            }

            applyDatatableLengthSelectStyle();

            $(document).on('draw.dt init.dt', function(e, settings) {
                if (settings && settings.nTableWrapper) {
                    applyDatatableLengthSelectStyle(settings.nTableWrapper);
                } else {
                    applyDatatableLengthSelectStyle();
                }
            });
        });
    </script>
@endpush
