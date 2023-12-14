<?php

namespace App\Http\Requests\Order;

use Illuminate\Foundation\Http\FormRequest;

class StoreOrderRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'user_id' => ['required', "integer", 'exists:users,id'],
            'shop_id' => ['required', "integer", 'exists:shops,id'],
            'status' => ['required', "string", "max:40"],
            'total' => ['required', 'integer'],
        ];
    }
}
