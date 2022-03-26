<?php

namespace App\Http\Requests\Forum;

use App\Http\Requests\Request;

class GetTopicsFormRequest extends Request
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
            'section_id' => 'required|exists:sections,id',
        ];
    }
}
