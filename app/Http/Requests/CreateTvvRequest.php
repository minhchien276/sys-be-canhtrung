<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateTvvRequest extends FormRequest
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
            'tenTvv' => 'required',
            'linkZalo' => 'required',
            'soDienThoai' => [
                'required',
                'regex:/^(0[3|5|7|8|9]|\+?84)([0-9]{8}|[0-9]{9})\b$/',
            ],
            'linkAnh' => 'required',
            'kinhnghiem' => 'required',
            'gioithieu' => 'required',
            // 'rating' => 'required|numeric',
            'linkFb' => 'required',
            'status' => 'required',
            'id_loaitvv' => 'required',
            'email' => 'required|email',
        ];
    }

    public function messages()
    {
        return [
            'tenTvv.required' => 'Tên tư vấn viên không được để trống',
            'linkZalo.required' => 'Link zalo không được để trống',
            'soDienThoai.required' => 'Số điện thoại không được để trống',
            'soDienThoai.regex' => 'Số điện thoại không hợp lệ',
            'linkAnh.required' => 'Link ảnh không được để trống',
            'kinhnghiem.required' => 'Kinh nghiệm không được để trống',
            'gioithieu.required' => 'Giới thiệu không được để trống',
            // 'rating.required' => 'Rating không được để trống',
            // 'rating.numeric' => 'Rating phải là một số',
            'linkFb.required' => 'Link facebook không được để trống',
            'status.required' => 'Trạng thái không được để trống',
            'id_loaitvv.required' => 'Loại tư vấn viên không được để trống',
            'email.required' => 'Email không được để trống',
            'email.email' => 'Email không hợp lệ',
        ];
    }
}
