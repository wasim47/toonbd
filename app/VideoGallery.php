<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VideoGallery extends Model
{

	protected $fillable = ['video_title','video_ref','status','cover'];
}
