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
            'permissions' => $data->permissions ?? [],
            'groups' => $data->groups ?? [],
        ];

        return view('pages.permission.index', $responseData);
    }

    public function store(Request $request)
    {
        $response = $this->userAPIService->storePermission($request->all());
        $data = $response->json();

        if ($response->status() === 422) {
            return back()->withErrors($data['errors'])->withInput();
        }

        $status = $response->successful() ? Constants::SUCCESS : Constants::ERROR;
        $message = $data['message'] ?? 'Something went wrong!';
        return back()->with($status, $message);
    }

    public function update(Request $request, int $id)
    {
        $response = $this->userAPIService->updatePermission($id, $request->all());
        $data = $response->json();

        if ($response->status() === 422) {
            return back()->withErrors($data['errors'])->withInput();
        }

        $status = $response->successful() ? Constants::SUCCESS : Constants::ERROR;
        $message = $data['message'] ?? 'Something went wrong!';
        return back()->with($status, $message);
    }

    public function destroy($id)
    {
        $response = $this->userAPIService->deletePermission($id);
        $status = $response ? Constants::SUCCESS : Constants::ERROR;
        $message = $response ? 'Permission deleted successfully.' : 'Unable to delete permission.';
        return redirect()->back()->with($status, $message);
    }
}
