<?php

namespace App\Http\Requests\Contract;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    public function rules()
    {
        return [

            'name' => ['required'],
            'price' => ['required', 'integer'],
            'start_date' => ['required', 'date'],
            'end_date' => ['required', 'date'],
            'split' => ['sometimes'],

        ];
    }

    public function authorize()
    {
        return true;
    }
}
