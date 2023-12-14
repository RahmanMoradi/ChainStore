<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            "city_id" => ["required", "integer", "exists:cities,id"],
            "name" => ["required", "string", "min:3", "max:40"],
            "mobile" => ["required", "string", "unique:users,mobile", "min:10", "max:14"],
            "password" => ["required", "string", "confirmed", "min:8", "max:255"],
            "password_confirmation" => ["same:password"],
        ];
    }
}
