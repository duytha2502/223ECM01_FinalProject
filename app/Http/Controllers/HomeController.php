<?php

namespace App\Http\Controllers;

use App\Product;

use Illuminate\Http\Request;
use App\Category;
use App\Order;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        $products = Product::with('shop.owner')->take(30)->get();

        $categories = Category::with('children.children')->whereNull('parent_id')->get();

        $products = Product::orderBy('created_at', 'DESC')->paginate(12);

        $order = Order::where('user_id', Auth::user()->id)
                ->join('order_items','orders.id', '=', 'order_items.order_id')
                ->get();
        // dd(($order));
        return view('home', ['allProducts' => $products,'categories'=>$categories], compact('order'));
    }

    public function contact()
    {
        return view('profile', ['user' => Auth::user()]);
    }

    public function updateContact(Request $request)
    {
        // Get current user
        $userId = Auth::id();
        $user = User::findOrFail($userId);

        // Validate the data submitted by user
        $validator = Validator::make($request->all(), [
            'name' => 'max:255',
            'email' => 'email|max:225|'. Rule::unique('users')->ignore($user->id),
        ]);

        // if fails redirects back with errors
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Fill user model
        $user->fill([
            'name' => $request->name,
            'email' => $request->email
        ]);

        // Save user to database
        $user->save();

        return back()->withMessage('Information changed successfully!');
    }

}
