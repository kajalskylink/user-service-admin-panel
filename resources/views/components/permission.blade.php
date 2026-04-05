@props(['name'])

@php
    $apiUser = session('api_user');
    $permissions = (array)data_get($apiUser, 'permissions', []);
    
    // Split combined permissions like "can-view-user|can-view-role" (OR logic)
    $requiredPermissions = explode('|', $name);
    $isVisible = false;
    
    foreach ($requiredPermissions as $perm) {
        if (in_array(trim($perm), $permissions)) {
            $isVisible = true;
            break;
        }
    }
@endphp

@if ($isVisible)
    {{ $slot }}
@endif
