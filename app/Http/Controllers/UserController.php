<?php

namespace App\Http\Controllers;

use App\Constant\Constant;
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
            'users' => $data->users ?? []
        ];

        return view('pages.users.index', $responseData);
    }

    /**
     * Show the form for creating a new user.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        config(['app.page_title' => 'Create User']);
        return view('pages.user.create');
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
        $status = $response->successful() ? Constant::SUCCESS : Constant::ERROR;
        $message = $response->successful() ? "User successfully deleted." : "Unable to delete user.";
        return redirect()->back()->with($status, $message);
    }
}
