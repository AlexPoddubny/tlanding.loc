<?php

namespace App\Http\Controllers;

use App\Page;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Validator;

class PagesEditController extends Controller
{
	public function execute(Page $page, Request $request)
	{
		
		if ($request->isMethod('delete')){
			$page->delete();
			return redirect()->route('pages')->with('status', 'Page Deleted');
		}
		
		if ($request->isMethod('post')){
			$input = $request->except('_token');
			$validator = Validator::make($input, [
				'name' => 'required|max:255',
				'alias' => 'required|max:255|unique:pages,alias,' . $input['id'],
				'text' => 'required'
			]);
			if ($validator->fails()){
				return redirect()->route('pagesEdit', ['page' => $input['id']])
					->withErrors($validator)
					->withInput();
			}
			
			if ($request->hasFile('images')){
				$file = $request->file('images');
				$input['images'] = $file->getClientOriginalName();
				$file->move(public_path() . '/assets/img/', $input['images']);
			} else {
				$input['images'] = $input['old_images'];
			}
			unset($input['old_images']);
			$page->fill($input);
			if ($page->update()){
				return redirect()->route('pages')->with('status', 'Page Updated');
			}
		}
		
		$old = $page->toArray();
		if (view()->exists('admin.pages_edit')){
			$data = [
				'title' => 'Page Edit' . $old['name'],
				'data' => $old
			];
			return view('admin.pages_edit', $data);
		}
	}
}
