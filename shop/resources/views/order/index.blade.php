@extends('layouts.app')
@section('content')
    <h2 class="title">訂單列表</h2><p>（列出近10筆訂單）</p>
    <div style="height: 40px"></div>
    @forelse ($orders as $order)
    <div class="card @if($order->closed) border-secondary @else border-info @endif mb-3">
        <div class="card-header text-white @if($order->closed) bg-secondary @else bg-info @endif">
            訂單日期：{{ $order->created_at}}
            <span class="float-right">
                訂單狀態：
                @if($order->closed)
                    已完成
                @else
                    處理中
                @endif
            </span>
        </div>
        <div class="card-body">
            <ul class="list-group list-group-flush">
                <li class="list-group-item">訂購人： {{ Auth::user()->name }}</li>
                <li class="list-group-item">運送地址： {{ $order->address }}</li>
                <li class="list-group-item">訂單總計： {{ $order->total }} 元</li>
                <li class="list-group-item float-right">訂單明細： <button type="button" class="btn btn-outline-secondary btn_detail">點我</button></li>
            </ul>

            <div style="display: none">
                <table class="table">
                    <thead class="thead-light">
                        <tr>
                            <th colspan=2>商品名稱</th>
                            <th nowrap class="text-right">商品單價</th>
                            <th nowrap class="text-center">購買數量</th>
                            <th nowrap class="text-right">小計</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($order->details as $item)
                        <tr>
                            <td>
                                <a target="_blank" href="/product/{{ $item->product_id }}">
                                    <img src="{{ $item->product->image_url }}" class="img-thumbnail" style="width: 120px;">
                                </a>
                            </td>
                            <td>
                                <a target="_blank" href="/product/{{ $item->product_id }}">
                                    <h5>{{ $item->product->title }}</h5>
                                </a>
                                @if(!$item->product->on_sale)
                                    <div class="warning">此商品目前已下架</div>
                                @endif
                            </td>
                            <td class="text-right">
                                {{ $item->product->price }} 元
                            </td>
                            <td class="text-center">
                                {{ $item->amount }}
                            </td>
                            <td class="text-right">
                                {{ $item->product->price * $item->amount }} 元
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                    <tr>
                        <th colspan=5 class="text-right">
                            共計 {{ $order->total }} 元
                        </th>
                    </tr>
                </table>
            </div>
            
        </div>
    </div>
    
    @empty
    <div class="alert alert-info">
        <h2>尚無訂單</h2>
    </div>
        
    @endforelse


@section('orders')
    <script>

        $(function(){
            $(".btn_detail").click(function(){
                $(this).css("display", "none");
                $(this).closest("div").children("div").css("display", "block");
                
                console.log($(this).closest("div").children("div"));
            })
        })

    </script>
@show


@endsection