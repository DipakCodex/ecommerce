<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

use function Pest\Laravel\post;

class OrderController extends Controller
{
    public function checkoutDokan(Request $request, $id)
    {
        $order = new Order();
        $order->dokan_id = $id;
        $order->total_amount = $request->total_amt;
        $order->user_id = Auth::guard('web')->user()->id;
        $order->save();



        $carts = Cart::with(['product', 'dokan'])
            ->where('user_id', Auth::id())
            ->where('dokan_id', $id)
            ->get();

        foreach ($carts as $cart) {
            $data = new OrderItem();
            $data->order_id = $order->id;
            $data->product_id = $cart->product_id;
            $data->qty = $cart->qty;
            $data->amount = $cart->amount;
            $data->save();
            $cart->delete();
        }






        $url = env('KHALTI_BASE_URL') . '/epayment/initiate/';
        $response = Http::withHeaders(
            [
                "Authorization" => "Key " . env('KHALTI_SECRET')
            ]
        )->post($url, [
            "return_url" => route('khalti.callback'),
            "website_url" => env("APP_url"),
            "amount" => $order->total_amount * 100,
            "purchase_order_id" => $order->id,
            "purchase_order_name" => "order #" . $order->id

        ]);
        return redirect($response["payment_url"]);
    }

    public function callback(Request $request)
    {
        $order = Order::find($request["purchase_order_id"]);
        $order->payment_status = $request["status"];
        $order->save();
        return redirect()->route('order.history');
    }

    public function history()
    {
        $orders = Order::where('user_id', Auth::id())->get();
        return view("frontend.order_history", compact('orders'));
    }


}
