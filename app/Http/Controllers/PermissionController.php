<?php

namespace App\Http\Controllers;

use App\Services\API\UserAPIService;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    protected UserAPIService $userAPIService;

    public function __construct(UserAPIService $userAPIService)
    {
        $this->userAPIService = $userAPIService;
    }


    public function index()
    {
        $response = $this->userAPIService->getPermissions();
        $data = json_decode($response->body(), false);

        $responseData = [
            'permissions' => $data->permissions ?? []
        ];

        return view('pages.permission.index', $responseData);
    }
}
