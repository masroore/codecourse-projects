<?php

namespace App\Http\Requests\Referrals;

use App\Rules\NotReferringExisting;
use App\Rules\NotReferringSelf;
use Illuminate\Foundation\Http\FormRequest;

class ReferralStoreRequest extends FormRequest
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
            'email' => [
                'required',
                'email',
                new NotReferringExisting($this->user()),
                new NotReferringSelf($this->user()),
            ],
        ];
    }
}
