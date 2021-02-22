<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ArticleResource;
use App\Model\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function index () {
        return ArticleResource::collection(Article::all());
    }

    public function show($id) {
        $article = Article::findOrFail($id);
        return new ArticleResource($article);
    }

    public function destroy($id) {
        $article = Article::findOrFail($id);

        if($article->delete()){
            return new ArticleResource($article);
        }
    }


}
