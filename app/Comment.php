<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = ['article_id', 'user_id', 'comment_text'];
    //
    public function article()
    {
        return $this->belongsTo(article::class);
    }

    public function user()
    {
        return $this->belongsTo(user::class);
    }
}
