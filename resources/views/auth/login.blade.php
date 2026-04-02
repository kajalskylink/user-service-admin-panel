<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
	<meta name="description" content="Aura Skylink IT - Administrative Portal">
	<meta name="keywords" content="admin, estimates, bootstrap, business, html5, responsive, Projects">
	<meta name="author" content="Dreams technologies - Bootstrap Admin Template">
	<meta name="robots" content="noindex, nofollow">
	<title>Sign In | {{ config('app.name') }}</title>

	<!-- Favicon -->
	<link rel="shortcut icon" type="image/x-icon" href="{{ asset('img/favicon.png') }}">

	<!-- Apple Touch Icon -->
	<link rel="apple-touch-icon" sizes="180x180" href="{{ asset('img/apple-touch-icon.png') }}">

	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="{{ asset('admin/css/bootstrap.min.css') }}">

	<!-- Feather CSS -->
	<link rel="stylesheet" href="{{ asset('admin/plugins/icons/feather/feather.css') }}">

	<!-- Tabler Icon CSS -->
	<link rel="stylesheet" href="{{ asset('admin/plugins/tabler-icons/tabler-icons.css') }}">

	<!-- Fontawesome CSS -->
	<link rel="stylesheet" href="{{ asset('admin/plugins/fontawesome/css/fontawesome.min.css') }}">
	<link rel="stylesheet" href="{{ asset('admin/plugins/fontawesome/css/all.min.css') }}">

	<!-- Main CSS -->
	<link rel="stylesheet" href="{{ asset('admin/css/style.css') }}">

    <style>
        .bg-primary-transparent {
            background-color: rgba(255, 155, 68, 0.05);
        }
    </style>

</head>

<body class="bg-white">

	<div id="global-loader" style="display: none;">
		<div class="page-loader"></div>
	</div>

	<!-- Main Wrapper -->
	<div class="main-wrapper">

		<div class="container-fuild">
			<div class="w-100 overflow-hidden position-relative flex-wrap d-block vh-100">
				<div class="row">
					<div class="col-lg-5">
						<div class="d-lg-flex align-items-center justify-content-center d-none flex-wrap vh-100 bg-primary-transparent">
							<div>
								<img src="{{ asset('img/bg/authentication-bg-03.svg') }}" alt="Img" class="img-fluid">
							</div>
						</div>
					</div>
					<div class="col-lg-7 col-md-12 col-sm-12">
						<div class="row justify-content-center align-items-center vh-100 overflow-auto flex-wrap ">
							<div class="col-md-7 mx-auto vh-100">
								<form action="{{ route('login.store') }}" method="POST" class="vh-100">
									@csrf
									<div class="vh-100 d-flex flex-column justify-content-between p-4 pb-0">
										<div class=" mx-auto mb-5 text-center">
											<h1 class="text-primary fw-bold mb-0">Aura Skylink IT</h1>
										</div>
										<div class="">
											<div class="text-center mb-3">
												<h2 class="mb-2">Sign In</h2>
												<p class="mb-0">Please enter your details to sign in</p>
											</div>
											@if($errors->any())
												<div class="alert alert-danger">
													<ul class="mb-0">
														@foreach($errors->all() as $error)
															<li>{{ $error }}</li>
														@endforeach
													</ul>
												</div>
											@endif
											<div class="mb-3">
												<label class="form-label">Email Address</label>
												<div class="input-group">
													<input type="text" name="email" value="{{ old('email', 'admin@apexmpl.com') }}" class="form-control border-end-0" required>
													<span class="input-group-text border-start-0">
														<i class="ti ti-mail"></i>
													</span>
												</div>
											</div>
											<div class="mb-3">
												<label class="form-label">Password</label>
												<div class="pass-group">
													<input type="password" name="password" value="12345" class="pass-input form-control" required>
													<span class="ti toggle-password ti-eye-off"></span>
												</div>
											</div>
											<div class="d-flex align-items-center justify-content-between mb-3">
												<div class="d-flex align-items-center">
													<div class="form-check form-check-md mb-0">
														<input class="form-check-input" id="remember_me" type="checkbox">
														<label for="remember_me" class="form-check-label mt-0">Remember Me</label>
													</div>
												</div>
												<div class="text-end">
													<a href="#" class="link-danger">Forgot
														Password?</a>
												</div>
											</div>
											<div class="mb-3">
												<button type="submit" class="btn btn-primary w-100">Sign In</button>
											</div>
											<div class="text-center">
												<h6 class="fw-normal text-dark mb-0">Don’t have an account?
													<a href="{{ route('register') }}" class="hover-a text-primary"> Create Account</a>
												</h6>
											</div>
											<div class="login-or">
												<span class="span-or">Or</span>
											</div>
											<div class="mt-2">
												<div class="d-flex align-items-center justify-content-center flex-wrap">
													<div class="text-center me-2 flex-fill">
														<a href="javascript:void(0);"
															class="br-10 p-2 btn btn-info d-flex align-items-center justify-content-center text-white">
															<i class="ti ti-brand-facebook fs-20 me-2"></i> Facebook
														</a>
													</div>
													<div class="text-center flex-fill">
														<a href="javascript:void(0);"
															class="br-10 p-2 btn btn-outline-light border d-flex align-items-center justify-content-center">
															<img class="img-fluid m-1" src="{{ asset('img/icons/google-logo.svg') }}" alt="Google" width="20"> Google
														</a>
													</div>
												</div>
											</div>
										</div>
										<div class="mt-5 pb-4 text-center">
											<p class="mb-0 text-gray-9">Copyright &copy; 2026 - {{ config('app.name') }}</p>
										</div>
									</div>
								</form>
							</div>

						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- /Main Wrapper -->

	<!-- jQuery -->
	<script src="{{ asset('admin/js/jquery-3.7.1.min.js') }}"></script>

	<!-- Bootstrap Core JS -->
	<script src="{{ asset('admin/js/bootstrap.bundle.min.js') }}"></script>

	<!-- Feather Icon JS -->
	<script src="{{ asset('admin/js/feather.min.js') }}"></script>

	<!-- Custom JS -->
	<script src="{{ asset('admin/js/script.js') }}"></script>

</body>

</html>
