<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductUpdateRequest extends FormRequest
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
            'category_id' => 'required|integer',
            'station_id' => 'required|integer',
            'stock' => 'required',
            'margin' => 'max:255',
            'description' => 'string',
            'file_device' => 'nullable',
            'file_gallery' => 'nullable|string'
        ];
    }
}
