<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{

	protected $fillable = ['name', 'details', 'image', 'meta_details','keywords','sequence', 'status'];	
}
