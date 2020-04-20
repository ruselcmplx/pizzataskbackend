<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Traits\RegisterUser;
use Illuminate\Support\Str;

class OrderController extends Controller
{
    use RegisterUser;

    public function getorder()
    {
        if (Auth::user()) {
            $userId = Auth::user()->id;

            $lastOrder = \App\Order::where('user_id', $userId)->latest('created_at')->first();

            $orderId = $lastOrder->id;
            $orderContents = $lastOrder->order_contents;
            $totalPrice = $lastOrder->total_price;

            return view('order', [
                'current_order' => json_decode($orderContents),
                'total_price' => $totalPrice,
                'order_id' => $orderId
            ]);
        } else {
            return redirect()->route('home');
        }
    }

    public function createorder(Request $request)
    {
        $res = true;
        $requestData = json_decode($request->getContent());

        $phone = $requestData->phone;
        $orderContents = json_encode($requestData->order);
        $totalPrice = $requestData->price;

        if (Auth::user()) {
            $user = Auth::user();
        } else {
            $user = \App\User::where('phone', $phone)->first();
        }

        if (!$user) {
            $randomPassword = Str::random(8);

            $user = new \App\User;
            $user->name = $phone;
            $user->phone = $phone;
            $user->password = $randomPassword;
            $user->save();

            $res = $randomPassword;
        }

        Auth::loginUsingId($user->id);

        $order = new \App\Order([
            'order_contents' => $orderContents,
            'total_price' => $totalPrice,
            'phone' => $phone
        ]);

        $user->orders()->save($order);

        return $res;
    }

    public function payment(Request $request)
    {
        $phone = $request->phone;
        $address = $request->address;
        $postCode = $request->post_code;
        $orderId = $request->order_id;

        $order = \App\Order::find($orderId);

        $order->phone = $phone;
        $order->address = $address;
        $order->post_code = $postCode;

        $order->save();

        return view('success');
    }
}
