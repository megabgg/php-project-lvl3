<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UrlRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'url.name' => 'required|max:255|url'
        ];
    }

    public function messages()
    {
        return [
            'url.name.required' => 'Введите адрес сайта',
            'url.name.max' => 'Максимальное количество символов: 255',
            'url.name.url' => 'Некорректный URL'
        ];
    }
}
