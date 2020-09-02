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
        @forelse($user->carts as $cart)
            <tr>
                <td>
                    <a target="_blank" href="/product/{{ $cart->product_id }}">
                        <img src="{{ $cart->product->image_url }}" class="img-thumbnail" style="width: 120px;">
                    </a>
                </td>
                <td>
                    <a target="_blank" href="/product/{{ $cart->product_id }}"><h5>{{ $cart->product->title }}</h5></a>
                    @if($cart->product->on_sale)
                        <input type="number" min="1" class="form-control text-center amount" 
                        name="amount[{{ $cart->product_id }}]" value="{{ $cart->amount }}" data-cartid="{{ $cart->id }}">
                    @else
                        <div class="warning">該商品已下架</div>
                    @endif
                </td>
                <td class="text-right">
                    <span id="price-{{ $cart->id }}">
                    {{ $cart->product->price }}
                    </span>
                </td>
                {{-- <td class="text-center">{{ $cart->amount }}</td> --}}
                <td class="text-right">
                    <span class="sum" id="sum-{{ $cart->id }}">{{ $cart->product->price * $cart->amount }}</span>
                </td>
                <td nowrap><a href="#" data-id="{{ $cart->product_id }}" class="btn btn-danger btn-sm btn-del-cart-item">移除</a></td>
            </tr>
        @empty

        <tr>
            <td><h3>購物車是空的(´⊙ω⊙`)還不快去買東西！</h3></td>
        </tr>
    @endforelse
    </table>
@endsection

@section('scriptsAfterJs')
    @include('product.add_cart')
@endsection