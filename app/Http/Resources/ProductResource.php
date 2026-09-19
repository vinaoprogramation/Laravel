<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'sku' => $this->sku,
            'price' => (float) $this->price, 

            'formatted_price' => 'R$' . number_format($this->price, 2, ',' , '.'),

            'created_at' => $this->created_at->toIso8601String(),

            //CASO DE ENVIO DE DADOS PARA ADMIN
            //'cost_price' => $this->when($request->user()?->isAdmin(), $this->cost_price),

        ];
    }
}
