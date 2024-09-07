<?php

namespace App\Services;
use App\Helper\JWTToken;
use App\Http\Resources\UserResource;
use App\Repository\RoleRepository;
use App\Repository\UserRepository;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Exception;

class AuthService
{
    use ApiResponseTrait;
    protected $userRepository;
    protected $roleRepository;

    public function __construct(UserRepository $userRepository, RoleRepository $roleRepository)
    {
        $this->userRepository = $userRepository;
        $this->roleRepository = $roleRepository;
    }

    public function login(array $credentials)
    {
        $identifier = '';

        if (filter_var($credentials['identifier'], FILTER_VALIDATE_EMAIL)) {
            $identifier = 'email';
        } else {
            $identifier = 'phone';
        }

        $user = $identifier === 'email'
            ? $this->userRepository->findByEmail($credentials['identifier'])
            : $this->userRepository->findByPhone($credentials['identifier']);

        if (!$user) {
            return "notFound";
        }

        if (!Hash::check($credentials['password'], $user->password)) {
            return "wongPassword";
        }

        if ($user->status === 'inactive') {
            return "inactive";
        }

        $roles = $this->userRepository->getUserRoles($user->id);
        $userRoles = $roles->pluck('name')->implode(', ');

        return [
            "user" => UserResource::make($user),
            "access_token" => JWTToken::CreateToken($user->name, $user->email, $userRoles, $user->id, $user->phone)
        ];
    }

    public function registerUser(object $request, object $role)
    {
        try {
            $user = $this->userRepository->create($request);
            $this->userRepository->attachRole($user, $role->id);
            DB::commit();
        } catch (Exception $exception) {
            DB::rollBack();
            return $this->errorResponse("Internal server error", [], 500);
        }

        return [
            "user" => UserResource::make($user),
            "access_token" => JWTToken::CreateToken($user->name, $user->email, $user->roles, $user->id, $user->phone)
        ];
    }

    public function findByEmailOrPhone($email, $phone)
    {
        return $this->userRepository->findByEmailOrPhone($email, $phone);
    }
    public function roleFindByName(String $name)
    {
        return $this->roleRepository->findByName($name);
    }
}
