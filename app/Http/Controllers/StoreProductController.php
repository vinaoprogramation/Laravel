<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use App\Http\Requests\StoreProductRequest;    
use App\Models\Product;

class StoreProductController extends Controller
{
    public function __invoke(StoreProductRequest $request): JsonResponse
    {
        $validated = $request->validated();

        $product = Product::create($validated);

        return response()->json([
            'message' => 'Produto cadastrado com sucesso',
            'data' => $validated
        ], 201);
    }
}
