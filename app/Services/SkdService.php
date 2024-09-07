<?php

namespace App\Services;

use App\Repository\SkdRepository;

class SkdService
{
    private $skd_repository;
    /**
     * Create a new class instance.
     */
    public function __construct(SkdRepository $skd_repository)
    {
        $this->skd_repository = $skd_repository;
    }

    public function getAllSkd($request)
    {
        return $this->skd_repository->getAllSkd($request);
    }

    public function createSkd($data)
    {
        return $this->skd_repository->createSkd($data);
    }

    public function getSkd($id)
    {
        return $this->skd_repository->getSkd($id);
    }

    public function updateSkd($data, $id)
    {
        return $this->skd_repository->updateSkd($data, $id);
    }

    public function deleteSkd($id)
    {
        return $this->skd_repository->deleteSkd($id);
    }
}
