<?php

namespace App\Http\Controllers;

use App\Product;

use Illuminate\Http\Request;
use App\Category;
use Illuminate\Support\Facades\Artisan;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
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
        
        $products = Product::paginate(12);

        return view('home', ['allProducts' => $products,'categories'=>$categories]);
    }

    public function contact()
    {
        return view('contact');
    }
}
