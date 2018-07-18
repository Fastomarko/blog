<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class like extends Model
{
    //

    public function article()
    {
        return $this->belongsTo(article::class);
    }
}
