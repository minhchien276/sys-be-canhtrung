<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class updateVoucherRequest extends FormRequest
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
            'discount' => 'required|numeric',
            'minPrice' => 'required|numeric',
            'maxPrice' => 'required|numeric',
            'status' => 'required',
            'expired' => 'required',
            'expired' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'discount.required' => 'discount không được để trống',
            'discount.numeric' => 'discount không hợp lệ',
            'minPrice.required' => 'minPrice không được để trống',
            'minPrice.numeric' => 'minPrice không hợp lệ',
            'maxPrice.required' => 'maxPrice không được để trống',
            'maxPrice.numeric' => 'maxPrice không hợp lệ',
            'status.required' => 'status không được để trống',
            'idTypeVoucher.required' => 'idTypeVoucher không được để trống',
            'expired.required' => 'expired không được để trống',
        ];
    }
}
