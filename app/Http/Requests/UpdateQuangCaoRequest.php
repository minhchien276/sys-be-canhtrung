<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateQuangCaoRequest extends FormRequest
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
            'image' => 'required',
            'status' => 'required|numeric',
            'link' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'image.required' => 'Ảnh không được để trống',
            'status.required' => 'Trạng thái không được để trống',
            'status.numeric' => 'Trạng thái phải là một số',
            'link.required' => 'Link không được để trống',
        ];
    }
}
