<?php

namespace App\Repositories\Categories;

use App\Repositories\RepositoryInterface;
use Illuminate\Contracts\Cache\Repository;
use Symfony\Component\Translation\Exception\NotFoundResourceException;

interface CategoryRepositoryInterface extends RepositoryInterface
{
    public function getCategoryInfo(int $categoryId);

    public function createCategory(array $categoryData);

    public function deleteCategory($ids);

    public function updateCategory($categoryData,$id);

    public function index();
}