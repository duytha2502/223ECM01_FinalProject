<?php

namespace App\Http\Controllers;

use App\Coupon;
use App\Order;
use App\SubOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;


class CustomerOrderController extends Controller
{
    public function index()
    {

        $orders = Order::where('user_id', Auth::user()->id)->orderBy('created_at', 'desc')->paginate(10);

        // dd($items);
        return view('customers.orders.index', compact('orders'));

    }

    public function show($orderId)
    {
        $order = Order::where('user_id', Auth::user()->id)->where('id', $orderId)->first();
        // dd($order);
        if($order) {
            return view('customers.orders.show', compact('order'));
        }else {
            return redirect()->back()->with('message', 'No order found');
        }
    }

    // public function destroy($orderId)
    // {

    //    \Order::session(auth()->id())->remove($orderId);
    //     dd($orderId);
    //    return redirect()->back()->with('message', 'No order found');
    // }
    public function markCompleted(SubOrder $suborder)
    {
        $suborder->status = 'completed';
        $suborder->save();

        //check if all suborders complete
        $pendingSubOrders = $suborder->order->subOrders()->where('status','!=', 'completed')->count();

        if($pendingSubOrders == 0) {
            $suborder->order()->update(['status'=>'completed']);
        }

        return redirect('/customers/orders/index')->withMessage('Order marked completed');
    }
}
