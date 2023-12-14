<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'city_id' => ['required', 'exists:cities,id'],
            'name' => ['required', "string", "min:3", "max:40"],
            'mobile' => ['required', "string", "unique:users,id"],
            'mobile_verified_at' => ['nullable', 'date'],
            'password' => ['required', "string"],
            'remember_token' => ['nullable'],
        ];
    }
}
