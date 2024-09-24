<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductDetailsRequest extends FormRequest
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
            // 'image' => 'required',
            'price' => 'required|numeric',
            'sale' => 'required|numeric',
            'description' => 'required',
            'content' => 'required',
            'guide' => 'required',
        ];
    }

    public function messages()
    {
        return [
            // 'image.required' => 'Ảnh sản phẩm không được để trống',
            'price.required' => 'Giá tiền không được để trống',
            'price.numeric' => 'Giá tiền phải là số',
            'sale.required' => 'Giá giảm không được để trống',
            'sale.numeric' => 'Giá giảm phải là số',
            'description.required' => 'Mô tả không được để trống',
            'content.required' => 'Nội dung không được để trống',
            'guide.required' => 'Hướng dẫn sử dụng không được để trống',
        ];
    }
}
