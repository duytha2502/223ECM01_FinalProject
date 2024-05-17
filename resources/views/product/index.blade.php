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
            @include('product._single_product')
        @endforeach
        <div class="pagination-style pagination-all-products mt-30 text-center">
            <div class="pagination-block">
                {{$products->appends(['query'=>request('query')])->render()}}
            </div>
        </div>
    </div>


</div>

@endsection