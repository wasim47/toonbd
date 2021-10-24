<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{

	protected $fillable = ['name', 'url', 'image','sequence', 'status'];	
}
