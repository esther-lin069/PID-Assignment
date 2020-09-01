<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Cookie;
use Illuminate\Http\Request;
use App\Product;

class CartController extends Controller
{
    public function index(Request $request){
        

        
    }

    //still bug here
    public function addCookies(Request $request, $id, $amount=10){        
        $cart_value = json_decode(self::getCookies(),true);
        $cart_item = ['id' => $id  , 'amount' => intval($amount)];  

        if(!empty($cart_value)){

            if(array_search($cart_item,$cart_value) === false && $cart_value[count($cart_value)-1]['id'] != $id){

                $cart_value[] = $cart_item;
                Cookie::queue('cart', json_encode($cart_value), 360);

            }
            else{
                $index = array_search($cart_item,$cart_value);
                if($cart_value[$index]['id'] == $id){
                    $cart_value[$index]['amount'] += $amount;
                    
                }
                else{
                    $cart_value[count($cart_value)-1]['amount'] += $amount;
                }
                
            }          
        }
        else{
            $cart_value[] = $cart_item;
            Cookie::queue('cart', json_encode($cart_value), 360);
            echo "B";
        }

        print_r($cart_value);
        
    }

    public function getCookies(){
        $cookies = Cookie::get('cart');

        return $cookies;
    }

    
}
