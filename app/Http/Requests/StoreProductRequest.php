<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'name' => strip_tags(trim($this->name ?? '')),
            'sku' => strtoupper(trim($this->sku ?? '')),
        ]);
    }

    
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:100'],
            'sku' => ['required', 'string', 'alpha_dash', 'max:20'],
            'price' => ['required', 'numeric', 'min:0.01']
        ];
    }
}
