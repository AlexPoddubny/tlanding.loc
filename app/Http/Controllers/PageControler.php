<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Page;
use App\Http\Requests;

class PageControler extends Controller
{
    //
	public function execute($alias)
	{
		if (!$alias){
			abort(404);
		}
	}
}
