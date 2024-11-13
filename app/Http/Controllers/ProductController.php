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

    function api_response($success, $message, $data = null, $status = 200)
    {
        $response = [
            'success' => $success,
            'message' => $message,
            'data'    => $data,
        ];

        return response()->json($response, $status);
    }

    public function index()
    {
        $products = $this->productService->getAll();
        // return response()->json('All Products Returned Succeefully', $products);
        return $this->api_response(true, 'Data retrieved successfully', $products);

    }


    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'description' => 'nullable|string',
        ]);

        $product = $this->productService->create($data);
        // return response()->json($product, 201);
        return $this->api_response(true, 'Product created successfully', $product, 201);

    }

    public function show(Product $product)
    {
        $product = $this->productService->show($product);
        if (!$product) {
            return $this->api_response(false, 'Product not found');
        }
        // return response()->json($product);
        return $this->api_response(true, 'Product retrieved successfully', $product);



    }


    public function update(Request $request, Product $product)
    {
        if (!$product) {
            return $this->api_response(false, 'Product not found', null, 404);
        }
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'description' => 'nullable|string',
        ]);
        // return response()->json($product);
        $product = $this->productService->update($product, $data);
        return $this->api_response(true, 'Product updated successfully', $product);
    }

    public function destroy(Product $product)
    {
        if (!$product) {
            return $this->api_response(false, 'Product not found', null, 404);
        }

        $this->productService->delete($product);
        return $this->api_response(true, 'Product deleted successfully', $product);

    }
}
