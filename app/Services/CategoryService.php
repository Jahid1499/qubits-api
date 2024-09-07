<?php

namespace App\Services;

use App\Repository\CategoryRepository;

class CategoryService
{
    private $categoryRepository;
    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function getAllActiveCategories()
    {
        return $this->categoryRepository->getAllActiveCategories();
    }

    public function getAll($request)
    {
        return $this->categoryRepository->getAll($request);
    }

    public function saveCategory($request)
    {
        return $this->categoryRepository->saveCategory($request);
    }

    public function getCategory($id)
    {
        return $this->categoryRepository->getCategory($id);
    }
    public function updateCategory($request, $id)
    {
        return $this->categoryRepository->updateCategory($request, $id);
    }

    public function deleteCategory($id)
    {
        return $this->categoryRepository->deleteCategory($id);
    }
}
