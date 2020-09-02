<?php

namespace App\Http\Controllers;

use App\Cart;
use Illuminate\Http\Request;
use App\Http\Requests\CartRequest;


class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {   //只傳送購物車的資料會讓該頁沒辦法得到其他使用者的資訊（購物車裡沒有的）
        //所以這裡只要傳送使用者資料就好，再由關聯去抓取他的購物車內容
        $user = $request->user();
        return view('cart.index',compact('user'));
        // $carts = $request->user()->carts()->get();
        // return view('cart.index',compact('carts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CartRequest $request)
    {   
        //使用者的Cart(所有內容)中搜尋到第一筆重複的資料
        if ($cart = $request->user()->carts()->where('product_id', $request->product_id)->first()) {
            $cart->update([
                'amount' => $cart->amount + $request->amount,
            ]);
        }
        else{
            Cart::create($request->all());
        }
        
        // return redirect()->route('cart.index');
        
        // $cart = new Cart;
        // $cart->user_id = $request->user()->id;
        // $cart->product_id = $request->product_id;
        // $cart->amount = $request->amount;

        // $cart->save();

        // Cart::create([
        //     'user_id'    => $request->user()->id,
        //     'product_id' => $request->product_id,
        //     'amount'     => $request->amount,
        // ]);

        return [];
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function show(Cart $cart)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function edit(Cart $cart)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cart $cart)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cart $cart)
    {
        //
    }
}
