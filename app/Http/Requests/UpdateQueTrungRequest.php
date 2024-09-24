<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateQueTrungRequest extends FormRequest
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
            'soLuongQueTrung' => 'required|numeric|integer|min:0',
        ];
    }

    public function messages()
    {
        return [
            'soLuongQueTrung.required' => 'Số lượng que trứng không được để trống',
            'soLuongQueTrung.numeric' => 'Số lượng que không hợp lệ',
            'soLuongQueTrung.integer' => 'Số lượng que không hợp lệ',
            'soLuongQueTrung.min' => 'Số lượng que không hợp lệ',
        ];
    }
}
