<!DOCTYPE html>
<html lang="en">

<head>

	<!-- Meta Tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>{{ config('app.page_title', 'Apex MPL') }} | {{ config('app.name') }}</title>

	<meta name="description" content="{{ config('app.description') ?? '' }}">
	<meta name="keywords" content="{{ config('app.keywords') ?? '' }}">
	<meta name="author" content="{{ config('app.author') ?? '' }}">
	<meta name="robots" content="index, follow">

	<!-- Apple Touch Icon -->
	<link rel="apple-touch-icon" sizes="180x180" href="{{ asset('img/logo_small.png') }}">

	<!-- Favicon -->
	<link rel="icon" href="{{ asset('img/favicon.png') }}" type="image/x-icon">
	<link rel="shortcut icon" href="{{ asset('img/favicon.png') }}" type="image/x-icon">

    <!-- Theme Script js -->
    <script src="{{ asset('admin/js/theme-script.js') }}"></script>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('admin/css/bootstrap.min.css') }}">

    <!-- Feather CSS -->
    <link rel="stylesheet" href="{{ asset('admin/plugins/icons/feather/feather.css') }}">

    <!-- Tabler Icon CSS -->
    <link rel="stylesheet" href="{{ asset('admin/plugins/tabler-icons/tabler-icons.css') }}">

    <!-- Select2 CSS -->
    <link rel="stylesheet" href="{{ asset('admin/plugins/select2/css/select2.min.css') }}">

    <!-- Fontawesome CSS -->
    <link rel="stylesheet" href="{{ asset('admin/plugins/fontawesome/css/fontawesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/plugins/fontawesome/css/all.min.css') }}">

    <!-- Datetimepicker CSS -->
    <link rel="stylesheet" href="{{ asset('admin/css/bootstrap-datetimepicker.min.css') }}">

    <!-- Bootstrap Tagsinput CSS -->
    <link rel="stylesheet" href="{{ asset('admin/plugins/bootstrap-tagsinput/bootstrap-tagsinput.css') }}">

    <!-- Summernote CSS -->
    <link rel="stylesheet" href="{{ asset('admin/plugins/summernote/summernote-lite.min.css') }}">

    <!-- Daterangepikcer CSS -->
    <link rel="stylesheet" href="{{ asset('admin/plugins/daterangepicker/daterangepicker.css') }}">

    <!-- Color Picker Css -->
    <link rel="stylesheet" href="{{ asset('admin/plugins/flatpickr/flatpickr.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/plugins/@simonwep/pickr/themes/nano.min.css') }}">

    <!-- Toastr Css -->
    <link rel="stylesheet" href="{{ asset('admin/css/toastr.min.css') }}">

    <!-- Main CSS -->
    <link rel="stylesheet" href="{{ asset('admin/css/style.css') }}">

    <link rel="stylesheet" href="{{ asset('admin/css/custom.css') }}">

	<style>
		#sidebar {
  			background-image: url({{ asset('img/theme/bg-03.jpg') }});
		}
		.card-bg-1::before {
			background-image: url({{ asset('img/bg/card-bg.png') }});
		}
	</style>
	@stack("style")
</head>

