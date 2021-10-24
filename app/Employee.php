<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{

	protected $fillable = ['name', 'designation','branch', 'image', 'department','mobile','email', 'status'];	
}
