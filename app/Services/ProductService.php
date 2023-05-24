<?php

namespace App\Services;

use App\Models\Product;

class ProductService
{

    public function saveProduct($request, $product)
    {
        $product->name = $request->name;
        $product->description = $request->description;
        $product->category_id = $request->category_id;
        $product->save();
    }

    public function deleteProduct($id)
    {
        $category = Product::find($id);
        $category->delete();
    }
}
