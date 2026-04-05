<!-- Sidebar -->
<div class="sidebar" id="sidebar">
    <!-- Logo -->
    <div class="sidebar-logo">
        <a href="{{ route('dashboard') }}" class="logo logo-normal">
            <img src="{{ asset('img/apex-logo.jpg') }}" alt="Logo" style="height: 30px; width: 127px;">
        </a>
        <a href="{{ route('dashboard') }}" class="logo-small">
            <img src="{{ asset('img/logo_small.png') }}" alt="Logo">
        </a>
        <a href="{{ route('dashboard') }}" class="dark-logo">
            <img src="{{ asset('img/apex-logo.jpg') }}" alt="Logo">
        </a>
    </div>
    <!-- /Logo -->
    <div class="modern-profile p-3 pb-0">
        <div class="text-center rounded bg-light p-3 mb-4 user-profile">
            <div class="avatar avatar-lg online mb-3">
                <img src="{{ asset('img/profiles/avatar-02.jpg') }}" alt="Img" class="img-fluid rounded-circle">
            </div>
            <h6 class="fs-12 fw-normal mb-1">{{ session('api_user.name') ?? 'Admin' }}</h6>
            <p class="fs-10">{{ collect(session('api_user.roles'))->first() ?? 'System Admin' }}</p>
        </div>
    </div>
    
    <div class="sidebar-inner slimscroll">
        <div id="sidebar-menu" class="sidebar-menu">
            <ul>
                <li class="menu-title"><span>MAIN MENU</span></li>
                <li>
                    <ul>
                        <li>
                            <a href="{{ route('dashboard') }}" class="{{ Route::currentRouteName() == 'dashboard' ? 'active' : '' }}">
                                <i class="ti ti-smart-home"></i>
                                <span>Dashboard</span>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>

            <x-permission name="can-view-user|can-view-role|can-view-permission">
            <ul>
                <li class="menu-title"><span>User Management</span></li>
                <li>
                    <ul>
                        <x-permission name="can-view-user">
                        <li>
                            <a href="{{ route('users.index') }}"
                                class="{{ Route::currentRouteName() == 'users.index' ? 'active' : '' }}">
                                <i class="ti ti-users"></i>
                                <span>Users</span>
                            </a>
                        </li>
                        </x-permission>

                        <x-permission name="can-view-role">
                        <li>
                            <a href="{{ route('roles.index') }}"
                               class="{{ Route::currentRouteName() == 'roles.index' || Route::currentRouteName() == 'roles.create' || Route::currentRouteName() == 'roles.edit' ? 'active' : '' }}">
                                <i class="ti ti-shield-lock"></i>
                                <span>Roles</span>
                            </a>
                        </li>
                        </x-permission>

                        <x-permission name="can-view-permission">
                        <li>
                            <a href="{{ route('permissions.index') }}"
                                class="{{ Route::currentRouteName() == 'permissions.index' ? 'active' : '' }}">
                                <i class="ti ti-key"></i>
                                <span>Permissions</span>
                            </a>
                        </li>
                        </x-permission>

                    </ul>
                </li>
            </ul>
            </x-permission>
        </div>
    </div>
</div>
<!-- /Sidebar -->
