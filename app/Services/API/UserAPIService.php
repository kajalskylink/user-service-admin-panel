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

    public function deleteUser($id)
    {
        $this->url = '/api/user-service/users/' . $id;
        $this->method = 'DELETE';
        return $this->sendRequest();
    }

    // Permission API
    public function getPermissions()
    {
        $this->url = '/api/user-service/permissions';
        $this->method = 'GET';
        return $this->sendRequest();
    }

    public function storePermission()
    {
        $this->url = '/api/user-service/permissions';
        $this->method = 'POST';
        return $this->sendRequest();
    }
}
