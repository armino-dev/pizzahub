<?php

namespace App\Http\Requests\Basket\Item;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
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
            'product-id' => 'numeric|required|exists:App\Models\Product,id',
            'item-quantity' => 'integer|required|min:1|max:100',
        ];
    }
}
