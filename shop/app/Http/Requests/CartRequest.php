<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CartRequest extends FormRequest
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
            'product_id' => [
                'required',
                function($attribute, $value, $fail){
                    if(!$product = Porduct::find($value)){
                        return $fail('該商品不存在');
                    }
                    if(!$product->on_sale){
                        return $fail('該商品未上架');
                    }
                }
            ],

            'amount' => ['require','integer','min:1'],
        ];
    }
}
