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
        //для получения имен статей
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

    public function article($id)
    {
        $article = DB::table('articles')->find($id);

        //получение лайков для списка популярных
        $likes = DB::table('likes')->select(DB::raw(' count(id_article) as likes, id_article'))->groupBy('id_article')->paginate(5);
        $q=[];
        $i=0;
        foreach ($likes as $l)
        {
            $q[$i]=$l->id_article;
            $i++;
        }
        $likes = DB::table('articles')->wherein('id', $q)->get();

        //получение кол-ва лайков статьи
        $article_likes=DB::table('likes')->get();
        $like=0;
        foreach ($article_likes as $al)
        {
            if(($al->id_article)==$id)
            {
                $like++;
            }
        }

        //получение комментариев
        $comments= DB::table('comments')->where('id_article', '=', $id)->get();
        return view('blogs.article', compact('article', 'likes', 'like', 'comments'));
    }

    public function insert_comment(Request $data)
    {
        $id_user = auth()->user()->id;
        //получение id - пока вот так(чисто для проверки)
        $id_article = url()->previous();
        $id_article = str_after($id_article, '/article/');
        $comment_text = $data->input('comment_text');

        $data = array('id_article'=>$id_article, 'id_user'=>$id_user, 'comment_text'=>$comment_text, 'created_at'=>date('Y-m-d H:i:s'), 'updated_at'=>date('Y-m-d H:i:s'));
        DB::table('comments')->insert($data);

        return redirect('articles/'.$id_article);
    }

    public function category1()
    {
        $data = DB::table('articles')->join('categories', 'id_category', '=', 'categories.id')->where('id_category', '=', '1')->paginate(5);
        $likes = DB::table('likes')->select(DB::raw(' count(id_article) as likes, id_article'))->groupBy('id_article')->paginate(5);
        $q=[];
        $i=0;
        foreach ($likes as $l)
        {
            $q[$i] = $l->id_article;
            $i++;
        }
        $likes = DB::table('articles')->wherein('id', $q)->get();
        return view('blogs.index', compact('data', 'likes'));
    }

    public function category2()
    {
        $data = DB::table('articles')->join('categories', 'id_category', '=', 'categories.id')->where('id_category', '=', '2')->paginate(5);
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

    public function category3()
    {
        $data = DB::table('articles')->join('categories', 'id_category', '=', 'categories.id')->where('id_category', '=', '3')->paginate(5);
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

    public function category4()
    {
        $data = DB::table('articles')->join('categories', 'id_category', '=', 'categories.id')->where('id_category', '=', '4')->paginate(5);
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
