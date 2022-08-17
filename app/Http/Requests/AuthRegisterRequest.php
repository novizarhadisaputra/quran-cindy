<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AuthRegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'email' => ['required', 'unique:users,email'],
            'password' => ['required', 'min:8', 'confirmed'],
            'first_name' => ['required'],
            'last_name' => ['required'],
            'phone' => ['nullable', 'unique:user_details,phone']
        ];
    }
}
