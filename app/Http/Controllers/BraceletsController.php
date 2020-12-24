<?php

namespace App\Http\Controllers;

use App\Model\Bracelet;
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
        $bracelets_img = Bracelet::select('image') -> where('name','Lithuanian') -> get();

        return view('bracelets.index',compact('bracelets','bracelets_img'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function create()
    {
        if(Auth::user()->role_id == 2) {
            return view('bracelets.create');
        }else{
            abort(404);
        }
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
        if(Auth::user()->role_id > 0) {
            return view('bracelets.show', compact('bracelet'));
        }else{
            abort(404);
        }
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
        if(Auth::user()->role_id == 2) {
            return view('bracelets.edit', compact('bracelet'));
        }else{
            abort(404);
        }
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
        if(Auth::user()->role_id == 2) {
            $bracelet = Bracelet::find($id);
            $bracelet->delete();
            return redirect('/bracelets', 'success', 'Bracelet is deleted');
        }else{
            abort(404);
        }
    }
}
