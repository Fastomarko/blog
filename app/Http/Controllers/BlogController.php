<?php

namespace App\Http\Controllers;

use App\category;
use Illuminate\Support\Facades\DB;
use Intervention\Image\Facades\Image as ImageInt;

use Illuminate\Http\Request;
use App\Article;
use App\Like;
use App\Comment;
use App\Photo;

class BlogController extends Controller
{
    public function index()
    {
        $data=article::with('category')->with('photo')->paginate(5);
        //$photo=photo::where('photo_order', 0)->with('article')->get();
        $bestArticles=$this->best_articles();
        return view('blogs.index', compact('data', 'bestArticles'));
    }

    public function article_insert_page()
    {
        $category = category::all();
        return view('blogs.insert_article', compact('category'));
    }

    public function article($id)
    {
        $article = Article::with('category')->with('user')->with('photo')->where('id', $id)->get();
        $comment = Comment::with('user')->where('article_id', $id)->get();
        $bestArticles = $this->best_articles();

        $like=like::where('article_id', $id)->count();
        return view('blogs.article', compact('article', 'bestArticles', 'like', 'comment'));
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
        $category_id = $data->category;
        if($category_id!="no")
        {
            $user_id = auth()->user()->id;
            $article_name = $data->article_name;
            $article_body = $data->article_body;

            $insert = array('category_id'=>$category_id, 'article_name'=>$article_name, 'user_id'=>$user_id, 'article_body'=>$article_body, 'created_at'=>date('Y-m-d H:i:s'), 'updated_at'=>date('Y-m-d H:i:s'));
            $id=DB::table('articles')->insertGetId($insert);//добавляем запись, и сразу получаем её id для добавления фото

            if(($data->file())==null)
            {
                //если фото не добавили, то будет присвоена заглушка
                $photo = array('article_id' => $id, 'photo_link' => "no_photo.jpg", 'photo_order' => 0, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s'));
                DB::table('photos')->insert($photo);
            }
            else {
                //добавление фото//если фото есть
                $path = public_path() . '\img\\';
                $file = $data->file('file');
                $i = 0;//счетчик фото, для поля order
                foreach ($file as $f) {
                    $filename = str_random(20) . '.' . $f->getClientOriginalExtension() ?: 'png';
                    $img = ImageInt::make($f);
                    $img->resize(200, 200)->save($path . $filename);
                    $photo = array('article_id' => $id, 'photo_link' => $filename, 'photo_order' => $i, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s'));
                    DB::table('photos')->insert($photo);
                    $i++;
                }
            }
            //добавление фото
            return redirect('home');
        }//дописать else
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

    public function update_article(Request $data, $id)
    {
        $category_id = $data->category;
        if ($category_id!="no")
        {
            $article_name = $data->article_name;
            $article_body = $data->article_body;

            $data = array('category_id'=>$category_id, 'article_name'=>$article_name, 'article_body'=>$article_body, 'updated_at'=>date('Y-m-d H:i:s'));
            DB::table('articles')->where('id', $id)->update($data);
            return redirect('article/'.$id);
        }//дописать else
    }

    public function delete_article($id)
    {
        DB::table('articles')->where('id',$id)->delete();
        return redirect('home');
    }

    public function article_update_page($id)
    {
        $article = Article::with('category')->where('id', $id)->get();
        //dd($article);
        $category = category::all();
        return view('blogs.update_article', compact('category', 'article'));
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
