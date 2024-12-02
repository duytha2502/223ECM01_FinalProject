{{-- <div class="product-description-review-area pb-90">
    <div class="container">
        <div class="product-description-review text-center">
            <div class="description-review-title nav" role=tablist>
                <a class="active" href="#pro-dec" data-toggle="tab" role="tab" aria-selected="true">
                    Description
                </a>
                <a href="#pro-review" data-toggle="tab" role="tab" aria-selected="false">
                    Reviews (0)
                </a>
            </div>
            <div class="description-review-text tab-content">
                <div class="tab-pane active show fade" id="pro-dec" role="tabpanel">
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut
                        labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco
                        laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in</p>
                </div>
                <div class="tab-pane fade" id="pro-review" role="tabpanel">
                    <a href="#">Be the first to write your review!</a>
                </div>
            </div>
        </div>
    </div>
</div> --}}
<style>
    .rate {
        float: left;
        height: 46px;
        padding: 0 10px;
    }

    .rate:not(:checked) > input {
        position: absolute;
        display: none;
    }

    .rate:not(:checked) > label {
        float: right;
        width: 1em;
        overflow: hidden;
        white-space: nowrap;
        cursor: pointer;
        font-size: 30px;
        color: #ccc;
    }

    .rate:not(:checked) > label:before {
        content: '★ ';
    }

    .rate>input:checked ~ label {
        color: #ffc700;
    }

    .rate:not(:checked) > label:hover,
    .rate:not(:checked) > label:hover ~ label {
        color: #deb217;
}

    .rate > input:checked + label:hover,
    .rate > input:checked + label:hover ~ label,
    .rate > input:checked ~ label:hover,
    .rate > input:checked ~ label:hover ~ label,
    .rate > label:hover ~ input:checked ~ label {
        color: #c59b08;
}

    /* .star-rating-complete {
        color: #c59b08;
    }

    .rating-container .form-control:hover,
    .rating-container .form-control:focus {
        background: #fff;
        border: 1px solid #ced4da;
    }

    .rating-container textarea:focus,
    .rating-container input:focus {
        color: #000;
    } */

    .rated {
        float: left;
        height: 46px;
        padding: 0 10px;
    }

    .rated:not(:checked)>input {
        position: absolute;
        display: none;
    }

    .rated:not(:checked)>label {
        float: right;
        width: 1em;
        overflow: hidden;
        white-space: nowrap;
        cursor: pointer;
        font-size: 30px;
        color: #ffc700;
    }

    .rated:not(:checked)>label:before {
        content: '★ ';
    }

    .rated>input:checked~label {
        color: #ffc700;
    }

    .rated:not(:checked)>label:hover,
    .rated:not(:checked)>label:hover~label {
        color: #deb217;
    }

    .rated>input:checked+label:hover,
    .rated>input:checked+label:hover~label,
    .rated>input:checked~label:hover,
    .rated>input:checked~label:hover~label,
    .rated>label:hover~input:checked~label {
        color: #c59b08;
    }
</style>

@if($review == null)
    <h1>No comments</h1>
@else
<div class="d-flex justify-content-center align-item-center">
    <h2 class="font-weight-bold ">Review</h2>
</div>

@foreach($review as $item)
<div class="container">
    <div class="row">
        <div class="col mt-2">
            <div class="form-group row">
                <div class="d-flex justify-content-start align-item-start">
                    <img width="8%" src="{{ $item->avatar }}" alt="">
                    <div class="d-flex justify-content-center align-item-center flex-column">
                        <p class="mb-0 mt-2 mr-2 ml-2" style="font-weight: 700">{{ $item->name }}</p>
                        <p class="mb-0 mt-2 mr-2 ml-2">{{ $item->created_at }}</p>
                    </div>
                    <div class="rated">
                        @for($i=1; $i<=$item->star_rating; $i++)
                            <input type="radio" id="star{{$i}}" class="rate" name="rating" value="5" />
                            <label class="star-rating-complete" title="text">{{$i}} stars</label>
                        @endfor
                    </div>
                </div>
            </div>
            <div class="form-group row mt-4">
                <div class="col">
                    <p>{{ $item->comments }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endforeach
@endif

<div class="container">
    <div class="row">
        <div class="col mt-4">
            <form class="py-2 px-4" action="{{route('products.store')}}" style="box-shadow: 0 0 10px 0 #ddd;"
                method="POST" autocomplete="off">
                @csrf
                <p class="font-weight-bold ">Leave your review</p>
                <div class="form-group row">
                    <input type="hidden" name="booking_id" value="{{ $product->id }}">
                    <div class="col">
                        <div class="rate">
                            <input type="radio" id="star5" name="rating" value="5" />
                            <label for="star5" title="text">5 stars</label>
                            <input type="radio" id="star4" name="rating" value="4" />
                            <label for="star4" title="text">4 stars</label>
                            <input type="radio" id="star3" name="rating" value="3" />
                            <label for="star3" title="text">3 stars</label>
                            <input type="radio" id="star2" name="rating" value="2" />
                            <label for="star2" title="text">2 stars</label>
                            <input type="radio" id="star1" name="rating" value="1" />
                            <label for="star1" title="text">1 star</label>
                          </div>
                    </div>
                </div>
                <div class="form-group row mt-4">
                    <div class="col">
                        <textarea class="form-control" name="comment" rows="6 " placeholder="Comment"
                            maxlength="200"></textarea>
                    </div>
                </div>
                <div class="mt-3 text-right">
                    <button class="btn btn-sm btn-info">Comment
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
