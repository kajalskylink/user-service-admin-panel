@props(['title', 'headers', 'datatable'])
<div class="card">
    <div class="card-header d-flex align-items-center justify-content-between flex-wrap row-gap-3">
        <h5>{{ $title ?? "" }}</h5>
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
