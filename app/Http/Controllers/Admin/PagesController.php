<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Page;

class PagesController extends Controller
{
    public function execute() {
		
		
		if(view()->exists('admin.pages')) {
			
			$pages = Page::all();
			
			$data = [
					
					'title' => 'Страницы',
					'pages' => $pages
					
					];
			
			return view('admin.pages',$data);		
			
		}
		
		abort(404);
	}
}
