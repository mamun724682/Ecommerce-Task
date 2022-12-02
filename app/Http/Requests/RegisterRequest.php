<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class RegisterRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name'             => 'required|string',
            'email'                 => [
                'required',
                'email',
                Rule::unique('users')
            ],
            'password_confirmation' => 'required|min:6',
            'password'              => 'required|min:6|confirmed'
        ];
    }
}
