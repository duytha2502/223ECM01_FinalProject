<?php

namespace App\Http\Controllers\Seller;

use App\Order;
use App\Product;
use App\SubOrder;
use App\OrderItem;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    public function index()
    {

        $orders = SubOrder::where('seller_id', auth()->id())->get();
        // dd($orders);
        return view('sellers.orders.index', compact('orders'));

    }

    public function show(SubOrder $order)
    {
        $items = $order->items;

        return view('sellers.orders.show', compact('items'));
    }

    public function markDelivered(SubOrder $suborder)
    {
        $suborder->status = 'processing';
        $suborder->save();

        //check if all suborders complete
        $pendingSubOrders = $suborder->order->subOrders()->where('status','!=', 'processing')->count();

        if($pendingSubOrders == 0) {
            $suborder->order()->update(['status'=>'processing']);
        }

        return redirect('/seller/orders')->withMessage('Order marked processing');
    }
}
