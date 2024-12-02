@extends('layouts.front')


@section('content')

<div class="container">
    <br>
    <div class="shop-selector-allproducts">
        <div class="shop-seclector-label">
            <label >Sort By: </label>
        </div>
        <div class="shop-selector-sort">
            <form action="{{ route('products.sortNewest') }}" method="GET">
                <button class="">Newest</button>
            </form>
            <form action="{{ route('products.sortASC') }}" method="GET">
                <button class="">Price: Low to High</button>
            </form>
            <form action="{{ route('products.sortDESC') }}" method="GET">
                <button class="">Price: High to Low</button>
            </form>
        </div>
    </div>

    <h2> {{ $categoryName ?? null }} All Products </h2>

    <div class="custom-row-2">
        @foreach ($products as $product)
            @if(is_null($order->first()))
                @if($product->begin_date > date('Y-m-d'))
                    @include('product._single_product_notbegin')
                @elseif($product->expire_date == date('Y-m-d'))
                    @include('product._single_product_close')
                @elseif($product->current_buyer_quantity == $product->buyer_quantity)
                    @include('product._single_product_full')
                @else
                    @include('product._single_product')
                @endif
            @else
                @foreach($order as $orderItem)
                    @if(count($order) > 1)
                        @if($orderItem->product_id == $product->id)
                            @include('product._single_product_paid')
                            @break
                        @elseif($product->begin_date > date('Y-m-d'))
                            @include('product._single_product_notbegin')
                            @break
                        @elseif($product->expire_date == date('Y-m-d'))
                            @include('product._single_product_close')
                            @break
                        @elseif($product->current_buyer_quantity == $product->buyer_quantity)
                            @include('product._single_product_full')
                            @break
                        @endif
                    @else
                        @if($orderItem->product_id == $product->id)
                            @include('product._single_product_paid')
                            @break
                        @elseif($product->begin_date > date('Y-m-d'))
                            @include('product._single_product_notbegin')
                            @break
                        @elseif($product->expire_date == date('Y-m-d'))
                            @include('product._single_product_close')
                            @break
                        @elseif($product->current_buyer_quantity == $product->buyer_quantity)
                            @include('product._single_product_full')
                            @break
                        @else
                            @include('product._single_product')
                            @break
                        @endif
                    @endif
                @endforeach
            @endif
        @endforeach
        <div class="pagination-style pagination-all-products mt-30 text-center">
            <div class="pagination-block">
                {{$products->appends(['query'=>request('query')])->render()}}
            </div>
        </div>
    </div>


</div>

@endsection
