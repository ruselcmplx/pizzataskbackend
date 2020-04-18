<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Traits\RegisterUser;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash as Hash;

use stdClass;

class OrderController extends Controller
{
    use RegisterUser;

    public function getorder()
    {
        if (Auth::user()) {
            $userId = Auth::user()->id;
    
            $lastOrder = \App\Order::where('user_id', $userId)->first()->order_contents;
    
            return view('order', $lastOrder);
        } else {
            abort(403, 'Unauthorized action.');
        }
    }

    public function createorder(Request $request)
    {
        $requestData = json_decode($request->getContent());
        
        $phone = $requestData->phone;
        $orderContents = json_encode($requestData->order);

        if (Auth::user()) {
            return $phone;
        } else {
            $user = \App\User::where('phone', $phone)->first();

            if ($user) {
                return $user;
            } else {
                $randomPassword = Hash::make(Str::random(8));
                                
                $newUser = new \App\User;
                $newUser->name=$phone;
                $newUser->phone=$phone;
                $newUser->password=$randomPassword;
                $newUser->save();

                $order = new \App\Order(['order_contents' => $orderContents]);

                $newUser->orders()->save($order);

                return true;
            }
        }
    }
}
