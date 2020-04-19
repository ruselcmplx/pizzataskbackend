<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Traits\RegisterUser;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash as Hash;

class OrderController extends Controller
{
    use RegisterUser;

    public function getorder()
    {
        if (Auth::user()) {
            $userId = Auth::user()->id;

            $lastOrder = \App\Order::where('user_id', $userId)->latest('created_at')->first();

            $orderContents = $lastOrder->order_contents;
            $totalPrice = $lastOrder->total_price;

            return view('order', [
                'current_order' => json_decode($orderContents),
                'total_price' => $totalPrice
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
            'total_price' => $totalPrice
        ]);

        $user->orders()->save($order);

        return $res;
    }
}