<body>

	<x-preloader />

	<!-- Main Wrapper -->
	<div class="main-wrapper">

		<x-admin-header/>

        <x-admin-menu />

		<!-- Page Wrapper -->
		<div class="page-wrapper">
             {{--  @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show m-4" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show m-4" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif


			@if($errors->any())
				<div class="alert alert-danger alert-dismissible fade show m-4" role="alert">
					{{ $errors->first() }}
					<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
				</div>
			@endif  --}}

			{{ $slot }}
			<div class="footer d-sm-flex align-items-center justify-content-between border-top bg-white p-3">
				<p class="mb-0">{{ config('app.years') ?? '2020 - 2026' }} &copy; {{ config('app.name') ?? 'Dewan Software' }}.</p>
				<p>Designed &amp; Developed By <a href="javascript:void(0);" class="text-primary">{{ config('app.author') ?? 'Dewan Software' }}</a></p>
			</div>
		</div>
		<!-- /Page Wrapper -->
	</div>
	<!-- /Main Wrapper -->

	<!-- Scripts -->
	<script src="{{ asset('admin/js/jquery-3.7.1.min.js') }}"></script>
    <script src="{{ asset('admin/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('admin/js/feather.min.js') }}"></script>
    <script src="{{ asset('admin/js/jquery.slimscroll.min.js') }}"></script>
    <script src="{{ asset('admin/plugins/apexchart/apexcharts.min.js') }}"></script>
    <script src="{{ asset('admin/plugins/apexchart/chart-data.js') }}"></script>
    <script src="{{ asset('admin/plugins/chartjs/chart.min.js') }}"></script>
    <script src="{{ asset('admin/plugins/chartjs/chart-data.js') }}"></script>
    <script src="{{ asset('admin/js/moment.js') }}"></script>
    <script src="{{ asset('admin/js/bootstrap-datetimepicker.min.js') }}"></script>
    <script src="{{ asset('admin/plugins/daterangepicker/daterangepicker.js') }}"></script>
    <script src="{{ asset('admin/plugins/summernote/summernote-lite.min.js') }}"></script>
    <script src="{{ asset('admin/plugins/bootstrap-tagsinput/bootstrap-tagsinput.js') }}"></script>
    <script src="{{ asset('admin/plugins/select2/js/select2.min.js') }}"></script>
    <script src="{{ asset('admin/plugins/theia-sticky-sidebar/theia-sticky-sidebar.js') }}"></script>
    <script src="{{ asset('admin/plugins/@simonwep/pickr/pickr.es5.min.js') }}"></script>
    <script src="{{ asset('admin/js/todo.js') }}"></script>
    <script src="{{ asset('admin/js/theme-colorpicker.js') }}"></script>
    <script src="{{ asset('admin/js/toastr.min.js') }}"></script>

	<!-- Datatable JS -->
	<script src="{{ asset('admin/js/jquery.dataTables.min.js') }}"></script>
	<script src="{{ asset('admin/js/dataTables.bootstrap5.min.js') }}"></script>

    <script src="{{ asset('admin/js/script.js') }}"></script>
    {{--  <script src="{{ asset('admin/js/custom.js') }}"></script>  --}}

	<script>
		let selectedFiles = [];
		function renderPreviews(layout, input_id) {
			let $layout = $("#"+layout).empty().addClass('col-md-12 d-flex flex-wrap');
			selectedFiles.forEach((file, idx) => {
				const reader = new FileReader();
				reader.onload = function (e) {
					const $wrapper = $('<div>').addClass('position-relative m-2').css({ width: '150px', height: '150px' });

					const $img = $('<img>')
						.attr('src', e.target.result)
						.addClass('img-thumbnail')
						.css({ width: '100%', height: '100%', objectFit: 'cover' });

					const $removeBtn = $('<span>')
						.html('&times;')
						.addClass('btn btn-sm btn-danger position-absolute top-0 end-0 m-1 rounded-circle')
						.css({ cursor: 'pointer', padding: '0.25rem 0.5rem' })
						.on('click', function () {
						removeFile(idx, layout, input_id);
					});
					$wrapper.append($img).append($removeBtn);
					$layout.append($wrapper);
				};
				reader.readAsDataURL(file);
			});
		}

		function removeFile(index, layout, input_id) {
			selectedFiles.splice(index, 1);
			const dt = new DataTransfer();
			selectedFiles.forEach(f => dt.items.add(f));
			$("#"+input_id)[0].files = dt.files;
			renderPreviews(layout, input_id);
		}

		function timeAgo(dateString) {
			const past = new Date(dateString.replace(" ", "T"));
			const now = new Date();
			const seconds = Math.floor((now - past) / 1000);

			const intervals = {
				year: 31536000,
				month: 2592000,
				day: 86400,
				hour: 3600,
				minute: 60,
				second: 1
			};

			for (const [unit, value] of Object.entries(intervals)) {
				const count = Math.floor(seconds / value);
				if (count >= 1) {
					return `${count} ${unit}${count > 1 ? 's' : ''}`;
				}
			}
			return "Just now";
		}

        //Toastr
        toastr.options = {
            closeButton: true,
            progressBar: true,
            positionClass: "toast-top-right",
            timeOut: 5000
        };

        @if(session()->has('success'))
            toastr.success(@json(session('success')));
        @endif

        @if(session()->has('error'))
            toastr.error(@json(session('error')));
        @endif

        @if(session()->has('info'))
            toastr.info(@json(session('info')));
        @endif

        @if(session()->has('warning'))
            toastr.warning(@json(session('warning')));
        @endif
	</script>

	@stack('scripts')

	<!-- /Scripts -->
    @if($errors->any())
        <script>
            toastr.error(@json($errors->first()));
        </script>
    @endif

</body>
</html>
