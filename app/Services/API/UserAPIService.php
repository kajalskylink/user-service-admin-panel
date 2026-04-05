<?php

namespace App\Services\API;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class UserAPIService
{
    private mixed $userServiceAPIUrl;
    private mixed $data;
    private mixed $url;
    private mixed $method;

    public function __construct()
    {
        $this->userServiceAPIUrl = env("USER_SERVICE_API_URL");
        $this->data = null;
        $this->url = null;
        $this->method = null;
    }

    public function sendRequest()
    {
        $data = $this->data;
        $header = [
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
            'X-Api-Key' => env('USER_SERVICE_API_KEY'),
        ];

        if ($token = session('api_token')) {
            $header['Authorization'] = 'Bearer ' . $token;
        }

        $url = $this->userServiceAPIUrl . $this->url;

        if ($this->method === 'POST') {
            $response = Http::withHeaders($header)->post($url, $data);
        } else if ($this->method === 'PUT') {
            $response = Http::withHeaders($header)->put($url, $data);
        } else if ($this->method === 'PATCH') {
            $response = Http::withHeaders($header)->patch($url, $data);
        } else if($this->method === 'GET') {
            $response = Http::withHeaders($header)->get($url, $data);
        }else if ($this->method === 'DELETE') {
            $response = Http::withHeaders($header)->delete($url, $data);
        } else {
            throw new \Exception('Unsupported HTTP method: ' . $this->method);
        }
//         Log::info('response', ['response' => $response]);
        return $response;
    }

    // User API
    public function getUsers()
    {
        $this->url = '/api/user-service/users';
        $this->method = 'GET';
        return $this->sendRequest();
    }

    public function storeUser($data)
    {
        $this->data = $data;
        $this->url = '/api/user-service/users';
        $this->method = 'POST';
        return $this->sendRequest();
    }

    public function updateUser($id, $data, $imageFile = null)
    {
        if ($imageFile) {
            $url = $this->userServiceAPIUrl . '/api/user-service/users/' . $id;
            $header = [
                'Accept' => 'application/json',
                'X-Api-Key' => env('USER_SERVICE_API_KEY'),
            ];
            if ($token = session('api_token')) {
                $header['Authorization'] = 'Bearer ' . $token;
            }

            // In Laravel, PUT with file upload needs to be a POST with _method=PUT
            $data['_method'] = 'PUT';
            
            return Http::withHeaders($header)
                ->attach(
                    'profile_image', 
                    file_get_contents($imageFile->getRealPath()), 
                    $imageFile->getClientOriginalName()
                )
                ->post($url, $data);
        }

        $this->data = $data;
        $this->url = '/api/user-service/users/' . $id;
        $this->method = 'PUT';
        return $this->sendRequest();
    }

    public function deleteUser($id)
    {
        $this->url = '/api/user-service/users/' . $id;
        $this->method = 'DELETE';
        return $this->sendRequest();
    }

    public function changeUserStatus($id, $isActive)
    {
        $this->data = ['is_active' => $isActive];
        $this->url = "/api/user-service/users/{$id}/change-status";
        $this->method = 'PATCH';
        return $this->sendRequest();
    }

    // Permission API
    public function getPermissions()
    {
        $this->url = '/api/user-service/permissions';
        $this->method = 'GET';
        return $this->sendRequest();
    }

    public function storePermission($data)
    {
        $this->data = $data;
        $this->url = '/api/user-service/permissions';
        $this->method = 'POST';
        return $this->sendRequest();
    }

    public function updatePermission($id, $data)
    {
        $this->data = $data;
        $this->url = '/api/user-service/permissions/' . $id;
        $this->method = 'PUT';
        return $this->sendRequest();
    }

    public function deletePermission($id)
    {
        $this->url = '/api/user-service/permissions/' . $id;
        $this->method = 'DELETE';
        return $this->sendRequest();
    }

    // Role API
    public function getRoles()
    {
        $this->url = '/api/user-service/roles';
        $this->method = 'GET';
        return $this->sendRequest();
    }

    public function createRole()
    {
        $this->url = '/api/user-service/roles/create';
        $this->method = 'GET';
        return $this->sendRequest();
    }

    public function storeRole($data)
    {
        $this->data = $data;
        $this->url = '/api/user-service/roles';
        $this->method = 'POST';
        return $this->sendRequest();
    }

    public function updateRole($id, $data)
    {
        $this->data = $data;
        $this->url = '/api/user-service/roles/' . $id;
        $this->method = 'PUT';
        return $this->sendRequest();
    }

    public function deleteRole($id)
    {
        $this->url = '/api/user-service/roles/' . $id;
        $this->method = 'DELETE';
        return $this->sendRequest();
    }

    public function editRole($id)
    {
        $this->url = '/api/user-service/roles/' . $id . '/edit';
        $this->method = 'GET';
        return $this->sendRequest();
    }

    public function changeRoleStatus($id, $isActive)
    {
        $this->data = ['is_active' => $isActive];
        $this->url = "/api/user-service/roles/{$id}/status";
        $this->method = 'PATCH';
        return $this->sendRequest();
    }

    public function refreshUserSession()
    {
        $apiUser = session('api_user');
        if (!$apiUser || !isset($apiUser['email'])) {
            return;
        }

        $this->data = ['email' => $apiUser['email']];
        $this->url = '/api/user-service/check-user';
        $this->method = 'GET';
        $response = $this->sendRequest();

        if ($response->successful()) {
            $userData = $response->json('user');
            if ($userData) {
                session(['api_user' => $userData]);
            }
        }
    }
}
