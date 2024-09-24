<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateVideoRequest extends FormRequest
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
            'link_video' => 'required',
            'content' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'link_video.required' => 'Link video không được để trống',
            'content.required' => 'Nội dung không được để trống',
        ];
    }
}
