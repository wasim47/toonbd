<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PhotoGallery extends Model
{

	protected $fillable = ['cat_id','name', 'url', 'title', 'image', 'meta_details','keywords','sequence', 'status'];	
}
