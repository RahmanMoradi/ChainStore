<?php

namespace App\Http\Requests\Shop;

use Illuminate\Foundation\Http\FormRequest;

class UpdateShopRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'city_id' => ["integer", 'exists:cities,id'],
            'number' => ['integer'],
            'name' => ["min:3", "max:40"],
            'address' => ["string", "min:10", "max:255"],
        ];
    }
}
