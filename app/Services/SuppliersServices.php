<?php

namespace App\Services;

use App\Repository\SuppliersRepository;

class SuppliersServices
{
    public function __construct(
        protected SuppliersRepository $suppliersRepository
    ){}

    public function getActiveSuppliers()
    {
        return $this->suppliersRepository->getActiveSuppliers();
    }

    public function getSuppliers($request)
    {
        return $this->suppliersRepository->getSuppliers($request);
    }

    public function getSupplier($id)
    {
        return $this->suppliersRepository->getSupplier($id);
    }

    public function saveSupplier($request)
    {
        return $this->suppliersRepository->createSupplier($request);
    }

    public function updateSupplier($request, $id)
    {
        return $this->suppliersRepository->updateSupplier($request, $id);
    }

    public function deleteSupplier($id)
    {
        return $this->suppliersRepository->deleteSupplier($id);
    }

}
