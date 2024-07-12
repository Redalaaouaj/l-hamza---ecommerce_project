<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class StoreController extends Controller
{
    public function index(Request $request)
    {

        $productsQuery = Product::query()->with('category');
        $title = $request->input('title');
        $max = $request->input('max');
        $min = $request->input('min') ?? 0;
        $cats = $request->input('categories');
        $categories = Category::with('products')->has('products')->get();

        if($request->has('title')) {
            $productsQuery->where('title','like',"%{$title}%");
        };
        if($request->filled('categories')) {
            $productsQuery->whereIn('category_id',$cats);
        };
        if($request->filled('max')) {
            $productsQuery->where('price','<=',$max);
        };
        $productsQuery->where('price','>=',$min);
        
        $price = Product::pluck('price')->all();
        $prices = [
            'minPrice' => min($price),
            'maxPrice' => max($price),
        ];

        $products = $productsQuery->paginate(11);
        return view('store.index',compact('products','categories','prices'));
    }
    public function cart()
    {
        return view('cart.index');
    }

}
