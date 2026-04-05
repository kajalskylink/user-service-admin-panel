<x-admin-layout>
    <div class="content">
        <x-admin.breadcrumb title="User Profile" parent_title="Dashboard" parent_route="{{ route('dashboard') }}"/>

        <div class="row">
            <div class="col-xl-10 mx-auto">
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body p-4">
                        <div class="d-flex align-items-center flex-column flex-md-row text-center text-md-start">
                            <div class="mb-3 mb-md-0 me-md-4">
                                @php
                                    $profileImageUrl = !empty($user->profile_image) 
                                        ? rtrim(env('USER_SERVICE_API_URL'), '/') . '/' . ltrim($user->profile_image, '/') 
                                        : asset('img/profiles/avatar-02.jpg');
                                @endphp
                                <img src="{{ $profileImageUrl }}"
                                     class="rounded-circle img-thumbnail shadow-sm"
                                     style="width: 100px; height: 100px; object-fit: cover;"
                                     alt="Profile">
                            </div>
                            <div class="flex-grow-1">
                                <h4 class="fw-bold mb-1">{{ $user->name ?? 'Admin' }}</h4>
                                <p class="text-muted mb-2">
                                    <i class="ti ti-mail me-1"></i> {{ $user->email ?? 'admin@example.com' }}
                                    <span class="mx-2">|</span>
                                    <i class="ti ti-phone me-1"></i> {{ $user->mobile_number ?? 'No phone' }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-transparent border-bottom py-3">
                        <h5 class="card-title mb-0">Account Settings</h5>
                    </div>

                    <div class="card-body p-4">
                        <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('patch')

                            <div class="row mb-5">
                                <div class="col-lg-4">
                                    <h6 class="fw-bold text-uppercase small text-muted mb-3">Basic Information</h6>
                                    <x-admin.image-upload-form
                                        title="Profile Image"
                                        :existing_image="$profileImageUrl"
                                        max_size="2 MB"
                                        name="profile_image"
                                        sl="1"
                                    />
                                </div>
                                <div class="col-lg-8">
                                    <div class="row g-3">
                                        <div class="col-12">
                                            <label class="form-label fw-semibold">Display Name</label>
                                            <input type="text" name="name" class="form-control" value="{{ old('name', $user->name ?? '') }}">
                                        </div>

                                        <div class="col-md-6">
                                            <label class="form-label fw-semibold">Email Address</label>
                                            <input type="email" name="email" class="form-control bg-light" value="{{ old('email', $user->email ?? '') }}" readonly>
                                        </div>

                                        <div class="col-md-6">
                                            <label class="form-label fw-semibold">Contact Number</label>
                                            <input type="text" name="mobile_number" class="form-control" value="{{ old('mobile_number', $user->mobile_number ?? '') }}">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <hr class="my-4 opacity-25">

                            <div class="row mb-4">
                                <div class="col-lg-4">
                                    <h6 class="fw-bold text-uppercase small text-muted mb-3">Security</h6>
                                    <p class="small text-muted">Keep blank if you don't want to change your password.</p>
                                </div>
                                <div class="col-lg-8">
                                    <div class="row g-3">
                                        <div class="col-12">
                                            <label class="form-label fw-semibold">Current Password</label>
                                            <input type="password" name="current_password" class="form-control" placeholder="••••••••">
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label fw-semibold">New Password</label>
                                            <input type="password" name="password" class="form-control" placeholder="Minimum 6 characters">
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label fw-semibold">Confirm Password</label>
                                            <input type="password" name="password_confirmation" class="form-control" placeholder="Re-type password">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="d-flex justify-content-end gap-2 pt-3 border-top">
                                <a href="{{ route('dashboard') }}" class="btn btn-light border px-4">Cancel</a>
                                <button type="submit" class="btn btn-primary px-5 shadow-sm">
                                    <i class="ti ti-device-floppy me-1"></i> Save Changes
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
