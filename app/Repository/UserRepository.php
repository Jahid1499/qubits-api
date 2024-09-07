<?php

namespace App\Repository;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Mockery\Exception;


class UserRepository
{
    public function __construct(
        protected User $user
    ){}

    public function attachRole($user, array $roles)
    {
        $user->roles()->attach($roles);
    }

    public function syncRole($user, array $role)
    {
        $user->roles()->sync($role);
    }

    public function detachRole($user)
    {
        $user->roles()->detach();
    }
    public function findByEmail(string $email)
    {
        return User::where('email', $email)->first();
    }

    public function findById(int $id)
    {
        return User::findOrFail($id);
    }

    public function findByPhone(string $phone)
    {
        return User::where('phone', $phone)->first();
    }

    public function getUserRoles(int $userId)
    {
        return User::with('roles')->find($userId)->roles;
    }

    public function findByEmailOrPhone($email, $phone)
    {
        return User::where('email', $email)
            ->orWhere('phone', $phone)
            ->first();
    }

    public function getUsers(array $filters)
    {
        $query = User::query();
        if (isset($filters['search'])) {
            $query->where('name', 'like', '%' . $filters['search'] . '%')
                ->orWhere('email', 'like', '%' . $filters['search'] . '%')
                ->orWhere('phone', 'like', '%' . $filters['search'] . '%');
        }

        if (isset($filters['sortBy'])) {
            $orderBy = $filters['orderBy'] ?? 'asc';
            $query->orderBy($filters['sortBy'], $orderBy);
        }

        if (isset($filters['limit'])) {
            $query->limit($filters['limit']);
        }

        if (isset($filters['page'])) {
            $query->offset(($filters['page'] - 1) * $filters['limit']);
        }

        $users = $query->with(['roles' => function ($query) {
            $query->select('name');
        }])->paginate(10);

        $users->each(function ($user) {
            $user->makeHidden(['password', 'created_at', 'updated_at']);
        });

        $users->transform(function ($user) {
            $user->roles->transform(function ($role) {
                return [
                    'id' => $role->pivot->role_id,
                    'name' => $role->name,
                ];
            });
            return $user;
        });

        return $users;
    }

    public function getUser(int $id)
    {
        $user = User::with(['roles' => function ($query) {
            $query->select('name');
        }])->findOrFail($id);

        $user->roles->transform(function ($role) {
            return [
                'name' => $role->name,
                'id' => $role->pivot->role_id,
            ];
        });

        return $user;
    }

    public function createUser($data)
    {
        $data['password'] = Hash::make($data['password']);
        DB::beginTransaction();
        try {
            $user = User::create($data);
            $user->roles()->attach($data['roles']);
            DB::commit();
        }catch (\Exception $exception){
            DB::rollBack();
        }
    }

    public function updateUser($request, $id)
    {
        DB::beginTransaction();
        try {
            $userRole = User::findOrFail($id);
            User::findOrFail($id)->update($request);
            $this->syncRole($userRole, $request['roles']);
            DB::commit();
        }catch (Exception $exception){
            DB::rollBack();
        }
    }

    public function deleteUser($id){
        DB::beginTransaction();
        try{
            $user = $this->findById($id);
            $this->detachRole($user);
            $user->delete();
            DB::commit();
            return true;
        }catch (\Exception $d){
            DB::rollBack();
            return false;
        }
    }
}
