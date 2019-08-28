<?php

namespace App\Http\Controllers;

use App\Exceptions\CategoryException;
use App\http\model\CategoryModel;

class CategoryController extends Controller
{
    public function getAllCategories()
    {
        $categories = CategoryModel::with('img')->get();
        if ($categories->isEmpty()) {
            throw new CategoryException();
        }
        return $categories;
    }
}
