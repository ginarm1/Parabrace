<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Model\Bracelet;
use App\Model\Item;
use App\Http\Resources\CartResource as CartResource;
use Illuminate\Http\Request;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function api()
    {
//        $items = Item::all();
        $items = CartResource::collection(Item::orderBy('created_at','DESC') -> paginate(4));
        return $items;
//        return view('cart.index',compact('items'));
    }
    public function index(){
        $items = CartResource::collection(Item::all());
        return view('cart.index',compact('items'));
    }

    public function addToCart($id){
        $bracelet = Bracelet::findOrFail($id);
        $item = new Item;

        $item -> name = $bracelet -> name;
        $item -> quantity += 1;
        $item -> image = $bracelet -> image;

        if($bracelet -> lower_cost != null)
            $item -> cost = $bracelet -> lower_cost;
        else $item -> cost = $bracelet -> cost;


        $item -> save();

        $items = Item::all();

        session(['cart-items-count' =>count($items) ] );


        return redirect('/bracelets')->with('success','Item: '.$item -> name. ' has been added');
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
