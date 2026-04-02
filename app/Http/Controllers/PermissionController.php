<?php

namespace App\Http\Controllers;

use App\Constants\Constants;
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

    public function destroy($id)
    {
        $response = $this->userAPIService->deletePermission($id);
        $status = $response ? Constants::SUCCESS : Constants::ERROR;
        $message = $response ? 'Permission deleted successfully.' : 'Unable to delete permission.';
        return redirect()->back()->with($status, $message);
    }
}
