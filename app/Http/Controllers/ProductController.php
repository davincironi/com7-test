<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use Illuminate\Http\Request;
use App\Services\ProductService;
use App\Models\Product;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Cache;

class ProductController extends Controller
{
    private $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    public function index(Request $request)
    {
        $products = Product::orderBy('id');

        if ($request->has('category_id')) {
            $products = $products->where('category_id', $request->get('category_id'));
        }

        return $products->paginate(50);
    }

    public function store(ProductRequest $request)
    {
        $product = new Product();
        $this->productService->saveProduct($request, $product);
        return response($product, Response::HTTP_CREATED);
    }

    public function show($id)
    {
        return Product::with('category')->findOrFail($id);
    }

    public function update(ProductRequest $request, $id)
    {
        $product = Product::findOrFail($id);
        $this->productService->saveProduct($request, $product);
        return response($product, Response::HTTP_CREATED);
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        Product::destroy($id);
    }

    public function cacheList(Request $request)
    {
        $products = Cache::remember('products', now()->addMinutes(10), function () {
            return Product::all();
        });
        return $products;
    }
}
