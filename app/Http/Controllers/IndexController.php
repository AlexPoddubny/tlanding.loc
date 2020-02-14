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
		$menu = [];
		foreach ($pages as $page){
			$item['title'] = $page->name;
			$item['alias'] = strtolower($page->alias);
			$menu[] = $item;
		}
		$menuitems = ['Services', 'Portfolio', 'Team', 'Contact'];
		foreach ($menuitems as $menuitem){
			$item['title'] = $menuitem;
			$item['alias'] = strtolower($menuitem);
			$menu[] = $item;
		}
//		dump($pages);
		return view('site.index', compact('menu', 'pages', 'peoples', 'portfolios', 'services'));
	}
	
}
