<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use App\Helpers\ResponseHelper;

class AdminRegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:50'],
            'username' => ['required', 'string', 'max:20', 'unique:admins,username'],
            'phone' => ['required', 'string', 'max:20', 'unique:admins,phone'],
            'email' => ['required', 'email', 'max:50', 'unique:admins,email'],
            'password' => ['required', 'string', 'min:8', 'max:50'],
            'token' => ['nullable', 'string', 'max:255', 'unique:admins,token'],
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(ResponseHelper::buildResponse(400, 'error', $validator->getMessageBag()));
    }
}
