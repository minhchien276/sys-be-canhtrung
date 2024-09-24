<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateTestResultRequest extends FormRequest
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
            'backgroundColor' => 'required',
            'imageUrl' => 'required',
            'titleText' => 'required',
            'subText' => 'required',
            'textColor' => 'required',
            'progressColor' => 'required',
            'notification' => 'required',
            "titleNotification" => 'required',
        ];
    }

    public function messages()
    {
        return [
            'backgroundColor.required' => 'backgroundColor không được để trống',
            'imageUrl.required' => 'imageUrl không được để trống',
            'titleText.required' => 'titleText không được để trống',
            'subText.required' => 'subText không được để trống',
            'textColor.required' => 'textColor không được để trống',
            'progressColor.required' => 'progressColor không được để trống',
            'notification.required' => 'notification không được để trống',
            'titleNotification.required' => 'notification không được để trống',
        ];
    }
}
