<?php

namespace App\Http\Requests\Room;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    public function rules()
    {
        return [

            'name' => ['required'],
            'number' => ['required'],
            'type' => ['required'],
        ];
    }

    public function authorize()
    {
        return true;
    }
}
