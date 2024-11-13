<?php
namespace App\Services;

use App\Models\Product;

class ProductService
{
    public function getAll()
    {
        return Product::all();
    }

    public function show(Product $product)
    {
        return $product;
    }

    public function create($data)
    {
        return Product::create($data);
    }

    public function update(Product $product, array $data)
    {
        if($product)
        {
            $product->update($data);
            return $product;
        }

        return null;
    }

    public function delete(Product $product)
    {
        if($product)
        {
            $product->delete();
            return true;
        }

        return false;
    }
}
