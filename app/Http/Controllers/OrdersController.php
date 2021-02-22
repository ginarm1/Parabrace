<?php

namespace App\Http\Controllers;

use App\Mail\OrderMail;
use App\Model\Bracelet;
use App\Model\Item;
use App\Model\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class OrdersController extends Controller
{
    protected function validateData(){
        return \request() -> validate([
            'country' => 'required|max:100',
            'city' => 'required|max:120',
            'address' => 'required',
            'phone_nr' => 'required|min:8|max:14',
        ]);
    }

    public function index () {

        $user = Auth::user();
        $order = Order::where('user_id',$user -> id) -> latest() -> get();
        $items = Item::all();

        return view('order.index',compact('items','user','order'));
    }
    public function update (Request $request,$order_id) {
        $this ->validateData();

        $items = Item::where('order_id',$order_id) -> get();


        foreach ($items as $item){
            $bracelets = Bracelet::where('name',$item -> name) -> first();
            $bracelets -> on_stock_quantity -= $item -> quantity;
            $bracelets -> sold_quantity += $item -> quantity;
            $item -> sold = 1;

            $bracelets -> save();
            $item -> save();
        }

        $order = Order::findOrFail($order_id);
        $order -> total_cost = $request -> input('total_cost');
        $order -> country = $request -> input('country');
        $order -> city = $request -> input('city');
        $order -> address = $request -> input('address');
        $order -> phone_nr = $request -> input('phone_nr');
        $order -> country = $request -> input('country');

        $order -> save();

//      Send email
        Mail::to('test@gmail.com')->send(new OrderMail());

        return redirect('/')->with('success','Order has been successful!');
    }
}
