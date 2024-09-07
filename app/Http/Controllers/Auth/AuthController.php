<?php

namespace App\Http\Controllers\Auth;

use App\Helper\JWTToken;
use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegistrationRequest;
use App\Models\Role;
use App\Models\User;
use App\Services\AuthService;
use App\Traits\ApiResponseTrait;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
class AuthController extends Controller
{

    use ApiResponseTrait;

    protected $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }
    public function login(LoginRequest $request)
    {
        $credentials = $request->only('identifier', 'password');
        $data = $this->authService->login($credentials);

        if($data == "notFound"){
            return $this->errorResponse("User not found", [], 404);
        }else if($data == "wongPassword") {
            return $this->errorResponse("Invalid credentials", [], 403);
        }else if($data == "inactive"){
            return $this->errorResponse("Your account is inactive, Please contact with support", [], 403);
        }
        return $this->successResponse($data, "You are successfully login", 200);
    }

    public function registration(RegistrationRequest $request)
    {
        $user = $this->authService->findByEmailOrPhone($request->email, $request->phone);
        if ($user) {
            return $this->errorResponse("User already exists",[], 409);
        }

        $role = $this->authService->roleFindByName('customer');
        if (!$role) {
            return $this->errorResponse("Role not found", [], 404);
        }

        $data = $this->authService->registerUser($request, $role);
        return $this->successResponse($data, "You are successfully registered", 200);
    }
}
