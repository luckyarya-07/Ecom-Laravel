<?php

namespace App\Http\Requests;
use Auth;
use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
        'slug' => [
		    'required',
		    Rule::unique('products', 'slug')->ignore($this->Auth::id())
	    ],
        'sku' => [
		    'required',
		    Rule::unique('products', 'sku')->ignore($this->Auth::id())
	    ]
        ];
    }
}
