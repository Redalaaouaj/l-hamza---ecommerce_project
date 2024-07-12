<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function addToCart(Request $request, $productId)
    {
        $product = Product::findOrFail($productId);
        $userId = auth()->id();

        $cartItem = Cart::firstOrNew([
            'user_id' => $userId,
            'product_id' => $productId,
        ]);

        $cartItem->quantity += 1;
        $cartItem->save();

        return redirect()->back()->with('success', 'Product added to cart!');
    }

    public function showCart()
    {
        $cartItems = Cart::with('product.images')->where('user_id', auth()->id())->get();
        return view('cart.index', compact('cartItems'));
    }

    public function updateQuantity(Request $request)
    {
        $cartItem = Cart::where('user_id', auth()->id())
            ->where('id', $request->id)
            ->first();

        if ($cartItem) {
            $cartItem->quantity += $request->quantity;
            if ($cartItem->quantity < 1) {
                $cartItem->quantity = 1;
            }
            $cartItem->save();

            $cartItems = Cart::with('product')->where('user_id', auth()->id())->get();
            $subtotal = $cartItems->sum(function ($cartItem) {
                return $cartItem->product->price * $cartItem->quantity;
            });

            return response()->json([
                'quantity' => $cartItem->quantity,
                'subtotal' => $subtotal,
                'total' => $subtotal + 30,
            ]);
        }

        return response()->json(['error' => 'CartItem not found'], 404);
    }

    public function deleteItem(Request $request)
    {
        $cartItem = Cart::where('user_id', auth()->id())
            ->where('id', $request->id)
            ->first();

        if ($cartItem) {
            $cartItem->delete();

            $cartItems = Cart::with('product')->where('user_id', auth()->id())->get();
            $subtotal = $cartItems->sum(function ($cartItem) {
                return $cartItem->product->price * $cartItem->quantity;
            });

            return response()->json([
                'success' => true,
                'subtotal' => $subtotal,
                'total' => $subtotal + 30,
            ]);
        }

        return response()->json(['error' => 'CartItem not found'], 404);
    }

    public function getItemCount()
    {
        $itemCount = Cart::where('user_id', auth()->id())->count();
        return response()->json(['count' => $itemCount]);
    }
}
