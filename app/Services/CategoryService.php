<?php

namespace App\Services;

use App\Models\Category;

class CategoryService
{

    public function saveCategory($request, $category)
    {
        $category->name = $request->name;
        $category->save();
    }

    public function deleteCategory($id)
    {
        $category = Category::find($id);
        $category->delete();
    }

}
