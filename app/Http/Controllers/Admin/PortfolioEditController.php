<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Portfolio;

use Validator;

class PortfolioEditController extends Controller
{
    public function execute(Portfolio $portfolio,Request $request) {
    	

    	if($request->isMethod('delete')) {    		
			$portfolio->delete();
			return redirect('admin')->with('status','Портфолио удалено');
		}
		
		if($request->isMethod('post')) {
			
			
			$input = $request->except('_token');
			
			$massages = [
			
				'required'=>'Поле :attribute обязательно к заполнению',
				'unique'=>'Поле :attribute должно быть уникальным',
				'max'=>'Количество символов поля :attribute должно быть не больше :max',
			
			];
			
			
			$validator = Validator::make($input,[			
				'name' => 'required|max:255',
				'filter' => 'required|unique:portfolios|max:15',			
			], $massages);
			
			if($validator->fails()) {
				return redirect()
						->route('portfoliosEdit',['portfolio'=>$input['id']])
						->withErrors($validator);
			}
			
			if($request->hasFile('images')) {
				$file = $request->file('images');
				$file->move(public_path().'/assets/img',$file->getClientOriginalName());
				$input['images'] = $file->getClientOriginalName();
			}
			else {
				$input['images'] = $input['old_images'];
			}
			
			unset($input['old_images']);
			
			/*$page->fill($input);*/
			
			if($portfolio->update($input)) {
				return redirect('admin')->with('status','Портфолио обновлено');
			}
			
		}

		/*$page = Page::find($id);*/		
		$old = $portfolio->toArray();
		if(view()->exists('admin.portfolios_edit')) {
			
			$data = [
					'title' => 'Редактирование портфолио - '.$old['name'],
					'data' => $old
					];
			return view('admin.portfolios_edit',$data);		
			
		}
		
	}
}
