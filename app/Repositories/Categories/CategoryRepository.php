<?php

namespace App\Repositories\Categories;

use App\Models\Category;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;

class CategoryRepository extends BaseRepository implements CategoryRepositoryInterface
{
    public function getModel()
    {
        return Category::class;
    }

    public function getCategoryInfo(int $categoryId)
    {
        return Category::findOrfail($categoryId);
    }

    public function createCategory(array $categoryData)
    {
        $createCategory = Category::create($categoryData);
        if(!($createCategory)){
            return null;
        }
    }

    public function deleteCategory($ids)
    {
        $category = $this->find($ids);
        $category->delete();
        return $category;
    }

    public function updateCategory($categoryData, $id)
    {
        $category = $this->find($id);
        $category->name = $categoryData['name'];
        $category->update();
        return $category;
    }

    public function index()
    {
        return Category::orderBy('id','DESC')->paginate(8);
    }

}