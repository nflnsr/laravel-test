<?php

namespace App\Http\Requests;

use App\Helpers\ResponseHelper;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class EmployeeCreateRequest extends FormRequest
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
            // base64 image
            // 'image' => ['required', 'regex:/^data:image\/(jpeg|png|gif|bmp|webp);base64,/', 'max:65535'],
            // url cloud image
            // 'image' => ['required', 'string', 'regex:/^https:\/\/.+$/'],
            'image' => ['required', 'string'],
            'name' => ['required', 'string', 'max:50'],
            'phone' => ['required', 'string', 'max:20', 'unique:employees,phone'],
            'division_id' => ['required', 'string'],
            'position' => ['required', 'string', 'max:50'],
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(ResponseHelper::buildResponse(400, 'error', $validator->getMessageBag()));
    }
}
