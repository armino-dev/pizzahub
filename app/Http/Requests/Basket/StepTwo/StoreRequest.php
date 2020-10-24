<?php

namespace App\Http\Requests\Basket\StepTwo;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
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
            'email' => 'required|email',
            'phone' => 'required|min:4|max:14',
            'name' => 'required|min:3|max:50',
            'address' => 'required|min:10|max:255',
            'city' => 'required|in:bucharest,bragadiru',
            'zip' => 'required|min:3|max:10',
        ];
    }
}
