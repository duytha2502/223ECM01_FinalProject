@extends('layouts.seller')


@section('content')

<div class="row">
    <div class="col-md-6">
        <h5>Pre-order Details</h5>
        <hr>
        <h6>Pre-order Number: {{ $order->order_number }}</h6>
        <h6>Pre-order Created Date: {{ $order->created_at->format('d-m-Y h:i A') }}</h6>
        <h6>Payment Method: {{ $order->payment_method }}</h6>
        <h6>Payment Option: {{ $order->payment_option }}</h6>
        <h6 class="border p-2 text-success" style="font-weight:bold" >
            Pre-order Status Message: <span class="text-uppercase">{{ $order->status }}</span>
        </h6>
    </div>
    <div class="col-md-6">
        <h5>User Details</h5>
        <hr>
        <h6>Full Name: {{ $order->shipping_fullname }}</h6>
        <h6>Shipping City: {{ $order->shipping_city }}</h6>
        <h6>Shipping Address: {{ $order->shipping_address }}</h6>
        <h6>Phone Number: {{ $order->shipping_phone }}</h6>
    </div>
</div>
<br>
<h5>Pre-order Items</h5>
<hr>
<div class="table-responsive">
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Image</th>
                <th>Product</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Total</th>
            </tr>
        </thead>
        @foreach ($order->orderItems as $orderItem)
        <tbody>
                <td width="5%">{{ $orderItem->id }}</td>
                <td width="10%">
                    @if(!is_null(URL::asset('storage/'.$orderItem->product->cover_img)))
                        <img style="width: 50%" src="{{ URL::asset('storage/'.$orderItem->product->cover_img) }}" >
                    @else
                        <img style="width: 50%" src="{{ $orderItem->product->cover_img }}" >
                    @endif
                </td>
                <td width="10%">{{ $orderItem->product->name }}</td>
                <td width="10%">$ {{ $orderItem->product->final_price }}</td>
                <td width="10%">{{ $orderItem->quantity }}</td>
                <td width="10%" style="font-weight:bold">$ {{ $orderItem->quantity * $orderItem->product->final_price}}</td>
            @endforeach
            <tr>
                <td colspan="5" style="font-weight:bold">Paid</td>
                <td colspan="1" style="font-weight:bold">$ {{ $order->grand_total }}</td>
            </tr>
            <tr>
                <td colspan="5" style="font-weight:bold">Payment on delivery </td>
                <td colspan="1" style="font-weight:bold">
                    $ {{ ($orderItem->quantity * $orderItem->product->final_price) - $order->grand_total}}
                </td>
            </tr>
            <tr>
                <td colspan="5" style="font-weight:bold">Total Amount</td>
                <td colspan="1" style="font-weight:bold">$ {{ $orderItem->quantity * $orderItem->product->final_price}}</td>
            </tr>
        </tbody>
    </table>
</div>


@endsection
