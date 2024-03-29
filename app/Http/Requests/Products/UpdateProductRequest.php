<?php

namespace App\Http\Requests\Products;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'user_id' => ["integer", 'exists:users,id'],
            'category_id' => ["integer", 'exists:categories,id'],
            'name' => ["string", "min:3", "max:40"],
            'price' => ['integer'],
            'inventory' => ['integer'],
        ];
    }
}
