<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CostStoreRequest extends FormRequest
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
            'name'          =>    ['required', 'string', 'max:255'],
            'supplier_id'   =>    ['nullable', 'integer'],
            'cost'          =>    ['required', 'regex:/^\d+(\.\d{1,2})?$/'],
            'description'   =>    ['nullable', 'max:255'],
            'comment'       =>    ['nullable', 'max:500'],
            'bill'          =>    ['nullable', 'max:255']
        ];
    }
}
