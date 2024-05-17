<?php

namespace App\Http\Controllers;

use App\Product;
use App\Category;
use Illuminate\Http\Request;

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
        // dd($products);
        return view('product.index', compact('products', 'categoryName'));
    }

    public function search(Request $request)
    {

        $query = $request->input('query');

        $products = Product::where('name','LIKE',"%$query%")->paginate(8);

        return view('product.catalog',compact('products'));
    }

    public function sortASC(Request $request) {

        $query = $request->input('query');

        $products = Product::orderBy('price', 'ASC')->paginate(8);

        // return view('product.catalog',compact('products'));
        return view('product.index',compact('products'));

    }

    public function sortDESC(Request $request) {

        $query = $request->input('query');

        $products = Product::orderBy('price', 'DESC')->paginate(8);

        return view('product.index',compact('products'));
        // return view('product.catalog',compact('products'));
    }

    public function sortNewest(Request $request) {

        $query = $request->input('query');

        $products = Product::orderBy('updated_at', 'DESC')->paginate(8);
        
        return view('product.index',compact('products'));
        // return view('product.catalog',compact('products'));
    }
    
    public function show(Product $product)
    {
        return view('product.show', compact('product'));
    }


}
