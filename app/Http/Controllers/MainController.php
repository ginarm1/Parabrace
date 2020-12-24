<?php

namespace App\Http\Controllers;

use App\Model\Article;

class MainController extends Controller
{
    public function index(){
        $articles = Article::all() -> sortByDesc('id');
        $articlesVal = $articles->values();
        $articles = [$articlesVal->get(0),$articlesVal->get(1),$articlesVal->get(2)];
        return view('main.index', compact('articles'));
    }
}
