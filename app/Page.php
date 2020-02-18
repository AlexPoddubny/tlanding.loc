<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Page extends BaseModel
{
	protected $fillable = ['name', 'text', 'alias', 'images'];
}
