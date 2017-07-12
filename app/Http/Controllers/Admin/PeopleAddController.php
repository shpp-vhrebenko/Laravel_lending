<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Validator;
use App\Models\People;

class PeopleAddController extends Controller
{
    //
    
    public function execute(Request $request) {
    	if($request->isMethod('post')) {
			$input = $request->except('_token');			
			
			$massages = [
			
				'required'=>'Поле :attribute обязательно к заполнению',				
				'max'=>'Количество символов поля :attribute должно быть не больше :max',
			
			];
			
			
			$validator = Validator::make($input,[			
				'name' => 'required|max:100',
				'text' => 'required|max:150',
				'position' => 'required|max:100',			
			], $massages);

			
			if($validator->fails()) {
				return redirect()->route('peoplesAdd')->withErrors($validator)->withInput();
			}		
			
			
			$people = People::create($input);
			
			if($people) {
				return redirect('admin')->with('status','Сотрудник добавлен');
			}
			
		}		
		
		if(view()->exists('admin.peoples_add')) {
			
			$data = [					
					'title' => 'Новый сотрудник'				
					];
			return view('admin.peoples_add',$data);		
			
		}
		
		abort(404);
		
		
	}
}