@extends('layouts.app')
@section('content')

    <h1>商品一覽</h1>
    <div class="card-deck">
        {{-- 使用@forelse先判斷內容是否有值，若無則從＠empty往下執行 --}}
        @forelse($products as $product)
            <div class="card mb-4 product_item">
                <!-- 點擊連結或圖片進入商品詳情 -->
                <a href="product/{{ $product->id }}">
                <img src="{{ $product->image_url }}" class="card-img-top" alt="{{ $product->title }}">
                </a>

                <div class="card-body">
                    <!-- 點擊連結或圖片進入商品詳情 -->
                    <h5>
                        <a href="product/{{ $product->id }}">{{ $product->title }}</a>
                    </h5>
                </div>
                <div class="card-footer text-center">
                    <span id="price">${{ $product->price }}</span><br>
                    <a data-id="{{ $product->id }}" class="btn btn-primary btn_add_cart">加入購物車</a>
                    <input type="hidden" name="amount" value="1" >
                </div>
            </div>
            {{-- 根據windows-size新增一個用來換行的隱藏div --}}
            @if($loop->iteration % 2 == 0)
                <div class="w-100 d-none d-sm-block d-md-none"><!-- wrap every 2 on sm--></div>
            @endif
            @if($loop->iteration % 3 == 0)
                <div class="w-100 d-none d-md-block d-lg-none"><!-- wrap every 3 on md--></div>
            @endif
            @if($loop->iteration % 4 == 0)
                <div class="w-100 d-none d-lg-block d-xl-none"><!-- wrap every 4 on lg--></div>
            @endif
            @if($loop->iteration % 5 == 0)
                <div class="w-100 d-none d-xl-block"><!-- wrap every 5 on xl--></div>
            @endif
        @empty
            <div class="card mb-4">
                <div class="card-body">
                    <h1 class="card-title">目前無任何商品</h1>
                </div>
            </div>
        @endforelse
        </div>

@endsection

@section('my_menu')
    <li class="nav-item">
        <a class="nav-link" href="/admin">回控制台</a>
    </li>
    @parent
@stop


@section('scriptsAfterJs')
    @include('product.add_cart')
@endsection


