<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class article extends Model
{
    //

    public function user()
    {
        return $this->belongsTo(user::class);
    }

    public function like()
    {
        return $this->HasMany(like::class);
    }

    public function comment()
    {
        return $this->HasMany(comment::class);
    }

    public function category()
    {
        return $this->belongsTo(category::class);
    }
}
