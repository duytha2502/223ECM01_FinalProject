<?php

namespace App\Http\Controllers;

use App\Order;
use App\Mail\OrderPaid;
use App\Services\PaypalService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class PayPalController extends Controller
{
    private $paypalService;

    function __construct(PaypalService $paypalService){

        $this->paypalService = $paypalService;

    }


    public function getExpressCheckout($orderId)
    {

         $response = $this->paypalService->createOrder($orderId);

        if($response->statusCode !== 201) {
            abort(500);
        }

        $order = Order::find($orderId);
        if (isset($response->result) && is_object($response->result)) {
            $order->paypal_orderid = $response->result->id;
        } else {
            echo "Error: Expected type 'object'. Found 'array|string'";
        }
        $order->save();

        foreach ($response->result->links as $link) {
            if($link->rel == 'approve') {
                return redirect($link->href);
            }
        }

    }

    public function cancelPage()
    {
        return redirect()->route('cart.checkout');
    }


    public function getExpressCheckoutSuccess(Request $request, $orderId)
    {
        $order = Order::find($orderId);

        $response = $this->paypalService->captureOrder($order->paypal_orderid);

        if ($response->result->status == 'COMPLETED') {
            $order->is_paid = 1;
            $order->save();
            \Cart::session(auth()->id())->clear();

            Mail::to($order->user->email)->send(new OrderPaid($order));
            return redirect()->route('home')->withMessage('Payment successful!');

        }

        return redirect()->route('home')->withError('Payment UnSuccessful! Something went wrong!');


    }
}
