<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

abstract class BaseModel extends Model
{
    protected $table;
    
    public function __construct()
    {
	    $name = static::class;
    	return $this->table = strtolower(substr($name, strpos($name, '\\') + 1)) . 's';
    }
	
}
