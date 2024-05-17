@extends('layouts.seller')


@section('content')
<h3>Order Summary</h3>
<hr>
<table class="table-responsive">
    <table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>Name</th>
            <th>Image</th>
            <th>Quantity</th>
            <th>Price</th>
            <th>Total</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($items as $item)
        <tr>
            <td scope="row" width="10%">
                {{$item->name}}
            </td>
            <td width="30%">
                <img style="width: 30% ;margin-left: 15%" src="{{  url('storage/'.$item->cover_img) }}" >
            </td>
            <td width="10%">
                {{$item->pivot->quantity}}
            </td>
            <td width="10%">
                {{$item->pivot->price}}
            </td>
            <td width="10%" style="font-weight:bold">${{ $item->pivot->quantity * $item->pivot->price}}</td>
        </tr>
        @endforeach
        <tr>
            <td colspan="4" style="font-weight:bold">Coupon</td>
            <td colspan="1" style="font-weight:bold"></td>
        </tr>
        <tr>
            <td colspan="4" style="font-weight:bold">Total Amount</td>
            <td colspan="1" style="font-weight:bold">${{ $item->pivot->quantity * $item->pivot->price }}</td>
        </tr>
    </tbody>
    </table>
</table>

@endsection
