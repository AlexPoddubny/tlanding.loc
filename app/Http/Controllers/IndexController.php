<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Page;
use App\People;
use App\Portfolio;
use App\Service;

class IndexController extends Controller
{
    //
	public function execute(Request $request)
	{
		$pages = Page::all();
		$peoples = People::all();
		$portfolios = Portfolio::take(3)->get();
		$services = Service::all();
//		dump($peoples);
		return view('site.index');
	}
	
}
