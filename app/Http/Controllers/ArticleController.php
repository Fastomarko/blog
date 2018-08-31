<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Intervention\Image\Facades\Image as ImageInt;
use App\Http\Controllers\middleware;
use Auth;
use Validator;
use App\Like;
use App\category;
use App\Article;
use App\Comment;
use App\Photo;

class ArticleController extends Controller
{
    public function _construct()
    {
        $this->middleware('auth')->except('article/{article}');
    }

    public function show($id)
    {
        $article = Article::with('category', 'user', 'photo')->findOrFail($id);
        dd($article);
        $comment = Comment::with('user')->where('article_id', $id)->get();
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
            //тут кароче валидaция
        $validator = Validator::make($data->all(), [
           'article_name' => 'bail|required|max:191',
            'article_body' => 'required|min:4',
        ]);

        if ($validator->fails()) {
            return redirect('article/create')
                ->withErrors($validator)
                ->withInput();
        }

            $user_id = auth()->user()->id;
            $article = Article::create(['category_id' => $data->category, 'article_name' => $data->article_name, 'user_id' => $user_id, 'article_body'=> $data->article_body]);

            if(($data->file())==null) {
                //если фото не добавили, то будет присвоена заглушка
                $photo = array('article_id' => $article->id, 'photo_link' => "no_photo.jpg", 'photo_order' => 0, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s'));
                DB::table('photos')->insert($photo);
            } else {
                //добавление фото//если фото есть
                $path = public_path() . '\img\\';
                $file = $data->file('file');
                $i = 0;//счетчик фото, для поля order
                foreach ($file as $f)
                {
                    $filename = str_random(20) . '.' . $f->getClientOriginalExtension() ?: 'png';
                    $img = ImageInt::make($f);
                    $img->resize(200, 200)->save($path . $filename);
                    $photo = array('article_id' => $article->id, 'photo_link' => $filename, 'photo_order' => $i, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s'));
                    DB::table('photos')->insert($photo);
                    $i++;
                }
            }
            //добавление фото
            return redirect('home');
    }

    public function edit($id)
    {
        $article = Article::find($id);
        $user = Auth::user();
        if($user->can('update', $article)) {
            $article = Article::with('category')->findOrFail($id);
            $category = category::all();
            return view('blogs.update_article', compact('category', 'article'));
        } else {
           return redirect('home');
        }
    }

    public function update(Request $data, $id)
    {
        //тут кароче валидaция
        $validator = Validator::make($data->all(), [
            'article_name' => 'bail|required|max:191',
            'article_body' => 'required|min:4',
        ]);

        if ($validator->fails()) {
            return redirect('article/create')
                ->withErrors($validator)
                ->withInput();
        }

        $article = Article::findOrFail($id);
        $user = Auth()->user();
        if($user->can('update', $article)) {
            article::where('id', $id)->update(['category_id' => $data->category, 'article_name' => $data->article_name, 'article_body' => $data->article_body]);
            return redirect('article/' . $id);
        } else {
            return redirect('home');
        }
    }

    public function destroy($id)
    {
        $article = Article::findOrFail($id);
        $user = Auth()->user();
        if($user->can('delete', $article)) {
            Article::destroy($id);
            return redirect('home');
        } else {
            return redirect('home');
        }
    }
}