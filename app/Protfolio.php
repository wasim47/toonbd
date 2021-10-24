<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Protfolio extends Model
{

	protected $fillable = ['name', 'url','details', 'image','sequence', 'status'];	
}
