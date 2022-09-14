<?php

namespace App\Services\Categories;

use App\Repositories\Categories\CategoryRepositoryInterface;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use InvalidArgumentException;

class CategoryService implements CategoryServiceInterface
{
    private $categoryRepository;
    public function __construct(CategoryRepositoryInterface $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function getCategoryInfo(int $categoryId)
    {
        return $this->categoryRepository->getCategoryInfo($categoryId);
    }

    public function deleteCategory($ids)
    {
        return $this->categoryRepository->deleteCategory($ids);
    }

    public function createCategory($categoryData)
    {
        $validator = Validator::make($categoryData,[
            'name'=>'required|max:500',
        ]);
        if($validator->fails()){
            throw new InvalidArgumentException($validator->errors()->first());
        }
        return $this->categoryRepository->createCategory($categoryData);
    }

    public function updateCategory($categoryData,$id)
    {
        return $this->categoryRepository->updateCategory($categoryData,$id);
    }

    public function index()
    {
        return $this->categoryRepository->index();
    }
}