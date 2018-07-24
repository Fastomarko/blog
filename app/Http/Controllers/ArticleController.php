<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Intervention\Image\Facades\Image as ImageInt;
use App\Http\Controllers\middleware;

use App\Like;
use App\category;
use App\Article;
use App\Comment;
use App\Photo;

class ArticleController extends Controller
{

    public function show($id)
    {
        $article = Article::with('category', 'user', 'photo')->findOrFail($id);
        $comment = Comment::with('user')->where('article_id', $id)->get();
        $bestArticles = Article::withCount('like')->orderBy('like_count', 'desc')->take(5)->get();
        $like=like::where('article_id', $id)->count();
        return view('blogs.article', compact('article', 'bestArticles', 'like', 'comment'));
    }

    public function create()
    {
        $category = category::all();
        return view('blogs.insert_article', compact('category'));
    }

    public function store(Request $data)
    {
        $category_id = $data->category;
        if($category_id!="no")
        {
            $user_id = auth()->user()->id;
            $article_name = $data->article_name;
            $article_body = $data->article_body;
            //переделать под модель
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
                foreach ($file as $f)
                {
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

    public function edit($id)
    {
        $article = Article::with('category')->findOrFail($id);
        //dd($article);
        $category = category::all();
        return view('blogs.update_article', compact('category', 'article'));
    }

    public function update(Request $data, $id)
    {
        if (($data->category)!="no")
        {
            $data = array('category_id'=>$data->category, 'article_name'=>$data->article_name, 'article_body'=>$data->article_body, 'updated_at'=>date('Y-m-d H:i:s'));
            DB::table('articles')->where('id', $id)->update($data);
            return redirect('article/'.$id);
        }//дописать else
    }

    public function destroy($id)
    {
        DB::table('articles')->where('id',$id)->delete();
        return redirect('home');
    }
}
