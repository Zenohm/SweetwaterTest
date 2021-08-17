<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Support\Str;

class OrderController extends Controller
{
    public function index() {
        $orders = Order::all();

        $candy = $orders->filter($this->lowercaseCommentsContain("candy"));
        $call = $orders->filter($this->lowercaseCommentsContain(["call me", "contact me", "contact the customer", "do not call", "please call", "no phone call", "no calls"]));
        $signature = $orders->filter($this->lowercaseCommentsContain(["signature", " sign ", "FedEx", "drop off", "deliver", "leave"]));
        $referral = $orders->filter($this->lowercaseCommentsContain([" refer", "heard about"]));

        $misc = $orders
            ->whereNotIn('orderid', $candy->map->orderid)
            ->whereNotIn('orderid', $call->map->orderid)
            ->whereNotIn('orderid', $signature->map->orderid)
            ->whereNotIn('orderid', $referral->map->orderid)
            ->all()
        ;

        return view('orders')->with('orders', [
            "All" => $orders,
            "Candy" => $candy,
            "Call" => $call,
            "Signature" => $signature,
            "Referral" => $referral,
            "Misc" => $misc
        ]);
    }

    private function lowercaseCommentsContain($needles): \Closure
    {
        return function ($order) use ($needles) {
            return Str::contains(Str::lower($order->comments), $needles);
        };
    }
}
