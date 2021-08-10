<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Support\Str;

class OrderController extends Controller
{
    public function index() {
        $orders = Order::all();

        $candy = $orders->filter($this->lowercaseCommentsContain(" candy "))->all();
        $call = $orders->filter($this->lowercaseCommentsContain(["call me", "contact me", "contact the customer", "do not call", "please call", "no phone call", "no calls"]))->all();
        $signature = $orders->filter($this->lowercaseCommentsContain(["signature", " sign ", "FedEx", "drop off", "deliver", "leave"]))->all();
        $referral = $orders->filter($this->lowercaseCommentsContain([" refer", "heard about"]))->all();

        $byOrderId = function($order) {
            return $order->orderid;
        };

        $misc = $orders
            ->filter($this->notIncludedInCollectionBy($byOrderId, $candy))
            ->filter($this->notIncludedInCollectionBy($byOrderId, $call))
            ->filter($this->notIncludedInCollectionBy($byOrderId, $signature))
            ->filter($this->notIncludedInCollectionBy($byOrderId, $referral))
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

    private function notIncludedInCollectionBy($accessor, $values): \Closure
    {
        return function ($order) use ($values, $accessor) {
            return !collect($values)->map($accessor)->contains($accessor($order));
        };
    }

    private function lowercaseCommentsContain($needles): \Closure
    {
        return function ($order) use ($needles) {
            return Str::contains(Str::lower($order->comments), $needles);
        };
    }
}
