@component('mail::message')
# Invoice Paid

Thanks for the purchase

Here is your receipt

<table class="table">
    <thead>
        <tr>
            <th width="5%">Product name</th>
            <th width="5%">quantity</th>
        </tr>
    </thead>
    <tbody>
        @foreach($order->items as $item)
        <tr>
            <td width="5%" scope="row">{{ $item->name }}</td>
            <td width="5%">{{ $item->pivot->quantity }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

Total : {{$order->grand_total}}


Thanks,<br>
{{ config('app.name') }}
@endcomponent
