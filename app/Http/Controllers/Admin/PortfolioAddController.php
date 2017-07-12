<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Validator;
use App\Models\Portfolio;

class PortfolioAddController extends Controller
{
    public function execute(Request $request) {
    	if($request->isMethod('post')) {    		
			$input = $request->except('_token');			
			
			$massages = [
			
				'required'=>'Поле :attribute обязательно к заполнению',
				'unique'=>'Поле :attribute должно быть уникальным'
			
			];
			
			
			$validator = Validator::make($input,[			
				'name' => 'required|max:255',
				'filter' => 'required|unique:portfolios|max:15',				
				'images' => 'required',
			], $massages);
			
			if($validator->fails()) {
				return redirect()->route('portfoliosAdd')->withErrors($validator)->withInput();
			}
			
			if($request->hasFile('images')) {
				$file = $request->file('images');
			
				$input['images'] = $file->getClientOriginalName();
				
				$file->move(public_path().'/assets/img',$input['images']);
			
			}			
			
			//$page->unguard();
			
			$portfolio = Portfolio::create($input);
			
			if($portfolio) {
				return redirect('admin')->with('status','Портфолио добавлено');
			}
			
		}
		
		if(view()->exists('admin.portfolios_add')) {
			
			$data = [
					
					'title' => 'Новае портфолио'
					
					];
			return view('admin.portfolios_add',$data);		
			
		}
		
		abort(404);
		
		
	}
}
