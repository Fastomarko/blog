<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class like extends Model
{
    //
    use SoftDeletes;
    protected $fillable = ['article_id', 'user_id'];
    protected $dates = ['deleted_at'];

    public function article()
    {
        return $this->belongsTo(article::class);
    }
}
