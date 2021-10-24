<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{

	protected $fillable = ['menu_id','name', 'files', 'years', 'status'];	
}
