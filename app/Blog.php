<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{

	protected $fillable = ['name', 'slug','details', 'image', 'meta_details','keywords','sequence', 'status'];	
}
