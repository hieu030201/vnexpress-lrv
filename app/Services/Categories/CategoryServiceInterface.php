<?php

namespace App\Services\Categories;

interface CategoryServiceInterface
{
    public function getCategoryInfo(int $categoryId);

    public function deleteCategory($ids);

    public function createCategory($categoryData);

    public function updateCategory($categoryData,$id);

    public function index();
}