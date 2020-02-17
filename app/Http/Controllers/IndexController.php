<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Page;
use App\People;
use App\Portfolio;
use App\Service;
use Illuminate\Support\Facades\Mail;

class IndexController extends Controller
{
    //
	public function execute(Request $request)
	{
		
		if ($request->isMethod('post')){
			
//			dd($request);
			
			$messages = [
				'required' => 'Поле :attribute обязательно к заполнению',
				'email' => 'Поле :attribute должно содержать адрес электронной почты',
			];
			
			$this->validate($request,
				[
					'name' => 'required | max:255',
					'email' => 'required | email',
					'text' => 'required'
				],
				$messages
			);
			
			$data = $request->all();
			
			$result = Mail::send('site.email', ['data' => $data],
				function ($message) use ($data) {
					$mail_admin = env('MAIL_ADMIN');
					$message->from($data['email'], $data['name']);
					$message->to($mail_admin)->subject('Question');
				}
			);
			
			if ($result){
				redirect()->route('home')->with('status', 'Email was sent');
			}
//			dump($request);
		}
		
		$pages = Page::all();
		$peoples = People::all();
		$portfolios = Portfolio::all();
		$services = Service::all();
		
		$tags = Portfolio::distinct()->pluck('filter');
//		dump($tags);
		
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
		return view('site.index', compact('menu', 'pages', 'peoples',
			'portfolios', 'services', 'tags'));
	}
	
}
