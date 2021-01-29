<?php

namespace App\Http\Controllers;

use App\Model\Article;
use App\Http\Requests;
use App\Http\Resources\ArticleResource as ArticleResource;
use App\Model\Partner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ArticlesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
//        For Resources to work, pagination is a must
        $count = Article::all() -> count();
        $articless = Article::paginate($count);

//        return ArticleResource::collection($articles);
        $articles = ArticleResource::collection($articless);
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

//           API edition
//            $article = $request->isMethod('put')
//                ? ArticleResource::findOrFail ($request->id) : new ArticleResource;

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
               //  API edition
           //  return new ArticleResource($article);
           }

        return redirect('/articles','success','ArticleResource is created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return ArticleResource|\Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function show($id)
    {
        $article = Article::findOrFail($id);
//        return new ArticleResource($article);
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
        $article = Article::findOrFail($id);

        return view('articles.edit',compact('article') );
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
        $article = Article::findOrFail($id);
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



        return redirect('/articles/'.$article->id)->with('success','ArticleResource is updated');
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

        $article = Article::findOrFail($articleId);
        $article -> partners() -> detach($partnerId);
//        $article = ArticleResource::find($article -> id);
        return redirect('/articles','success','Partner is removed from article');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        $article = Article::findOrFail($id);
        $article->delete();
        return redirect('../articles','success','ArticleResource is deleted');

//        API edition
//        if($article -> delete())  {
//            return new ArticleResource($article);
//        }
    }


}
