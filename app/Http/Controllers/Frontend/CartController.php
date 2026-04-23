<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Cart;
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

        // Group the collection by dokan_id (or by dokan object)
        $groupedCart = $cartItems->groupBy(function ($item) {
            return $item->dokan->id; // group by dokan ID
        });

        // Optionally, transform to include dokan object and items
        $groups = [];
        foreach ($groupedCart as $dokanId => $items) {
            $groups[] = [
                'dokan' => $items->first()->dokan,
                'items' => $items,
                'subtotal' => $items->sum('amount')
            ];
        }

        return view('frontend.cart', compact('groups'));
    }



    public function store(Request $request)
    {
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
            $cartItem->amount = ($unitPrice) * $cartItem->qty;
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




    public function checkoutDokan(Request $request, $dokanId)
{
    $userId = Auth::id();

    // Fetch cart items for this user and dokan
    $cartItems = Cart::where('user_id', $userId)
        ->where('dokan_id', $dokanId)
        ->with('product')
        ->get();

    if ($cartItems->isEmpty()) {
        return back()->with('error', 'No items to checkout.');
    }

    // Create order, clear cart items for this dokan, etc.
    // ...

    return redirect()->route('cart.index', $order)->with('success', 'Order placed successfully!');
}





    /**
     * Update cart item quantity
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1'
        ]);

        $cartItem = Cart::where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        $product = $cartItem->product;
        $unitPrice = $product->price - $product->discount;
        $newAmount = $unitPrice * $request->qty;

        $cartItem->qty = $request->qty;
        $cartItem->amount = $newAmount;
        $cartItem->save();

        return redirect()->route('cart.index')->with('success', 'Cart updated successfully.');
    }

    /**
     * Remove a single product from cart
     */
    public function delete($id)
    {
        $cartItem = Cart::where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();
        $cartItem->delete();

        return redirect()->route('cart.index')->with('success', 'Item removed from cart.');
    }

    /**
     * Clear entire cart for the authenticated user
     */
    public function clear_cart()
    {
        Cart::where('user_id', Auth::id())->delete();

        return redirect()->route('cart.index')->with('success', 'Cart cleared successfully.');
    }
}
