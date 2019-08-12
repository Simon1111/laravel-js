<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProduct extends FormRequest
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
            'name' => 'required|string|min:5|max:300', // заголовок
            'price' => 'required|integer|min:1|max:1000', 
            'price_lid' => 'required|integer|min:1|max:10000', 
            'cost_email' => 'required|integer|min:1|max:1000', 
            'cost_sends' => 'required|integer|min:1|max:1000', 
            'approve' => 'required|integer|min:1|max:100', 
            'buyout' => 'required|integer|min:1|max:100', 
        ];
    }
}
