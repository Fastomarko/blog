<?php

namespace App;

use Laravel\Scout\Searchable;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use Searchable;
    //
    protected $fillable = ['category_id', 'article_name', 'user_id', 'article_body'];

    public function user()
    {
        return $this->belongsTo(user::class);
    }

    public function getFullNameAttribute()
    {
        return "{$this->article_name} {$this->article_body}";
    }

    public function like()
    {
        return $this->HasMany(like::class);
    }

    public function comment()
    {
        return $this->HasMany(comment::class);
    }

    public function photo()
    {
        return $this->HasMany(photo::class);
    }


    public function category()
    {
        return $this->belongsTo(category::class);
    }

    public function scopeBestArticles($query)
    {
        return $query->withCount('like')->orderBy('like_count', 'desc')->take(5)->get();
    }
}
