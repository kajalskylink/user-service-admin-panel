<?php

namespace App\Http\Controllers;

use App\Constants\Constants;
use App\Services\API\UserAPIService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    protected UserAPIService $userAPIService;

    public function __construct(UserAPIService $userAPIService)
    {
        $this->userAPIService = $userAPIService;
    }

    /**
     * Display a listing of the users.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $response = $this->userAPIService->getUsers();
        $data = json_decode($response->body(), false);

        $responseData = [
            'users' => $data->users ?? [],
            'roles' => $data->roles ?? [],
        ];

        return view('pages.users.index', $responseData);
    }

    /**
     * Store a newly created user in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $response = $this->userAPIService->storeUser($request->all());
        $status = $response->successful() ? Constants::SUCCESS : Constants::ERROR;
        $message = $response->successful() ? "User successfully created." : ($response->json('message') ?? "Unable to create user.");
        return redirect()->back()->with($status, $message);
    }

    /**
     * Update the specified user in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $response = $this->userAPIService->updateUser($id, $request->all());
        $status = $response->successful() ? Constants::SUCCESS : Constants::ERROR;
        $message = $response->successful() ? "User successfully updated." : ($response->json('message') ?? "Unable to update user.");
        return redirect()->back()->with($status, $message);
    }

    /**
     * Remove the specified user from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $response = $this->userAPIService->deleteUser($id);
        $status = $response->successful() ? Constants::SUCCESS : Constants::ERROR;
        $message = $response->successful() ? "User successfully deleted." : "Unable to delete user.";
        return redirect()->back()->with($status, $message);
    }

    /**
     * Change user status.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function changeStatus(Request $request, $id)
    {
        $response = $this->userAPIService->changeUserStatus($id, $request->is_active);
        return response()->json($response->json(), $response->status());
    }
}
