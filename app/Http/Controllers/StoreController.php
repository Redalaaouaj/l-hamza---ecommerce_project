<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class StoreController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if (!Auth::user()) return redirect()->route('login');

        $productsQuery = Product::query()->with('category');
        $title = $request->input('title');
        $max = $request->input('max');
        $min = $request->input('min') ?? 0;
        $cats = $request->input('categories');
        $categories = Category::with('products')->has('products')->get();

        if($request->filled('title')) {
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

        $products = $productsQuery->get();
        return view('store.index',compact('products','categories','prices'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('products.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductRequest $request)
    {
        $product = Product::create($request->only(['title', 'description', 'quantity', 'price']));

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('products', 'public');
                ProductImage::create([
                    'product_id' => $product->id,
                    'image_path' => $path,
                ]);
            }
        }

        return redirect()->route('products.index')->with('success', 'Product created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        return view('products.edit',compact('product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductRequest $request, Product $product)
    {
        $product->update($request->only(['title', 'description', 'quantity', 'price']));

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('products', 'public');
                ProductImage::create([
                    'product_id' => $product->id,
                    'image_path' => $path,
                ]);
            }
        }

        if ($request->has('delete_images')) {
            foreach ($request->delete_images as $imageId) {
                $image = ProductImage::findOrFail($imageId);
                Storage::disk('public')->delete($image->image_path);
                $image->delete();
            }
        }
        return redirect()->route('products.index')->with('success', 'Product updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('products.index')->with('success', 'Product deleted successfully.');
    }
}
