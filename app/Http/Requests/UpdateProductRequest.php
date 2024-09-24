<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
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
            'name' => 'required',
            // 'image' => 'required',
            'loaisanpham_id' => 'required',
            'sold' => 'required|numeric',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Tên sản phẩm không được để trống',
            // 'image.required' => 'Ảnh sản phẩm không được để trống',
            'loaisanpham_id.required' => 'Loại sản phẩm không được để trống',
            'sold.required' => 'Trường đã bán không được để trống',
            'sold.numeric' => 'Trường đã bán không hợp lệ',
        ];
    }
}
