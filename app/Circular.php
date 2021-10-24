<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Circular extends Model
{

	protected $fillable = ['name', 'image','sequence', 'status'];	
}
