<?php

namespace App\Http\Controllers;

use App\Http\Resources\CartResource;
use App\Model\Bracelet;
use App\Model\Item;
use App\Model\Order;
use App\Model\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class BraceletsController extends Controller
{
    protected function validateData(){
        return \request() -> validate([
            'name' =>'required|max:100',
            'on_stock_quantity' => 'required|numeric',
            'cost' => 'required|numeric',
            'image' => 'required|image|max:6000',
        ]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {
        $bracelets = Bracelet::paginate(3);

        $user_id = Auth::id();


        if($user_id != null){
            $last_order = Order::where('user_id',$user_id)->orderBy('id','desc')->first();

            if($last_order != null){
                if($last_order->total_cost == 0.00){
                    $empty_cart = false;
                    $items = Item::where('order_id',$last_order->id)->get();

                    return view('bracelets.index',compact('bracelets','items','user_id','empty_cart'));
                }else{
                    $empty_cart = true;
                    return view('bracelets.index',compact('bracelets','user_id','empty_cart'));
                }
            }
        }
        return view('bracelets.index',compact('bracelets','user_id'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function create()
    {
        return view('bracelets.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $this -> validateData();
//        Create plan
        $bracelet = new Bracelet;
        $bracelet -> name = $request -> input('name');
        $bracelet -> on_stock_quantity = $request -> input('on_stock_quantity');
        $bracelet -> cost = $request -> input('cost');

        if($request-> hasFile('image')){
//            Get file name with extention
            $fileExtention = $request -> file('image') -> getClientOriginalName();
//           Get just file name
            $filename =pathinfo($fileExtention,PATHINFO_FILENAME);
//            Get just ext
            $extention = $request -> file('image') -> getClientOriginalExtension();
            $filenameToStore = $filename.'_'.time().'.'.$extention;
            $path = $request -> file('image') -> storeAs('public/img/bracelets',$filenameToStore);

            $bracelet -> image = $filenameToStore;
        }

        $bracelet -> save();

        return redirect('/bracelets')->with('success','Bracelet is created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function show($id)
    {
        $bracelet = Bracelet::find($id);
        return view('bracelets.show', compact('bracelet'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function edit($id)
    {
        $bracelet = Bracelet::find($id);
        return view('bracelets.edit', compact('bracelet'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, $id)
    {
        $this -> validateData();
//        Create plan
        $bracelet = Bracelet::find($id);
        $bracelet -> name = $request -> input('name');
        $bracelet -> on_stock_quantity = $request -> input('on_stock_quantity');
        $bracelet -> cost = $request -> input('cost');

        if ($request->hasFile('image')) {

//            Get file name with extention
            $fileExtention = $request -> file('image') -> getClientOriginalName();
//           Get just file name
            $filename =pathinfo($fileExtention,PATHINFO_FILENAME);
//            Get just ext
            $extention = $request -> file('image') -> getClientOriginalExtension();
            $filenameToStore = $filename.'_'.time().'.'.$extention;
            $path = $request -> file('image') -> storeAs('public/img/bracelets',$filenameToStore);

            Storage::delete('public/img/bracelets/' . $bracelet->image);

            $bracelet -> image = $filenameToStore;
        }

        $bracelet -> save();

        return redirect('/bracelets')->with('success','Bracelet is updated');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        $bracelet = Bracelet::find($id);
        $bracelet->delete();
        return redirect('/', 'success', 'Bracelet is deleted');
    }
}
