<?php

namespace App\Http\Requests;

use App\Facades\Country;
use Illuminate\Validation\Rule;
use App\Rules\AlphaNumHyphenSpace;
use Illuminate\Foundation\Http\FormRequest;

class CheckoutAddressRequest extends FormRequest
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
            '*.email' => [
                'sometimes', 'required', 'email', 'unique:users,email'
            ],
            '*.first_name' => [
                'sometimes', 'required', 'max:50', new AlphaNumHyphenSpace
            ],
            '*.last_name' => [
                'sometimes', 'required', 'max:50', new AlphaNumHyphenSpace
            ],
            '*.street_address' => [
                'sometimes', 'required', 'max:150', new AlphaNumHyphenSpace
            ],
            '*.postal_code' => [
                'sometimes', 'required', 'max:16', new AlphaNumHyphenSpace
            ],
            '*.city' => [
                'sometimes', 'required', 'max:50', new AlphaNumHyphenSpace
            ],
            '*.country' => [
                'sometimes', 'required', Rule::in(Country::codes())
            ],
            '*.phone' => [
                'sometimes', 'required',
            ],
        ];
    }
}
