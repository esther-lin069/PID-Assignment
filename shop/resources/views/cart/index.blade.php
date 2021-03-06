@extends('layouts.app')
@section('content')
    <h2 class="title">購物車列表</h2>
    <div style="height: 40px"></div>
    <form action="{{ route('order.store') }}" method="post" id="form-order">
        @csrf

        <table class="table table-hover">
            <tr class="table-active">
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
                        {{-- 將多項的amount用陣列[]為name，值為['product_id=>amount']id對應數量  --}}
                        name="amount[{{ $cart->product_id }}]" value="{{ $cart->amount }}" data-cartid="{{ $cart->id }}">
                    </td>
                    <td class="text-right">
                        <span class="sum" id="sum-{{ $cart->id }}">{{ $cart->product->price * $cart->amount }}</span>
                    </td>
                    <td nowrap><a href="#" data-id="{{ $cart->product_id }}" class="btn btn-outline-danger btn-sm btn-del-cart-item">移除</a></td>
                </tr>
                <!-- 加入計算總額的程式碼 -->
                @php
                    $total += $cart->product->price * $cart->amount    
                @endphp
            @empty

            <tr>
                <td colspan="6">
                    <div class="alert alert-info text-center">
                        <h2>購物車是空的(´⊙ω⊙`)還不快去買東西！</h2>
                    </div>
                </td>
            </tr>
        @endforelse
        <!-- 加入小計欄位th -->
        <tr class="table-active">
            <th colspan=4 nowrap class="text-right">總計：</th>
            <th nowrap class="text-right">
                <span id="total">{{ $total }}</span>
            </th>
            <th nowrap class="text-left">元</th>
        </tr>
        </table>
        @if (count($user->carts))
            <div class="form-group">
                <label for="address">收貨地址</label>
                <input type="text" class="form-control" name="address" value="{{ $user->address }}">
            </div>
            <button type="submit" class="btn btn-primary">送出訂單</button>
        @endif
    </form>
@endsection

@section('scriptsAfterJs')
    @include('product.add_cart')
@endsection