<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;

class CartController extends Controller
{
    public function index(Request $request){
        

        
    }

    public function addCookies(Request $request, $id, $amount=10){
        $cart_item = ['item' => 1, 'amount' => 10];
        var_dump(json_decode($request->cookie('cart'),true));

        $cart_value = json_decode($request->cookie('cart'),true);
        $cart_value[] = $cart_item;
        return response('add to cart_cookies')->cookie('cart', json_encode($cart_value), time()+3600);
    }
}
