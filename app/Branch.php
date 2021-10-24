<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{

	protected $fillable = ['division_id','name','address', 'incharge','contact','sequence', 'status'];	
}
