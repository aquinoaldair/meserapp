<?php

namespace App\Http\Requests;

use App\Rules\CommerceRule;
use App\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CommerceUpdateRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', new CommerceRule($this->commerce)],
            'password' => ['nullable', 'string','min:8'],
            'prefix_phone' => ['required', 'integer', 'digits_between:1,5'],
            'phone_number' => ['required', 'integer', 'digits_between:5,12'],
            'address' => ['string', 'max:255'],
            'latitude' => ['required_with:address'],
            'longitude' => ['required_with:address']
        ];
    }
}
