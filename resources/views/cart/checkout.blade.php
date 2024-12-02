@extends('layouts.app')


@section('content')
<form action="{{route('orders.store')}}" method="post">
@csrf
<div class="d-flex flex-row">
    <div class="col-md-8 col-lg-8 mr-4">
        <h2>Pre-order Checkout</h2>
        <h3>Shipping Information</h3>
            <div class="form-group">
                <label for="">Full Name</label>
                <input type="text" name="shipping_fullname" id="" class="form-control">
            </div>

            <div class="form-group">
                <label for="">State</label>
                <input type="text" name="shipping_state" id="" class="form-control">
            </div>

            <div class="form-group">
                <label for="">City</label>
                <input type="text" name="shipping_city" id="" class="form-control">
            </div>

            <div class="form-group">
                <label for="">Zip</label>
                <input type="number" name="shipping_zipcode" id="" class="form-control">
            </div>

            <div class="form-group">
                <label for="">Full Address</label>
                <input type="text" name="shipping_address" id="" class="form-control">
            </div>

            <div class="form-group">
                <label for="">Mobile</label>
                <input type="text" name="shipping_phone" id="" class="form-control">
            </div>

            <h4>Payment Method</h4>

            {{-- <div class="form-check">
                <label class="form-check-label">
                    <input type="radio" checked class="form-check-input" name="payment_method" id=""
                        value="cash_on_delivery">
                    Cash on delivery

                </label>

            </div> --}}

            <div class="form-check" style="font-size: 16px">
                <label class="form-check-label">
                    <input type="radio" checked class="form-check-input" name="payment_method" id="" value="paypal">
                    Paypal
                </label>

            </div>
    </div>
    <div class="col-md-4 col-lg-4 ml-4">
        <h2>Pre-Order Information</h2>
            @foreach($cartItems as $item)
            <div class="d-flex align-items-center justify-content-center mt-4">
                <div class="col-md-4 col-lg-4 col-4">
                    <img style="width: 100%" src="{{ $item['associatedModel']['cover_img'] }}" alt="">
                    <img style="width: 100%" src="{{ url('storage/'.$item['associatedModel']['cover_img']) }}" alt="">
                </div>
                <div class="col-md-8 col-lg-8 col-8">
                    <h5 style="font-weight: 700">{{ $item->name }}</h5>
                    <p>{{ $item['associatedModel']['final_price'] }} $ x {{ $item['quantity'] }} </p>
                </div>
            </div>
            <div class="d-flex align-items-between justify-content-between">
                <div class="col-md-4 col-lg-4 col-4 mt-2">
                    <p style="font-weight: 700">Price</p>
                    <p style="font-weight: 700">Quantity</p>
                    <p style="font-weight: 700">Total</p>
                    <p style="font-weight: 700">Payment</p>
                </div>
                <div class="col-md-4 col-lg-4 col-4 mt-2">
                    <p style="font-weight: 700">{{$item['associatedModel']['final_price']}} $</p>
                    <p style="font-weight: 700">{{$item->quantity}}</p>
                    <p style="font-weight: 700">{{$item['associatedModel']['final_price'] * $item['quantity']}} $</p>
                    <p style="font-weight: 700">{{($item['associatedModel']['final_price'] * $item['quantity'])/2}} $ (50%)</p>
                </div>
            </div>
            @endforeach

            <h4>Payment option</h4>
            <div class="form-check mt-4" style="font-size: 16px">
                <label style="font-weight: 700" class="form-check-label">
                    <input type="radio" checked class="form-check-input" name="payment_option" id=""
                        value="50%pay">
                    50% payment (50% deposit, remaining 50% will be paid upon delivery)
                </label>
            </div>
            {{-- <div class="form-check">
                <label class="form-check-label">
                    <input type="radio" class="form-check-input" name="payment_method" id="" value="paypal">
                    Paypal
                </label>
            </div> --}}
        </div>
    </div>
    <button type="submit" class="btn btn-primary mt-3">Place Order</button>
</form>

@endsection
