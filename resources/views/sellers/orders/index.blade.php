@extends('layouts.seller')


@section('content')

    <h4>Orders</h4>

    <table class="table" width="30%">
        <thead>
            <tr>
                <th>Order number</th>
                <th>Name</th>
                <th>Phone Number</th>
                <th>Shipping Address</th>
                <th>Payment Method</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($orders as $subOrder)
                <tr>
                    <td scope="row">
                        {{$subOrder->order_id}}
                    </td>
                    <td>
                       {!! $subOrder->order->shipping_fullname !!}
                    </td>

                    <td>
                        {!! $subOrder->order->billing_phone!!}
                    </td>
                    
                    <td>
                        {!! $subOrder->order->shipping_address !!}
                        {{-- {{ $subOrder->order->user_id }} --}}
                    </td>

                    <td>
                        {{ $subOrder->order->payment_method }}
                    </td>
                    <td>

                        {{$subOrder->status}}

                        @if($subOrder->status != 'processing' & $subOrder->status != 'completed') 
                        <a href=" {{route('seller.order.delivered', $subOrder)}} " class="btn btn-primary btn-sm" style="width: fit-content">mark processing</button>
                        @endif
                    </td>
                    <td>
                        <a name="" id="" class="btn btn-primary btn-sm" href="{{route('seller.orders.show', $subOrder)}}" role="button">View</a>
                    </td>
                </tr>
            @empty

            @endforelse


        </tbody>
    </table>


@endsection

