@extends('layouts.front')

@section('content')

<div class="pl-200 pr-200 overflow clearfix">
    <div class="categori-menu-slider-wrapper clearfix">
        <div class="categories-menu">

            <div class="category-heading">
                    <a href="{{route('products.index')}}"> All Products
                    </a>
            </div>

            @include('_category-list')

        </div>

        <div class="menu-slider-wrapper">

            <div class="menu-style-3 menu-hover text-center">
                @include('_navbar')
            </div>

            <div class="slider-area">
                @include('_slider')
            </div>

        </div>

    </div>

</div>

<div class="electronic-banner-area">
    <div class="custom-row-2">
        @include('_dummy-product')
        @include('_dummy-product')
        @include('_dummy-product')

    </div>
</div>

<div class="electro-product-wrapper wrapper-padding pt-95 pb-45">

    <div class="container-fluid">

        <div class="section-title-4 text-center mb-40">
            <h2>Top Products</h2>
        </div>

        <div class="top-product-style">

            <div>

                <div id="electro1">
                    <div class="custom-row-2">
                        {{-- @foreach($allProducts as $product)
                            @foreach($order as $orderItem)
                                @if($orderItem->product_id == $product->id)
                                    @include('product._single_product_paid')
                                    @break
                                @endif
                            @endforeach
                        @endforeach --}}

                        @foreach($allProducts as $product)
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
                                {{$allProducts->appends(['query'=>request('query')])->render()}}
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

</div>

@endsection
