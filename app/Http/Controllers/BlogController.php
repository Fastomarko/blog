<?php

namespace App\Http\Controllers;

use App\category;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Article;
use App\Like;

class BlogController extends Controller
{
    public function index()
    {
        $data=Article::with('category')->with('photo')->paginate(5);
        //$photo=photo::where('photo_order', 0)->with('article')->get();
        $bestArticles=Article::withCount('like')->orderBy('like_count', 'desc')->take(5)->get();
        return view('blogs.index', compact('data', 'bestArticles'));
    }

    public function insert_comment(Request $data, $id)
    {
        $user_id = auth()->user()->id;
        $comment_text = $data->input('comment_text');
        $data = array('article_id'=>$id, 'user_id'=>$user_id, 'comment_text'=>$comment_text, 'created_at'=>date('Y-m-d H:i:s'), 'updated_at'=>date('Y-m-d H:i:s'));
        DB::table('comments')->insert($data);

        return redirect('article/'.$id);
    }

    public function insert_like($id)
    {
        $user_id = auth()->user()->id;
        //если в удаленном -> восстановить
        if (($like = Like::onlyTrashed()->where([
            ['article_id', $id],
            ['user_id', $user_id],
        ])->first())!=null)
        {
            $like->restore();
        }
        //если не удалена(лайк уже стоит) -> удалить
        elseif(($like = Like::withoutTrashed()->where([
            ['article_id', $id],
            ['user_id', $user_id],
        ])->first())!=null)
        {
            $like->delete();
        }
        //если вообще нету -> создать
        else
        {
            $like = Like::firstOrCreate(['article_id'=>$id, 'user_id'=>$user_id]);
        }
        return redirect('article/'.$id);
    }

    public function about_us()
    {
        return view('blogs.about_us');
    }

    public function terms_of_use()
    {
        return view('blogs.terms_of_use');
    }
}
