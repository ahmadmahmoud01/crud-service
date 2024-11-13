<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Models\Product;
use App\Services\ProductService;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    private $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    public function index()
    {
        $products = $this->productService->getAll();
        return api_response(true, 'Data retrieved successfully', $products);
    }


    public function store(ProductRequest $request)
    {
        $product = $this->productService->create($request->validated());
        return api_response(true, 'Product created successfully', $product, 201);
    }

    public function show(Product $product)
    {
        $product = $this->productService->show($product);
        if (!$product) {
            return $this->api_response(false, 'Product not found');
        }
        return api_response(true, 'Product retrieved successfully', $product);
    }


    public function update(ProductRequest $request, Product $product)
    {
        if (!$product) {
            return api_response(false, 'Product not found', null, 404);
        }
        $product = $this->productService->update($product, $request->validated());
        return api_response(true, 'Product updated successfully', $product);
    }

    public function destroy(Product $product)
    {
        if (!$product) {
            return api_response(false, 'Product not found', null, 404);
        }

        $this->productService->delete($product);
        return api_response(true, 'Product deleted successfully', $product);
    }
}
