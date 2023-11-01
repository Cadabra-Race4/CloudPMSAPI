<?php

namespace App\Http\Requests\Leave;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class CreateLeaveTypeRequest extends FormRequest
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
            'type_name' => 'bail|string|max:255|unique:leave_types,type_name|required'
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        $data = ['error' => $validator->errors()];
        $result = $this->apiResponse->errorResponse("UNPROCESSABLE_ENTITY", $data);
        throw new HttpResponseException(response()->json($result, $result['status']));
    }
}
