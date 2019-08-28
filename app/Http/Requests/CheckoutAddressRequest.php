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
            'address.billing.email' => [
                'sometimes', 'required', 'email', 'unique:users,email'
            ],
            'address.billing.email' => [
                'sometimes', 'nullable', 'email', 'unique:users,email'
            ],
            'address.*.first_name' => [
                'sometimes', 'required', 'max:50', new AlphaNumHyphenSpace
            ],
            'address.*.last_name' => [
                'sometimes', 'required', 'max:50', new AlphaNumHyphenSpace
            ],
            'address.*.street_address' => [
                'sometimes', 'required', 'max:150'
            ],
            'address.*.postal_code' => [
                'sometimes', 'required', 'max:16', new AlphaNumHyphenSpace
            ],
            'address.*.city' => [
                'sometimes', 'required', 'max:50', new AlphaNumHyphenSpace
            ],
            'address.*.country' => [
                'sometimes', 'required', Rule::in(Country::codes())
            ],
            'address.*.phone' => [
                'sometimes', 'required',
            ],
        ];
    }
}
