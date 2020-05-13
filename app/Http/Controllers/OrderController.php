<?php

namespace App\Http\Controllers;

use App\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::all();
        return response()->json(compact('orders'));
    }

    public function delete($id)
    {
        $order = Order::findOrFail($id);
        if ($order)
            $order->delete();
        else
            return response()->json(error);
        return response()->json('Deleted');
    }
    public function post(Request $request){
        $order = new Order;

        $order->title = Input::get('title');
        $order->subtitle = Input::get('subtitle');
        $order->user_id =Input::get('user_id');
        $order->save();
        return response()->json('Success');

    }
}
