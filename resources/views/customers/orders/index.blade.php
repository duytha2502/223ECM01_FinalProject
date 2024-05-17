@extends('layouts.seller')


@section('content')

    <h4>Your Orders</h4>

    <table class="table">
        <thead>
            <tr>
                <th>Order number</th>
                <th>Status</th>
                <th>Item count</th>
                <th>Totals</th>
                <th>Payment method</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($orders as $Order)
                <tr>
                    <td scope="row">
                        {{$Order->order_number}}

                    </td>
                    <td>
                        {{$Order->status}}
                        
                        @if($Order->status != 'completed' & $Order->status != 'pending')
                            <a href=" {{route('customers.orders.delivered', $Order)}} " class="btn btn-primary btn-sm" style="width: fit-content">mark completed</button>
                        @endif
                    </td>

                    <td>
                        {{$Order->item_count}}
                    </td>

                    <td>
                       {{ $Order->grand_total }}
                    </td>

                    <td>
                        {{ $Order->payment_method }}
                    </td>
                    
                    <td>
                        <a name="" id="" class="btn btn-primary btn-sm" href="{{ url('customers/orders/index/'.$Order->id) }}" role="button">View</a>
                    </td>
                    {{-- <td>
                        <a href="{{ route('customer.destroy', $Order['id']) }}">Cancel</a>
                    </td> --}}
                </tr>
            @empty
            @endforelse

        </tbody>
    </table>
    {{ $orders->links() }}

@endsection

