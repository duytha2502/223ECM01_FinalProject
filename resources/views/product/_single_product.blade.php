<div class="custom-col-style-2 custom-col-4">
    <div class="product-wrapper product-border mb-24">
        <div class="product-img-3">
            <a href="{{route('products.show', $product)}}">
                @if(!empty($product->cover_img))
                    <img src="{{ url('storage/'.$product->cover_img) }}" alt="">
                    <img src="{{ $product->cover_img }}" alt="">
                @else
                <img src="https://i.pinimg.com/originals/ae/8a/c2/ae8ac2fa217d23aadcc913989fcc34a2.png" alt="">
                @endif
            </a>
            <div class="product-action-right">
                <a class="animate-right" href="{{route('products.show', $product)}}" title="View">
                    <i class="pe-7s-look"></i>
                </a>
                <a class="animate-top" title="Add To Cart" href="{{route('cart.add', $product->id)}}">
                    <i class="pe-7s-cart"></i>
                </a>
                <a class="animate-left" title="Wishlist" href="#">
                    <i class="pe-7s-like"></i>
                </a>
            </div>
        </div>
        <div class="product-content-4 text-center">
            <div class="product-rating-4">
                <i class="icofont icofont-star yellow"></i>
                <i class="icofont icofont-star yellow"></i>
                <i class="icofont icofont-star yellow"></i>
                <i class="icofont icofont-star yellow"></i>
                <i class="icofont icofont-star"></i>
            </div>
            <h4><a href="{{route('products.show', $product)}}">{{$product->name}}</a></h4>
            <div>{{$product->description}}</div>
            <h5>$ {{$product->price}}</h5>
        <p>{{$product->shop->owner->name ?? 'n/a'}}</p>
        </div>
    </div>
</div>
