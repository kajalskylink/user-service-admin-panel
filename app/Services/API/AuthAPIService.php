<?php

namespace App\Services\API;

use Illuminate\Support\Facades\Http;

class AuthAPIService
{
    /**
     * Create a new class instance.
     */
    private mixed $authAPIUrl;
    private mixed $data;
    private mixed $url;
    private mixed $method;

    public function __construct()
    {
        $this->authAPIUrl = env("AUTH_SERVICE_API_URL");
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
            'X-Api-Key' => env('AUTH_SERVICE_API_KEY'),
        ];

        $url = $this->authAPIUrl . $this->url;

        if ($this->method === 'POST') {
            $response = Http::withHeaders($header)->post($url, $data);
        } else if($this->method === 'GET') {
            $response = Http::withHeaders($header)->get($url, $data);
        }else if ($this->method === 'DELETE') {
            $response = Http::withHeaders($header)->delete($url, $data);
        } else {
            throw new \Exception('Unsupported HTTP method: ' . $this->method);
        }

        return $response;
    }

    public function register($data)
    {
        $this->data = $data;
        $this->url = '/api/register';
        $this->method = 'POST';

        return $this->sendRequest();
    }

    public function login($data)
    {
        $this->data = $data;
        $this->url = '/api/login';
        $this->method = 'POST';

        return $this->sendRequest();
    }

    public function logout($token = null)
    {
        $this->data = [];
        $this->url = '/api/logout';
        $this->method = 'POST';

        // If we have a token, we could pass it in headers or data
        // For now, let's just make the call as the controller will handle the local session
        return $this->sendRequest();
    }
}
