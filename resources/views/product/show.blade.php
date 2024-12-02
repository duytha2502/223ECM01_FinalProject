@extends('layouts.front')


@section('content')
<div class="product-details ptb-100 pb-90">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-lg-7 col-12">
                <div class="product-details-5 pr-70">
                    <img src="{{ url('storage/'.$product->cover_img) }}" alt="">
                    <img src="{{$product->cover_img}}" alt="">
                </div>
            </div>
            <div class="col-md-12 col-lg-5 col-12">
                <div class="product-details-content">
                    <h3>{{$product->name}}</h3>
                    <div class="rating-number">
                        <div class="quick-view-rating">
                            {{-- {{ dd($ratings) }} --}}
                            @for ($i = 0; $i < $ratings; $i++)
                                <i class="pe-7s-star"></i>
                            @endfor
                        </div>
                        <div class="quick-view-number">
                            <span>{{ count($review) }} Reviews </span>
                        </div>
                    </div>
                    <div class="mb-2">
                        <span>{{ $product->current_buyer_quantity }}/{{ $product->buyer_quantity }} Pre-Ordered</span>
                    </div>
                    <div class="details-price">
                        <span>${{$product->final_price}}</span>
                    </div>
                    <p>{!! $product->description !!}</p>

                    <div class="quickview-plus-minus">

                        <div class="quickview-btn-cart">
                            @if(is_null($order->first()))
                                @if($product->begin_date > date('Y-m-d'))
                                <a style="background-color:rgb(144, 143, 143); color:white">This product will open pre-order
                                    soon</a>

                                @elseif($product->expire_date == date('Y-m-d'))
                                <a style="background-color:rgb(144, 143, 143); color:white">Pre-order expired!!!</a>

                                @elseif($product->current_buyer_quantity == $product->buyer_quantity)
                                <a style="background-color:rgb(144, 143, 143); color:white">Sufficient number of
                                    pre-ordered</a>

                                @else
                                <a class="btn-hover-black" href="{{route('cart.add', $product)}}">add to cart</a>

                                @endif
                            @else
                                @foreach($order as $orderItem)
                                    @if(count($order) > 1)
                                        @if($orderItem->product_id == $product->id)
                                            <a style="background-color:rgb(144, 143, 143); color:white">Just pre-ordered</a>
                                            @break
                                        @elseif($product->begin_date > date('Y-m-d'))
                                            <a style="background-color:rgb(144, 143, 143); color:white">This product will open pre-order
                                                soon</a>
                                            @break
                                        @elseif($product->expire_date == date('Y-m-d'))
                                            <a style="background-color:rgb(144, 143, 143); color:white">Pre-order expired!!!</a>
                                            @break
                                        @elseif($product->buyer_quantity == $product->current_buyer_quantity)
                                            <a style="background-color:rgb(144, 143, 143); color:white">Sufficient number of
                                                pre-ordered</a>
                                            @break
                                        @endif
                                    @else
                                        @if($orderItem->product_id == $product->id)
                                            <a style="background-color:rgb(144, 143, 143); color:white">Just pre-ordered</a>
                                            @break
                                        @elseif($product->begin_date > date('Y-m-d'))
                                            <a style="background-color:rgb(144, 143, 143); color:white">This product will open pre-order
                                                soon</a>
                                            @break
                                        @elseif($product->expire_date == date('Y-m-d'))
                                            <a style="background-color:rgb(144, 143, 143); color:white">Pre-order expired!!!</a>
                                            @break
                                        @elseif($product->buyer_quantity == $product->current_buyer_quantity)
                                            <a style="background-color:rgb(144, 143, 143); color:white">Sufficient number of
                                                pre-ordered</a>
                                            @break
                                        @else
                                            <a class="btn-hover-black" href="{{route('cart.add', $product)}}">add to cart</a>
                                            @break
                                        @endif
                                    @endif
                                @endforeach
                            @endif
                        </div>
                    </div>
                    <div class="product-details-cati-tag mt-35">
                        <ul>
                            <li class="categories-title">Categories :</li>
                            <li><a href="#">fashion</a></li>
                            <li><a href="#">electronics</a></li>
                            <li><a href="#">toys</a></li>
                            <li><a href="#">food</a></li>
                            <li><a href="#">jewellery</a></li>
                        </ul>
                    </div>
                    <div class="product-details-cati-tag mtb-10">
                        <ul>
                            <li class="categories-title">Tags :</li>
                            <li><a href="#">fashion</a></li>
                            <li><a href="#">electronics</a></li>
                            <li><a href="#">toys</a></li>
                            <li><a href="#">food</a></li>
                            <li><a href="#">jewellery</a></li>
                        </ul>
                    </div>
                    <div class="product-share">
                        <ul>
                            <li class="categories-title">Share :</li>
                            <li>
                                <a href="#">
                                    <i class="icofont icofont-social-facebook"></i>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <i class="icofont icofont-social-twitter"></i>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <i class="icofont icofont-social-pinterest"></i>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <i class="icofont icofont-social-flikr"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- reviews section --}}

@include('product._reviews')

<!-- related product area start -->
{{-- @include('product._related-product') --}}

@endsection
