<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index()
    {
        // Get cart items for the logged-in user, eager load product and dokan
        $cartItems = Cart::with(['product', 'dokan'])
            ->where('user_id', Auth::id())
            ->get();

        // Group the collection by dokan_id
        $groupedCart = $cartItems->groupBy('dokan_id');

        // Transform to include dokan object and calculate totals
        $groups = [];
        $totalCartItems = 0;
        $totalAmount = 0;
        $totalDiscount = 0;

        foreach ($groupedCart as $dokanId => $items) {
            $subtotal = $items->sum(function($item) {
                return $item->qty * ($item->product->price - $item->product->discount);
            });

            $originalTotal = $items->sum(function($item) {
                return $item->qty * $item->product->price;
            });

            $groupDiscount = $originalTotal - $subtotal;
            $totalCartItems += $items->count();
            $totalAmount += $subtotal;
            $totalDiscount += $groupDiscount;

            $groups[] = [
                'dokan' => $items->first()->dokan,
                'items' => $items,
                'subtotal' => $subtotal,
                'discount' => $groupDiscount,
                'delivery_fee' => $subtotal >= 499 ? 0 : 50,
                'total' => $subtotal >= 499 ? $subtotal : $subtotal + 50
            ];
        }

        // Get recommended products (example query - adjust based on your needs)
        $recommendedProducts = Product::whereNotIn('id', $cartItems->pluck('product_id'))
            ->inRandomOrder()
            ->take(4)
            ->get();

        return view('frontend.cart', [
            'groups' => $groups,
            'cartCount' => $totalCartItems,
            'totalAmount' => $totalAmount,
            'totalDiscount' => $totalDiscount,
            'recommendedProducts' => $recommendedProducts
        ]);
    }

    public function store(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Please login to add items to cart.');
        }

        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1'
        ]);

        $product = Product::findOrFail($request->product_id);
        $userId = Auth::id();
        $dokanId = $product->dokan_id;

        // Calculate amount: (price - discount) * quantity
        $unitPrice = $product->price - $product->discount;
        $amount = $unitPrice * $request->quantity;

        // Check if product already in cart for this user
        $cartItem = Cart::where('user_id', $userId)
            ->where('product_id', $product->id)
            ->first();

        if ($cartItem) {
            // Update quantity and amount
            $cartItem->qty += $request->quantity;
            $cartItem->amount = $unitPrice * $cartItem->qty;
            $cartItem->save();
        } else {
            // Create new cart entry
            Cart::create([
                'product_id' => $product->id,
                'user_id' => $userId,
                'dokan_id' => $dokanId,
                'qty' => $request->quantity,
                'amount' => $amount,
            ]);
        }

        return redirect()->route('cart.index')->with('success', 'Product added to cart!');
    }

    public function remove(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id'
        ]);

        $userId = Auth::id();

        Cart::where('user_id', $userId)
            ->where('product_id', $request->product_id)
            ->delete();

        return redirect()->route('cart.index')->with('success', 'Item removed from cart!');
    }

    public function update(Request $request, $productId)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1'
        ]);

        $cartItem = Cart::where('product_id', $productId)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        $product = $cartItem->product;
        $unitPrice = $product->price - $product->discount;

        $cartItem->qty = $request->quantity;
        $cartItem->amount = $unitPrice * $request->quantity;
        $cartItem->save();

        if ($request->ajax()) {
            return response()->json(['success' => true]);
        }

        return redirect()->route('cart.index')->with('success', 'Cart updated successfully.');
    }

    public function checkoutDokan(Request $request, $dokanId)
    {
        $userId = Auth::id();

        $cartItems = Cart::where('user_id', $userId)
            ->where('dokan_id', $dokanId)
            ->with('product')
            ->get();

        if ($cartItems->isEmpty()) {
            return back()->with('error', 'No items to checkout.');
        }

        // Calculate total
        $total = $cartItems->sum(function($item) {
            return $item->qty * ($item->product->price - $item->product->discount);
        });

        // Add delivery fee if applicable
        if ($total < 499) {
            $total += 50;
        }

        $order = Order::create([
            'user_id' => $userId,
            'dokan_id' => $dokanId,
            'total' => $total,
            'status' => 'pending' // Add default status
        ]);

        // Create order items and clear cart
        foreach ($cartItems as $item) {
            // You might want to create an OrderItem model here
            // OrderItem::create([...]);
        }

        Cart::where('user_id', $userId)
            ->where('dokan_id', $dokanId)
            ->delete();

        return redirect()->route('cart.index')->with('success', 'Order placed successfully!');
    }
}
