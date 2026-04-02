@props(['fields' => [], 'route' => '', 'title' => 'Filters'])

<div class="card mb-3 border-0 shadow-sm">
    <div class="card-body">
        <form action="{{ route($route) }}" method="GET" id="filter-form">
            <div class="d-flex flex-wrap align-items-end gap-2">

                @foreach ($fields as $field)
                    <div class="flex-fill" style="min-width: 200px;">
                        <label class="form-label fw-bold small text-uppercase">{{ $field['label'] }}</label>

                        @if ($field['type'] === 'select')
                            <select name="{{ $field['name'] }}" class="form-select select w-100">
                                <option value="">{{ $field['placeholder'] ?? 'Select All' }}</option>
                                @foreach ($field['options'] as $value => $label)
                                    <option value="{{ $value }}"
                                        {{ request($field['name']) == $value ? 'selected' : '' }}>
                                        {{ $label }}
                                    </option>
                                @endforeach
                            </select>
                        @elseif($field['type'] === 'textarea')
                            <textarea name="{{ $field['name'] }}" class="form-control w-100" rows="1">{{ request($field['name']) }}</textarea>
                        @else
                            <input type="{{ $field['type'] }}" name="{{ $field['name'] }}"
                                value="{{ request($field['name']) }}"
                                class="form-control w-100
                                {{-- {{ $field['type'] === 'date' ? 'datetimepicker' : '' }} --}}
                                 "
                                placeholder="{{ $field['placeholder'] ?? '' }}"
                                @if (isset($field['max'])) max="{{ $field['max'] }}" @endif>
                        @endif
                    </div>
                @endforeach

                <div class="flex-fill d-flex gap-2" style="min-width: 200px;">
                    <button type="submit" class="btn btn-primary flex-fill">
                        <i class="ti ti-filter me-1"></i> Filter
                    </button>
                    <a href="{{ route($route) }}" class="btn btn-outline-secondary flex-fill text-nowrap">
                        <i class="ti ti-refresh me-1"></i> Reset
                    </a>
                </div>

            </div>
        </form>
    </div>
</div>

@push('scripts')
    <script>
        $(document).ready(function() {
            // Use a specific ID or class to avoid targeting other forms on the page
            $('#filter-form').on('submit', function(e) {
                const $form = $(this);
                const $inputs = $form.find('input, select, textarea');

                let hasValue = false;
                let validationError = null;

                // 1. Check if ANY field has a value (Dynamic Check)
                $inputs.each(function() {
                    // Ignore hidden inputs like CSRF tokens or method spoofing
                    if ($(this).attr('type') === 'hidden') return;

                    if ($.trim($(this).val()) !== "") {
                        hasValue = true;
                    }
                });

                if (!hasValue) {
                    e.preventDefault();
                    alert('Please select at least one filter criteria.');
                    return false;
                }

                // 2. Logic for Date Ranges (Matches any pair of from/to dates)
                const fromDate = $form.find('input[name*="from_date"]').val();
                const toDate = $form.find('input[name*="to_date"]').val();

                if (fromDate && toDate) {
                    if (new Date(fromDate) > new Date(toDate)) {
                        e.preventDefault();
                        alert('The "To Date" must be equal to or after "From Date".');
                        return false;
                    }
                }
            });
        });
    </script>
@endpush
