@extends('layouts.app')
@section('content')
    <h1>我的購物車</h1>
    <table class="table table-striped">
        <tr>
            <th colspan=2>商品名稱</th>
            <th nowrap class="text-right">商品單價</th>
            <th nowrap class="text-center">購買數量</th>
            <th nowrap class="text-right">小計</th>
            <th>功能</th>
        </tr>
        @php
            $total = 0;
        @endphp
        @forelse($user->carts as $cart)
            <tr>
                <td>
                    <a target="_blank" href="/product/{{ $cart->product_id }}">
                        <img src="{{ $cart->product->image_url }}" class="img-thumbnail" style="width: 120px;">
                    </a>
                </td>
                <td>
                    <a target="_blank" href="/product/{{ $cart->product_id }}"><h5>{{ $cart->product->title }}</h5></a>
                    @if(!$cart->product->on_sale)
                        <div class="warning">您已錯過本商品</div>
                    @endif
                </td>
                <!-- 包含cart id的物件id，方便抓取index -->
                <td class="text-right">
                    <span id="price-{{ $cart->id }}">
                    {{ $cart->product->price }}
                    </span>
                </td>
                <!-- 購買數量與小計動態調整 -->
                <td class="text-center">
                    <input type="number" min="1" class="form-control text-center amount" 
                    name="amount[{{ $cart->product_id }}]" value="{{ $cart->amount }}" data-cartid="{{ $cart->id }}">
                </td>
                <td class="text-right">
                    <span class="sum" id="sum-{{ $cart->id }}">{{ $cart->product->price * $cart->amount }}</span>
                </td>
                <td nowrap><a href="#" data-id="{{ $cart->product_id }}" class="btn btn-danger btn-sm btn-del-cart-item">移除</a></td>
            </tr>
            <!-- 加入計算總額的程式碼 -->
            @php
                $total += $cart->product->price * $cart->amount    
            @endphp
        @empty

        <tr>
            <td><h3>購物車是空的(´⊙ω⊙`)還不快去買東西！</h3></td>
        </tr>
    @endforelse
    <!-- 加入小計欄位th -->
    <tr>
        <th colspan=4 nowrap class="text-right">總計：</th>
        <th nowrap class="text-right">
            <span id="total">{{ $total }}</span>
        </th>
        <th nowrap class="text-left">元</th>
    </tr>
    </table>
@endsection

@section('scriptsAfterJs')
    @include('product.add_cart')
@endsection