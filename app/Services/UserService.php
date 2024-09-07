<?php

namespace App\Services;

use App\Http\Requests\RegistrationRequest;
use App\Repository\UserRepository;

class UserService
{
    private $userRepository;
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function getUsers($request)
    {
        $filters = [
            'sortBy' => $request->query('sortBy'),
            'limit' => $request->query('limit', 10),
            'orderBy' => $request->query('orderBy', 'asc'),
            'search' => $request->query('search'),
            'page' => $request->query('page', 1),
        ];
        return $this->userRepository->getUsers($filters);
    }

    public function createUser($request)
    {
        return $this->userRepository->createUser($request);
    }

    public function getUser($id)
    {
        return $this->userRepository->getUser($id);
    }

    public function updateUser($request, $id)
    {
        return $this->userRepository->updateUser($request, $id);
    }

    public function deletUser($id)
    {
        return $this->userRepository->deleteUser($id);
    }

}
