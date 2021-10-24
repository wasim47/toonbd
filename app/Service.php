<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{

	protected $fillable = ['name', 'url','details', 'image', 'meta_details','keywords','sequence', 'status'];	
}
