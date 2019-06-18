<?php
namespace App\Service;

use App\InterfaceService\CategoryInterface;
use App\Category; // model
/**
 *
 */
class CategoryService implements CategoryInterface
{
    public function getAll()
    {
        $categories = Category::all();
        return $categories;
    }

    public function getCategoryById($category)
    {
        $category = Category::find($category);
        return $category;
    }

    public function createCategory($data)
    {
        $category = new Category($data);
        $category->save();
    }

    public function deleteCategory($id)
    {
        Post::destroy( $id );
    }
}

