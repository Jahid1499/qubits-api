<?php

namespace App\Services;

use App\Repository\ModuleRepository;

class ModuleService
{
    public function __construct(protected ModuleRepository $repository) {}

    public function list($request)
    {
        return $this->repository->list($request);
    }

    public function store($data)
    {
        return $this->repository->store($data);
    }

    public function show($id)
    {
        return $this->repository->show($id);
    }

    public function update($data, $id)
    {
        return $this->repository->update($data, $id);
    }

    public function delete($id)
    {
        return $this->repository->delete($id);
    }
}
