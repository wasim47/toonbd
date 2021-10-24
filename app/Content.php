<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Content extends Model
{
    protected $fillable = ['title', 'content', 'title_bangla','content_bangla','menu_id','image'];
}
