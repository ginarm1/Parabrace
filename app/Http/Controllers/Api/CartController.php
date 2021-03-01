<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Model\Bracelet;
use App\Model\Item;
use App\Http\Resources\CartResource as CartResource;
use App\Model\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function api()
    {
//        It wasn't possible to dynamic Auth::id, if logged in user id is not 2, change $user_id
        $user_id = 2;
        $order = Order::where('user_id',$user_id)->latest()->get();
        $items = CartResource::collection(Item::where('order_id',$order[0]->id) -> orderBy('created_at','DESC') -> paginate(4));
        return $items;
    }

    public function index(){

        $user_id = Auth::id();

        $order = Order::where('user_id',$user_id)->latest()->get();
        $items = CartResource::collection(Item::where('order_id',$order[0]->id) -> orderBy('created_at','DESC') -> paginate(4));
        return view('cart.index',compact('items','user_id'));
    }

    public function addToCart($bracelet_id){
        $user_id = Auth::user()->id;
        $bracelet = Bracelet::findOrFail($bracelet_id);
        $not_sold_items = Item::where(['user_id'=>$user_id,'sold'=>0])->get();
        $empty_cart = false;
        $same_item = false;
        if(count($not_sold_items) == 0){
            $order = new Order;
            $order -> user_id = $user_id;
            $order -> country = Auth::user()->country;
            $order -> city = Auth::user()->city;
            $order -> address = Auth::user()->address;
            $order -> phone_nr = Auth::user()->phone_nr;
            $order -> save();

            $empty_cart = true;
//            return redirect('/bracelets')->with('success','Item: '.$not_sold_items[0] -> name. ' has been added');
        }else{
            foreach ($not_sold_items as $not_sold_item) {
                if($not_sold_item -> name == $bracelet -> name){
                    $not_sold_item -> quantity += 1;
                    $not_sold_item -> save();

                    $items = Item::all();
                    session(['cart-items-count' =>count($items) ] );
                    return redirect('/bracelets')->with('success',
                        'Item: '.$not_sold_item -> name. ' has been added');
                }
            }
        }

        if($empty_cart || !$same_item){
            $item = new Item;
            $order = Order::where('user_id',$user_id)->latest()->get('id');

            $item -> name = $bracelet -> name;
            $item -> user_id = $user_id;
            $item -> quantity += 1;
            $item -> image = $bracelet -> image;
            $item -> order_id = $order[0] -> id;
            if($bracelet -> lower_cost != null)
                $item -> cost = $bracelet -> lower_cost;
            else $item -> cost = $bracelet -> cost;
            $item -> save();

            $items = Item::where('order_id',$order->id)->get();
            session(['cart-items-count' =>count($items) ] );
            return redirect('/bracelets')->with('success','Item: '.$item -> name. ' has been added');
        }

    }
    public function minusOneFromCart($bracelet_id){
        $user_id = Auth::user()->id;
        $bracelet = Bracelet::findOrFail($bracelet_id);
        $not_sold_item = Item::where(['user_id'=>$user_id,'sold'=>0,'name'=>$bracelet->name])->latest()->get();
        $not_sold_item[0] -> quantity -= 1;
        if($not_sold_item[0] -> quantity == 0){
            $not_sold_item[0] -> delete();

//            checking if it was the only item in the cart
            $not_sold_item = Item::where(['user_id'=>$user_id,'sold'=>0])->latest()->get();
            if(count($not_sold_item) == 0){
                $order = Order::where(['user_id'=>$user_id,'total_cost'=>0.0]) -> latest() -> get();
                $order[0] -> delete();
            }
        }else{
            $not_sold_item[0] -> save();
        }
        return redirect('/bracelets') -> with('success',
            'Bracelet '.$bracelet->name. ' was removed from the cart by 1');
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return CartResource
     */
    public function show($id)
    {
        $items = Item::findOrFail($id);
        return new CartResource($items);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return CartResource
     */
    public function destroy($id)
    {
        // Get article
        $item = Item::findOrFail($id);

        if($item->delete()) {
            return new CartResource($item);
        }
    }
}
