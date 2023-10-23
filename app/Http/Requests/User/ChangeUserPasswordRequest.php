<?php

namespace App\Http\Requests\User;

use App\Handler\ApiResponseHandler;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class ChangeUserPasswordRequest extends FormRequest
{

    protected $apiResponse;

    public function __construct()
    {
        $this->apiResponse = new ApiResponseHandler();
    }

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
            'old_password' => 'bail|string|max:255',
            'password' => 'bail|string|max:255|confirmed',
            'password_confirmation' => 'bail|string|max:255',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        $data = ['error' => $validator->errors()];
        $result = $this->apiResponse->errorResponse("UNPROCESSABLE_ENTITY", $data);
        throw new HttpResponseException(response()->json($result, $result['status']));
    }
}
