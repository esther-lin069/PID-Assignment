<?php

namespace App\Http\Controllers;

use App\Order;
use App\OrderDetail;
use App\Product;
use DB;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //排序失敗，同志仍需努力
        $orders = $request->user()->orders->sortByDesc('create_at');
        //dd($request->user());
        return view('order.index', compact('orders'));
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
    public function store(Request $request)
    {
        $user = $request->user();

        DB::transaction(function () use ($user, $request){
            
            $order = new Order;
            $order->user_id = $user->id;
            $order->address = $request->address;
            $order->total = 0; //暫時存著，下一步會修改
            $order->closed = 0;
            
            $order->save();       

            $total = 0;

            //利用blade傳來的name = amount[id]表單接收request資料
            foreach($request->amount as $product_id => $amount){
                $product = Product::find($product_id); //取得商品資料
                $item = new OrderDetail;
                $item->order_id = $order->id;
                $item->product_id = $product_id;
                $item->amount = $amount;
                $item->price = $product->price;

                $item->save();
                $total += $product->price * $amount;
            }

            //更新訂單總額
            $order->total = $total;
            $order->update();

            //清空購物車
            $user->carts()->delete();

        });

        return redirect()->route('order.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        //
    }
}
