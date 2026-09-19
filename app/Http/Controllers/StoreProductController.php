<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProductResource;
use App\Http\Requests\StoreProductRequest;    
use App\Models\Product;

class StoreProductController extends Controller
{
    public function __invoke(StoreProductRequest $request): ProductResource
    {
        $product = Product::create($request->validated());

        return new ProductResource($product);
    }
}
