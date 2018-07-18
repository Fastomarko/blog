<?php

namespace App\Http\Controllers;

use App\category;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;
use App\Article;
use App\Like;
use App\Comment;

class BlogController extends Controller
{
    public function index()
    {
        //$data = DB::table('articles')->join('categories', 'category_id', '=', 'categories.id')->paginate(5);
        $data=article::with('category')->paginate(5);
        //потом поинтересуйся
        $category=category::all();
        $bestArticles=$this->best_articles();
        return view('blogs.index', compact('data', 'bestArticles', 'category'));
    }

    public function article_insert_page()
    {
        $category = category::all();
        return view('blogs.insert_article', compact('category'));
    }

    public function article($id)
    {
        $article = Article::find($id);
        $bestArticles = $this->best_articles();

        /*получение кол-ва лайков статьи
        $article_likes=DB::table('likes')->get();
        $like=0;
        foreach ($article_likes as $al)
        {
            if(($al->article_id)==$id)
            {
                $like++;
            }
        }
        */
        $like=like::where('article_id', $id)->count();
        //
        $comments=comment::where('article_id', $id)->get();
        return view('blogs.article', compact('article', 'bestArticles', 'like', 'comments'));
    }

    public function insert_comment(Request $data)
    {
        $user_id = auth()->user()->id;
        //получение id - пока вот так(чисто для проверки)
        $article_id = url()->previous();
        $article_id = str_after($article_id, '/article/');
        $comment_text = $data->input('comment_text');

        $data = array('article_id'=>$article_id, 'user_id'=>$user_id, 'comment_text'=>$comment_text, 'created_at'=>date('Y-m-d H:i:s'), 'updated_at'=>date('Y-m-d H:i:s'));
        DB::table('comments')->insert($data);

        return redirect('article/'.$article_id);
    }

    public function insert_article(Request $data)
    {
        $user_id = auth()->user()->id;
        $category_id = $data->category;
        $article_name = $data->article_name;
        $article_body = $data->article_body;

        $data = array('category_id'=>$category_id, 'article_name'=>$article_name, 'user_id'=>$user_id, 'article_body'=>$article_body, 'created_at'=>date('Y-m-d H:i:s'), 'updated_at'=>date('Y-m-d H:i:s'));
        DB::table('articles')->insert($data);

        return redirect('home');
    }


    public function insert_like()
    {
        //если уже стоит - убрать, не стоит - добавить
        $user_id = auth()->user()->id;
        //получение id - пока вот так(чисто для проверки)
        $article_id = url()->previous();
        $article_id = str_after($article_id, '/article/');

        //проверка - стоит ли уже
        $check_like = like::where([
            ['article_id', $article_id],
            ['user_id', $user_id]
        ])->get()->toArray();
        if($check_like==null)//не стоит
        {
            $data = array('article_id'=>$article_id, 'user_id'=>$user_id, 'created_at'=>date('Y-m-d H:i:s'), 'updated_at'=>date('Y-m-d H:i:s'));
            DB::table('likes')->insert($data);
        }
        else//стоит
        {
            DB::table('likes')->where('id', $check_like[0]['id'])->delete();
        }
        return redirect('article/'.$article_id);
    }

    public function best_articles()
    {
        //для вывода лучших статей(по идее нужно переделать)
        $likes = DB::table('likes')->select(DB::raw(' count(article_id) as likes, article_id'))->groupBy('article_id')->paginate(5);
        //для получения имен статей
        $q=[];
        $i=0;
        foreach ($likes as $l)
        {
            $q[$i]=$l->article_id;
            $i++;
        }
        $likes = DB::table('articles')->wherein('id', $q)->get();
        return $likes;
    }
}
