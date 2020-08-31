<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;

class CartController extends Controller
{
    public function index(Request $request){
        

        
    }

    //still bug here
    public function addCookies(Request $request, $id, $amount=10){
        $cart_value = json_decode($request->cookie('cart'),true);
        print_r($cart_value);
        $cart_item = [$id  => intval($amount)];    
        

        if(!empty($cart_value)){
           
            if(array_key_exists($id, $cart_value)){
                unset($cart_value[$id]);
            }
            else{
                $cart_value[] = $cart_item;
            }   
        }        
        else{
            $cart_value[] = $cart_item;
        }
        
        return response('add to cart_cookies')->cookie('cart', json_encode($cart_value), time()+3600);
    }

    
}
