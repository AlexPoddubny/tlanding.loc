<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Page;
use App\Http\Requests;

class PageController extends Controller
{
    //
	public function execute($alias)
	{
		if (!$alias){
			abort(404);
		}
		
		if (view()->exists('site.page')){
			$page = Page::where('alias', strip_tags($alias))->first();
			$data = [
				'name' => $page->name,
				'page' => $page
			];
			return view('site.page', $data);
		}
	}
}
