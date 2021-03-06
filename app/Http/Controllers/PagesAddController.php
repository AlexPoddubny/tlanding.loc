<?php

namespace App\Http\Controllers;

use App\Page;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Validator;

class PagesAddController extends Controller
{
	public function execute(Request $request)
	{
		
		if($request->isMethod('post')){
			$input = $request->except('_token');
			
			$validator = Validator::make($input, [
				'name' => 'required|max:255',
				'alias' => 'required|unique:pages|max:255',
				'text' => 'required'
			]);
			
			if ($validator->fails()){
				return redirect()->route('pagesAdd')->withErrors($validator)->withInput();
			}
			
			if($request->hasFile('images')){
				$file = $request->file('images');
				$input['images'] = $file->getClientOriginalName();
				$file->move(public_path() . '/assets/img/', $input['images']);
			}
			
			$page = new Page($input);
			
			if($page->save()){
				return redirect()->route('pages')->with('status', 'Page added');
			}
			
		}
		
		if(view()->exists('admin.pages_add')){
			$data = [
				'title' => 'New Page'
			];
			return view('admin.pages_add', $data);
		}
		
    }
}
