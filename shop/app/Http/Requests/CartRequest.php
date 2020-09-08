<?php

namespace App\Http\Requests;

use App\Product;
use Illuminate\Support\Facades\Auth;
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
        //放入購物車時驗證權限 無則發送403
        $v = Auth::user()->verify;
        if(!$v){
            return false;
        }
        return true;
        
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(){
         return [
            'product_id' => [
                'required',
                function ($attribute, $value, $fail) {
                    if (!$product = Product::find($value)) {
                        return $fail('該商品不存在');
                         
                    }
                    if (!$product->on_sale) {
                        return $fail('該商品已完售');
                         
                    }
                },
            ],
            'amount' => ['required', 'integer', 'min:1'],
        ];
    }

    
}
