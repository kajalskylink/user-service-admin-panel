<?php

namespace App\Http\Controllers;

use App\Constants\Constants;
use App\Services\API\UserAPIService;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    protected UserAPIService $userAPIService;

    public function __construct(UserAPIService $userAPIService)
    {
        $this->userAPIService = $userAPIService;
    }

    public function index()
    {
        $response = $this->userAPIService->getRoles();
        $data = json_decode($response->body(), false);

        $responseData = [
            'roles' => $data->roles ?? [],
            'permissions' => $data->permissions ?? [], // To assign permissions to roles
        ];

        return view('pages.roles.index', $responseData);
    }

    public function edit(int $id)
    {
        $response = $this->userAPIService->editRole($id);
        $data = json_decode($response->body(), false);

        $responseData = [
            'role' => $data->role,
            'permissions' => $data->permissions,
            'currentRolePermissions' => collect($data->currentRolePermissions)->pluck('id')->toArray(),
        ];

        return view('pages.roles.edit', $responseData);
    }

    public function create()
    {
        $response = $this->userAPIService->createRole();
        $data = json_decode($response->body(), false);

        $responseData = [
            'permissions' => $data->permissions ?? [],
        ];

        return view('pages.roles.create', $responseData);
    }

    public function store(Request $request)
    {
        $response = $this->userAPIService->storeRole($request->all());
        $data = $response->json();

        if ($response->status() === 422) {
            return back()->withErrors($data['errors'] ?? [])->withInput();
        }

        $status = $response->successful() ? Constants::SUCCESS : Constants::ERROR;
        $message = $data['message'] ?? 'Something went wrong!';
        $this->userAPIService->refreshUserSession(); // Refresh session to update permissions
        return redirect()->route('roles.index')->with($status, $message);
    }

    public function update(Request $request, int $id)
    {
        $response = $this->userAPIService->updateRole($id, $request->all());
        $data = $response->json();

        if ($response->status() === 422) {
            return back()->withErrors($data['errors'] ?? [])->withInput();
        }

        $status = ($response->successful() && ($data['status'] ?? '') === Constants::SUCCESS) ? Constants::SUCCESS : Constants::ERROR;
        $message = $data['message'] ?? ($response->successful() ? 'Role updated successfully.' : 'Something went wrong!');
        
        $this->userAPIService->refreshUserSession(); // Refresh session to update permissions
        return back()->with($status, $message);
    }

    public function changeStatus(Request $request, int $id)
    {
        $response = $this->userAPIService->changeRoleStatus($id, $request->is_active);
        return response()->json($response->json(), $response->status());
    }

    public function destroy($id)
    {
        $response = $this->userAPIService->deleteRole($id);
        $data = $response->json();

        // Check if the request was successful and the API returned success status
        if ($response->successful() && ($data['status'] ?? '') === Constants::SUCCESS) {
            $status = Constants::SUCCESS;
            $message = $data['message'] ?? 'Role deleted successfully.';
        } else {
            $status = Constants::ERROR;
            $message = $data['message'] ?? ($response->successful() ? 'Unable to delete role.' : 'Something went wrong with the server.');
        }

        $this->userAPIService->refreshUserSession(); // Refresh session in case deleted role affected current user
        return redirect()->back()->with($status, $message);
    }
}
