<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ImageStoreRequest extends FormRequest
{


    public function authorize()
    {
        return true;
    }


    public function rules()
    {
        return [
            'image' => ['file_device'],
            'keywords' => ['required', 'string', 'max:255']
        ];
    }
}
