<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ResetPasswordRequest extends FormRequest
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
            'matKhauMoi' => 'required|min:6',
            'xacNhanMatKhau' => 'required|min:6|same:matKhauMoi',
        ];
    }

    public function messages()
    {
        return [
            'matKhauMoi.required' => 'Mật khẩu mới không được để trống',
            'matKhauMoi.min' => 'Mật khẩu mới tối thiểu phải đủ 6 ký tự',
            'xacNhanMatKhau.required' => 'Xác mật khẩu không được để trống',
            'xacNhanMatKhau.min' => 'Xác mật khẩu tối thiểu phải đủ 6 ký tự',
            'xacNhanMatKhau.same' => 'Xác mật khẩu không trùng với mật khẩu mới',
        ];
    }
}
