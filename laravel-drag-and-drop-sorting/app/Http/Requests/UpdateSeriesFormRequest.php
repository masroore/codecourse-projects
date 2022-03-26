<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSeriesFormRequest extends FormRequest
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
            'title' => 'required',
            'parts.*.title' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'You must enter a series title!',
            'parts.*.title.required' => 'You need to give this part a title!',
        ];
    }
}
