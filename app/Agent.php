<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Agent extends Model
{

	protected $fillable = ['name', 'address','nid', 'image', 'birth_certificate','mobile','email','passport','afacode','license_no','license_file','license_issue_date','license_deadline','work_area','status'];	
}
