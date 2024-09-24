<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateLinkRequest extends FormRequest
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
            'title' => 'required',
            'description' => 'required',
            'member' => 'required|numeric',
            'tenLink' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'image.required' => 'Ảnh không được để trống',
            'title.required' => 'Tiêu đề không được để trống',
            'description.required' => 'Mô tả không được để trống',
            'member.required' => 'Thành viên không được để trống',
            'member.numeric' => 'Thành viên phải là một số',
            'tenLink.required' => 'Đường link không được để trống',
        ];
    }
}
