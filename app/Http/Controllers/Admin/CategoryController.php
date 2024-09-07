<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Services\CategoryService;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    use ApiResponseTrait;
    private $categoryService;
    public function __construct(CategoryService $categoryService )
    {
        $this->categoryService = $categoryService;
    }

    public function getAllActiveCategories()
    {
        $categories = $this->categoryService->getAllActiveCategories();
        return $this->successResponse($categories, "Categories retrieved successfully", 200);
    }
    public function index(Request $request)
    {
        $categories = $this->categoryService->getAll($request);
        return $this->successResponse($categories, "Categories retrieved successfully", 200);
    }

    public function store(CategoryRequest $request)
    {
        $this->categoryService->saveCategory($request->all());
        return $this->successResponse("", "Category created successfully", 201);
    }

    public function show($id)
    {
        $category = $this->categoryService->getCategory($id);
        return $this->successResponse($category, "Category found successfully", 200);
    }
    public function update(CategoryRequest $request, $id)
    {
        $this->categoryService->updateCategory($request->all(), $id);
        return $this->successResponse("", "Category update successfully", 200);
    }

    public function destroy($id)
    {
        $this->categoryService->deleteCategory($id);
        return $this->successResponse("", "Category deleted successfully", 200);
    }
}
