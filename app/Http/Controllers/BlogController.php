<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;
use App\Article;
use App\Category;

class BlogController extends Controller
{
    public function index()
    {
        $data = DB::table('articles')->join('categories', 'id_category', '=', 'categories.id')->paginate(5);
        $likes = DB::table('likes')->select(DB::raw(' count(id_article) as likes, id_article'))->groupBy('id_article')->paginate(5);
        $q=[];
        $i=0;
        foreach ($likes as $l)
        {
            $q[$i]=$l->id_article;
            $i++;
        }
        $likes = DB::table('articles')->wherein('id', $q)->get();
        return view('blogs.index', compact('data', 'likes'));
    }
}
