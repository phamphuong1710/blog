<?php

namespace App\InterfaceService;

interface CategoryInterface {
    public function getAll();
    public function getCategoryById($category);
    public function createCategory($data);
    public function deleteCategory($id);
}
