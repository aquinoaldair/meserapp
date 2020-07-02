<?php

namespace App\Http\Requests;

use App\Rules\WaiterRule;
use App\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class WaiterUpdateRequest extends FormRequest
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
            'name' => 'required',
            'email' => new WaiterRule($this->waiter),
            'password' => 'max:255',
            'address' => 'max:255',
            'phone' => 'max:255'
        ];
    }
}
