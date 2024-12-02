<?php

namespace App\Http\Controllers;

use App\Product;
use App\Category;
use App\Order;
use App\Review;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categoryId = request('category_id');
        $categoryName = null;

        if($categoryId) {
            $category = Category::find($categoryId);
            $categoryName = ucfirst($category->name);

            $products = $category->allProducts();
        }else{
            $products = Product::take(30)->get();
        }
        $products = Product::paginate(8);

        $order = Order::where('user_id', Auth::user()->id)
        ->join('order_items','orders.id', '=', 'order_items.order_id')
        ->get();
        // dd($products);
        return view('product.index', compact('products', 'categoryName','order'));
    }

    public function search(Request $request)
    {

        $query = $request->input('query');

        $products = Product::where('name','LIKE',"%$query%")->paginate(8);

        $order = Order::where('user_id', Auth::user()->id)
                ->join('order_items','orders.id', '=', 'order_items.order_id')
                ->get();
        return view('product.catalog',compact('products', 'order'));
    }

    public function sortASC(Request $request) {

        $query = $request->input('query');

        $products = Product::orderBy('final_price', 'ASC')->paginate(8);

        $order = Order::where('user_id', Auth::user()->id)
                ->join('order_items','orders.id', '=', 'order_items.order_id')
                ->get();

        // return view('product.catalog',compact('products'));
        return view('product.index',compact('products', 'order'));

    }

    public function sortDESC(Request $request) {

        $query = $request->input('query');

        $products = Product::orderBy('final_price', 'DESC')->paginate(8);

        $order = Order::where('user_id', Auth::user()->id)
                ->join('order_items','orders.id', '=', 'order_items.order_id')
                ->get();

        return view('product.index',compact('products', 'order'));
        // return view('product.catalog',compact('products'));
    }

    public function sortNewest(Request $request) {

        $query = $request->input('query');

        $products = Product::orderBy('updated_at', 'DESC')->paginate(8);

        $order = Order::where('user_id', Auth::user()->id)
                ->join('order_items','orders.id', '=', 'order_items.order_id')
                ->get();

        return view('product.index',compact('products', 'order'));
        // return view('product.catalog',compact('products'));
    }

    public function show(Product $product, Review $review)
    {
        // $user = DB::table('users')->get();
        // $review = Review::where('booking_id', '=', $product->id)
        // ->get();
        $order = Order::where('user_id', Auth::user()->id)
                ->join('order_items','orders.id', '=', 'order_items.order_id')
                ->get();

        $review = DB::table('review')
        ->where('booking_id', '=', $product->id)
        ->join('users', 'review.user_id', '=', 'users.id')
        ->get();
        // dd($order);

        $ratings = DB::table('review')->where('booking_id', '=', $product->id)->avg('star_rating');
        // dd($ratings);
        return view('product.show', compact('product', 'review', 'order', 'ratings'));
    }

    public function store(Request $request){
        $review = new Review();
        $review->comments= $request->comment;
        $review->booking_id = $request->booking_id;
        $review->star_rating = $request->rating;
        $review->user_id = Auth::user()->id;
        $review->save();
        return redirect()->back()->with('flash_msg_success','Your review has been submitted Successfully,');
    }
}
