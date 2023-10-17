<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ForgotPasswordRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'email' => 'bail|required|email|string',
        ];
    }

    public function messages()
    {
        return [
            'email.required' => 'Email must not leave blank.',
            'email.email' => 'Email must be in the format.',
            'email.string' => 'Email must be a string type.'
        ];
    }
}
