<?php

namespace App\Http\Controllers;

use App\Model\Article;
use App\Model\Partner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ArticlesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {
        $articles = Article::all();

        return view('articles.index', compact('articles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function create()
    {

        return view('articles.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $this->validateData();

//        Create plan
           $article = new Article;
           $article -> name = $request -> input('name');
           $article -> intro = $request -> input('intro');
           $article -> text = $request -> input('text');

           if($request-> hasFile('image')){
//            Get file name with extention
               $fileExtention = $request -> file('image') -> getClientOriginalName();
//           Get just file name
               $filename =pathinfo($fileExtention,PATHINFO_FILENAME);
//            Get just ext
               $extention = $request -> file('image') -> getClientOriginalExtension();
               $filenameToStore = $filename.'_'.time().'.'.$extention;
               $path = $request -> file('image') -> storeAs('public/img/articles',$filenameToStore);

               $article -> image = $filenameToStore;
           }

           $partner = Partner::where('name',$request -> input('partner-name')) -> get();

           if($partner != null){
               $article -> save();
               $article -> partners() -> attach($partner[0]->id);
           }

//        return view('articles.create',compact('number'));
        return redirect('/articles')->with('success','Article is created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function show($id)
    {
        $article = Article::find($id);
        return view('articles.show',compact('article'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function edit($id)
    {
        $article = Article::find($id);

        return view('articles.edit')->with('article',$article);
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
        $this->validateData();
//        Update plan
        $article = Article::find($id);
        $article -> name = $request -> input('name');
        $article -> intro = $request -> input('intro');
        $article -> text = $request -> input('text');


        if ($request->hasFile('image')) {

//            Get file name with extention
            $fileExtention = $request -> file('image') -> getClientOriginalName();
//           Get just file name
            $filename =pathinfo($fileExtention,PATHINFO_FILENAME);
//            Get just ext
            $extention = $request -> file('image') -> getClientOriginalExtension();
            $filenameToStore = $filename.'_'.time().'.'.$extention;
            $path = $request -> file('image') -> storeAs('public/img/articles',$filenameToStore);

            Storage::delete('public/img/articles/' . $article->image);

            $article -> image = $filenameToStore;
        }

        $article -> save();

        if($request -> input('partner-name') != ''){

            $partner = Partner::where('name',$request -> input('partner-name')) -> get();

            if($partner != null){
                $article -> partners() -> attach($partner[0]->id);
            }
        }



        return redirect('/articles/'.$article->id)->with('success','Article is updated');
    }

    protected function validateData(){
        return request() -> validate([
            'name' =>'required|max:255',
            'intro' => 'required',
            'text' => 'required',
            'image' => 'image|nullable|max:6000'
        ]);
    }

    public function removePartner($articleId,$partnerId){

        $article = Article::find($articleId);
        $article -> partners() -> detach($partnerId);
//        $article = Article::find($article -> id);
        return redirect('/articles')->with('success','Partner is removed from article');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        $article = Article::find($id);
        $article->delete();
        return redirect('/articles')->with('success','Article is deleted');
    }


}
