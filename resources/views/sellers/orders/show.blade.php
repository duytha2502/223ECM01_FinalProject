@extends('layouts.seller')


@section('content')
<h3>Pre-order Summary</h3>
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
        {{-- {{ dd($items) }} --}}
        @foreach ($items as $item)
        <tr>
            <td scope="row" width="10%">
                {{$item->name}}
            </td>
            <td width="10%">
                @if(!is_null(URL::asset('storage/'.$item->cover_img)))
                    <img style="width: 50%" src="{{ URL::asset('storage/'.$item->cover_img) }}" >
                @else
                    <img style="width: 50%" src="{{ $item->cover_img }}" >
                @endif
            </td>
            <td width="10%">
                {{$item->pivot->quantity}}
            </td>
            <td width="10%">
                {{$item->final_price}}
            </td>
            <td width="10%" style="font-weight:bold">$ {{ $item->pivot->quantity * $item->final_price}}</td>
        </tr>
        @endforeach
        <tr>
            <td colspan="4" style="font-weight:bold">Buyer Paid</td>
            <td colspan="1" style="font-weight:bold">$ {{ $item->pivot->quantity * $item->pivot->final_price /2}}</td>
        </tr>
        <tr>
            <td colspan="4" style="font-weight:bold">Buyer Paid When Delivery</td>
            <td colspan="1" style="font-weight:bold">$ {{ ($item->pivot->quantity * $item->final_price) - ($item->pivot->quantity * $item->pivot->final_price /2)}}</td>
        </tr>
        <tr>
            <td colspan="4" style="font-weight:bold">Total Amount</td>
            <td colspan="1" style="font-weight:bold">$ {{ $item->pivot->quantity * $item->final_price }}</td>
        </tr>
    </tbody>
    </table>
</table>

@endsection
