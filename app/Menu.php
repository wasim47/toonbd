<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
	protected $fillable = ['title', 'title_bangla','uri','page_structure','parent_id'];
}
