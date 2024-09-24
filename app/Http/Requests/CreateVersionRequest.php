<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateVersionRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'version_id' => 'required',
            'content' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'version_id.required' => 'Mã phiên bản không được để trống',
            'content.required' => 'Nội dung không được để trống',
        ];
    }
}
