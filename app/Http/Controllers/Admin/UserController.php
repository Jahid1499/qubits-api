<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\RegistrationRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Services\UserService;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\Request;

class UserController extends Controller
{
    use ApiResponseTrait;

    private $userService;
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function index(Request $request)
    {
        $users = $this->userService->getUsers($request);
        return $this->successResponse($users, "User retrieved successfully", 200);
    }

    public function store(CreateUserRequest $request)
    {
        $this->userService->createUser($request->all());
        return $this->successResponse("", "User created successfully", 201);
    }

    public function show(int $id)
    {
        $series = $this->userService->getUser($id);
        return $this->successResponse($series, "User found successfully", 200);
    }


    public function update(UserUpdateRequest $request, int $id)
    {
        $this->userService->updateUser($request->all(), $id);
        return $this->successResponse("", "User update successfully", 200);
    }

    public function destroy(int $id)
    {
        $this->userService->deletUser($id);
        return $this->successResponse("", "User deleted successfully", 200);
    }
}
