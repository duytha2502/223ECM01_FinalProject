<?php

namespace App\Http\Controllers;

use App\Jobs\MonitorOrder;
use App\Order;
use App\Product;
use Illuminate\Http\Request;

class OrderController extends Controller
{

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'shipping_fullname' => 'required',
            'shipping_state' => 'required',
            'shipping_city' => 'required',
            'shipping_address' => 'required',
            'shipping_phone' => 'required',
            'shipping_zipcode' => 'required',
            'payment_method' => 'required',
        ]);

        $order = new Order();

        $order->order_number = uniqid('PreOrderNumber-');

        $order->shipping_fullname = $request->input('shipping_fullname');
        $order->shipping_state = $request->input('shipping_state');
        $order->shipping_city = $request->input('shipping_city');
        $order->shipping_address = $request->input('shipping_address');
        $order->shipping_phone = $request->input('shipping_phone');
        $order->shipping_zipcode = $request->input('shipping_zipcode');
        $order->payment_option = $request->input('payment_option');

        if(!$request->has('billing_fullname')) {
            $order->billing_fullname = $request->input('shipping_fullname');
            $order->billing_state = $request->input('shipping_state');
            $order->billing_city = $request->input('shipping_city');
            $order->billing_address = $request->input('shipping_address');
            $order->billing_phone = $request->input('shipping_phone');
            $order->billing_zipcode = $request->input('shipping_zipcode');
            $order->payment_option = $request->input('payment_option');
        }else {
            $order->billing_fullname = $request->input('billing_fullname');
            $order->billing_state = $request->input('billing_state');
            $order->billing_city = $request->input('billing_city');
            $order->billing_address = $request->input('billing_address');
            $order->billing_phone = $request->input('billing_phone');
            $order->billing_zipcode = $request->input('billing_zipcode');
            $order->payment_option = $request->input('payment_option');
        }

        $cartItems = \Cart::session(auth()->id())->getContent();

        $order->item_count = \Cart::session(auth()->id())->getContent()->count();
;
        $order->user_id = auth()->id();
        if (request('payment_method') == 'paypal') {
            $order->payment_method = 'paypal';
        }

        $order->save();

        foreach($cartItems as $item) {
            $order->items()->attach($item->id, ['final_price'=> $item->final_price, 'quantity'=> $item->quantity]);
            $order->grand_total = $item['associatedModel']['final_price'] * $item['quantity'] /2;
            $product = Product::find($item->id);
            $product->current_buyer_quantity = $product->current_buyer_quantity + 1;
            $product->update();
            $order->update();
        }
        $order->generateSubOrders();

        if (request('payment_method') == 'paypal') {

            MonitorOrder::dispatch($order)->delay(now()->addMinutes(1));

            return redirect()->route('paypal.checkout', $order->id);

        }
        dd($order->grand_total);

        \Cart::session(auth()->id())->clear();

        return redirect()->route('home')->withMessage('Order has been placed');

    }
}
